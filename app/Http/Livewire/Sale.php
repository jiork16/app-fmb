<?php

namespace App\Http\Livewire;

use stdClass;
use App\Traits\SortBy;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InventoryMovement;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\InventoryMovementResource;

class Sale extends Component
{
    use WithPagination, SortBy;
    /**
     * Elegir el tipo de paginación
     *
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * Parametros en la url
     *
     * @var array
     */
    protected $queryString     = [
        'search' => ['except' => ''],
        'page',
    ];
    /**
     * Cantidad de registros por paginas a mostrar.
     *
     * @var integer
     */
    public $perPage  = 10;
    /**
     * Buscar entre los registros de las transacciones
     *
     * @var string
     */
    public $search   = '';
    /**
     * Ordenar los registros segun la columna.
     *
     * @var string
     */
    //public $orderBy =  'products.id';
    /**
     * Ordenar de manera ascendente o descendente
     *
     * @var boolean
     */
    public $orderAsc = true;
    /**
     * Se almacenaran los a vender
     *
     * @var object
     */
    public array  $carroVenta = [];
    /**
     * Se almacenaran los tipo de venta de medicamento
     *
     * @var object
     */
    public $tipoPresentacion = ['UNIDAD', 'CAJA'];
    public $tiposPrecios =  ['PVPU', 'PVPC', 'PVPR'];
    /**
     * Renderizar el componete con las listas de transacciones realizadas
     *
     *
     * @return \Illuminate\Http\Response
     */
    public $fechMaxInvent;
    public float $totalCarrito = 0.00;
    public function render()
    {
        session()->flash('Modulo', 'Sales');
        $this->fechMaxInvent = InventoryMovement::maxiInvent()->get()[0]->fecha;
        $data = QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search))->paginate($this->perPage);
        $inventarioData = InventoryMovementResource::collection(
            $data
        )->response()->getData();
        $inventarioData->paginate = $data;
        //dd($inventarioData->data);
        return view('livewire.sales.sales', ['inventarioData' =>  $inventarioData, 'carroVenta' => $this->carroVenta]);
    }
    public function agregarCarrito($idProducto)
    {
        $object = new stdClass;
        $datoProducto = InventoryMovementResource::collection(
            QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search, $idProducto))->paginate($this->perPage)
        )->response()->getData();
        foreach ($datoProducto->data as $producto) {
            $object->id             = $producto->producto->id;
            $object->description    = $producto->producto->description;
            $object->pvpu           = $producto->producto->pvpu;
            $object->pvpc           = $producto->producto->pvpc;
            $object->pvpr           = $producto->producto->pvpr;
            $object->unidad         = 1;
            $object->unidadProducto = $producto->producto->unit;
            $object->precio         = $producto->producto->pvpu;
            $object->total          = $producto->producto->pvpu;
            $object->siPvpr         = $producto->producto->pvpu;
            $object->presentacion   = "UNIDAD";
        }
        array_push($this->carroVenta, (array) $object);
        $this->calcularTotalCarrito();
    }
    public function cambioRegistroCarro($idProducto, $tipoCambio, $nuevoValor)
    {
        foreach ($this->carroVenta as &$carroVenta) {
            if ($carroVenta["id"] == $idProducto) {
                switch ($tipoCambio) {
                    case 1:  # Presentacion
                        //dd($nuevoValor);
                        if ($nuevoValor == "UNIDAD") {
                            $carroVenta["precio"] = $carroVenta["pvpu"];
                            $carroVenta["total"] =  $carroVenta["unidad"] * $carroVenta["pvpu"];
                        } else {
                            $carroVenta["total"] =  $carroVenta["unidad"] * $carroVenta["pvpc"];
                            $carroVenta["precio"] = $carroVenta["pvpc"];
                        }
                        $carroVenta["presentacion"] = $nuevoValor;
                        break;

                    case 2: # Cantidad
                        if ($carroVenta["siPvpr"]) {
                            $carroVenta["total"] = $nuevoValor * $carroVenta["pvpr"];
                        } else {
                            $carroVenta["total"] = $nuevoValor * $carroVenta["precio"];
                        }
                        $carroVenta["unidad"] = $nuevoValor;
                        break;
                    case 3: # Tomar Precio Caja
                        //dd($nuevoValor);
                        if ($nuevoValor) {
                            $carroVenta["precio"] = $carroVenta["pvpr"];
                            $carroVenta["total"] = $carroVenta["unidad"] * $carroVenta["pvpr"];
                        } else {
                            if ($carroVenta["presentacion"] == "UNIDAD") {
                                $carroVenta["precio"] = $carroVenta["pvpu"];
                            } else {
                                $carroVenta["precio"] = $carroVenta["pvpc"];
                            }
                            $carroVenta["total"] =  $carroVenta["unidad"] * $carroVenta["precio"];
                        }
                        $carroVenta["siPvpr"] = $nuevoValor;
                        break;
                }
                $carroVenta = $carroVenta;
            }
        }
        $this->carroVenta = $this->carroVenta;
        $this->calcularTotalCarrito();
    }
    public function eliminarCarrito($idProducto)
    {
        foreach ($this->carroVenta as $carroVenta) {
            if ($carroVenta["id"] == $idProducto) {
                unset($this->carroVenta[array_keys($this->carroVenta, $carroVenta)[0]]);
            }
        }
        $this->carroVenta = $this->carroVenta;
        if (count($this->carroVenta) == 0) {
            $this->totalCarrito = 0;
        } else {
            $this->calcularTotalCarrito();
        }
    }
    public function limpiarCarrito()
    {
        $this->carroVenta = [];
        $this->totalCarrito = 0;
    }
    public function calcularTotalCarrito()
    {
        $this->totalCarrito = 0;
        foreach ($this->carroVenta as $carroVenta) {
            $this->totalCarrito = $this->totalCarrito  + ($carroVenta["unidad"] * $carroVenta["total"]);
        }
    }
    public function relizarCompra()
    {
        $fillable = [
            "product_id",
            "movement_id",
            "box",
            "unit",
            "total",
            "date_movement"
        ];
        foreach ($this->carroVenta as $carroVenta) {
            $fillable = [
                "product_id"    => $carroVenta["id"],
                "movement_id"   => 2,
                "box"           => ($carroVenta["presentacion"] == "UNIDAD") ? 0  : $carroVenta["unidad"],
                "unit"          => ($carroVenta["presentacion"] == "UNIDAD") ? $carroVenta["unidad"]  : $carroVenta["unidadProducto"],
                "total"         => ($carroVenta["presentacion"] == "UNIDAD") ? $carroVenta["unidad"]  : $carroVenta["unidad"] *  $carroVenta["unidadProducto"],
                "date_movement" => now()
            ];
            InventoryMovement::create($fillable);
        }
        $this->dispatchBrowserEvent('swalAlertdialog', [
            'title' => 'Movimiento Ingresado',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
        $this->limpiarCarrito();
    }
}
