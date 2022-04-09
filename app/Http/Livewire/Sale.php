<?php

namespace App\Http\Livewire;

use stdClass;

use App\Traits\SortBy;
use Livewire\Component;
use App\Models\DetailSale;
use Livewire\WithPagination;
use App\Models\InventoryMovement;
use App\Models\Sale as ModelsSale;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\InventoryMovementResource;

use function PHPUnit\Framework\isNull;

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
    public $perPage  = 5;
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
    /**
     * Se almacenaran los tipo de venta de medicamento
     *
     * @var object
     */
    public $tipoPresentacion = ['UNIDAD', 'CAJA'];
    /**
     * Renderizar el componete con las listas de transacciones realizadas
     *
     *
     * @return \Illuminate\Http\Response
     */
    public $fechMaxInvent;
    public float $totalCarrito = 0.00;
    public int $idproductoSelect = 0;
    public $productoName;
    protected $listeners = ['agregar' => 'agregarCarrito', 'setProductoSelect'];
    public $carroVenta = [];
    public function getProductoNombreProperty()
    {
        return $this->productoName;
    }
    public function render()
    {
        session()->flash('Modulo', 'Venta');
        $this->fechMaxInvent = InventoryMovement::maxiInvent()->get()[0]->fecha;
        $data = QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search))->paginate($this->perPage);
        $inventarioData = InventoryMovementResource::collection(
            $data
        )->response()->getData();
        $inventarioData->paginate = $data;
        return view('livewire.sales.sales', ['inventarioData' =>  $inventarioData, 'carroVenta' => $this->carroVenta]);
    }
    public function agregarCarrito($presentacion, $cantidad, $siPvpr)
    {
        $object = new stdClass;
        $datoProducto = InventoryMovementResource::collection(
            QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search, $this->idproductoSelect))->get()
        )->response()->getData();
        foreach ($datoProducto->data as $producto) {
            $object->idCarro        = uniqid(true);
            $object->id             = $producto->producto->id;
            $object->description    = $producto->producto->description;
            $object->pvpu           = $producto->producto->pvpu;
            $object->pvpc           = $producto->producto->pvpc;
            $object->pvpr           = $producto->producto->pvpr;
            $object->cantidad       = $cantidad;
            $object->unidadProducto = $producto->producto->unit;
            if ($siPvpr) {
                $object->precio     = $producto->producto->pvpr;
                $object->total      = $cantidad * $producto->producto->pvpr;
            } else {
                $object->precio         = ($presentacion == "UNIDAD") ? $producto->producto->pvpu : $producto->producto->pvpc;
                $object->total          = ($presentacion == "UNIDAD") ? $cantidad *  $producto->producto->pvpu : $cantidad *  $producto->producto->pvpc;
            }
            $object->siPvpr         = $siPvpr;
            $object->presentacion   = $presentacion;
        }
        array_push($this->carroVenta, (array) $object);
        $this->calcularTotalCarrito();
    }
    public function cambioRegistroCarro($idCarro, $tipoCambio, $nuevoValor)
    {

        foreach ($this->carroVenta as &$carroVenta) {

            if ($carroVenta["idCarro"] == $idCarro) {
                switch ($tipoCambio) {
                    case 1:  # Presentacion
                        //dd($nuevoValor);
                        if ($nuevoValor == "UNIDAD") {
                            $carroVenta["precio"] = $carroVenta["pvpu"];
                            $carroVenta["total"] =  $carroVenta["cantidad"] * $carroVenta["pvpu"];
                        } else {
                            $carroVenta["total"] =  $carroVenta["cantidad"] * $carroVenta["pvpc"];
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
                        $carroVenta["cantidad"] = $nuevoValor;
                        break;
                    case 3: # Tomar Precio Caja
                        //dd($nuevoValor);
                        if ($carroVenta["siPvpr"] != $nuevoValor) {
                            if ($nuevoValor) {
                                $carroVenta["precio"] = $carroVenta["pvpr"];
                                $carroVenta["total"] = $carroVenta["cantidad"] * $carroVenta["pvpr"];
                            } else {
                                if ($carroVenta["presentacion"] == "UNIDAD") {
                                    $carroVenta["precio"] = $carroVenta["pvpu"];
                                } else {
                                    $carroVenta["precio"] = $carroVenta["pvpc"];
                                }
                                $carroVenta["total"] =  $carroVenta["cantidad"] * $carroVenta["precio"];
                            }
                            $carroVenta["siPvpr"] = $nuevoValor;
                        }
                        break;
                }
                $carroVenta = $carroVenta;
                break 1;
            }
        }
        $this->carroVenta = $this->carroVenta;
        $this->calcularTotalCarrito();
    }
    public function eliminarCarrito($idCarro)
    {
        foreach ($this->carroVenta as $carroVenta) {
            if ($carroVenta["idCarro"] == $idCarro) {
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
            $this->totalCarrito = $this->totalCarrito  + $carroVenta["total"];
        }
    }
    public function relizarCompra()
    {
        foreach ($this->carroVenta as $carroVenta) {
            $fillableMovimiento = [
                "product_id"    => $carroVenta["id"],
                "movement_id"   => 2,
                "box"           => ($carroVenta["presentacion"] == "UNIDAD") ? 0  : $carroVenta["cantidad"],
                "unit"          => ($carroVenta["presentacion"] == "UNIDAD") ? $carroVenta["cantidad"]  : $carroVenta["unidadProducto"],
                "total"         => ($carroVenta["presentacion"] == "UNIDAD") ? $carroVenta["cantidad"]  : $carroVenta["cantidad"] *  $carroVenta["unidadProducto"],
                "date_movement" => now()
            ];
            InventoryMovement::create($fillableMovimiento);
        }
        $fillableSale = [
            "client_id"         => 1,
            "user_id"           => Auth::user()->id,
            "form_payment_id"   => 1,
            "sub_total"         => $this->totalCarrito,
            "discount"          => 0,
            "base_iva_0"        => 0,
            "base_iva_12"       => 0,
            "total"             => $this->totalCarrito,
            "date_sale"         => now()
        ];
        $sale = ModelsSale::create($fillableSale);
        foreach ($this->carroVenta as $carroVenta) {
            $fillableDetail = [
                "sale_id"       => $sale->id,
                "product_id"    => $carroVenta["id"],
                "unit"          => $carroVenta["cantidad"],
                "price"         => $carroVenta["precio"],
                "sub_total"     => $carroVenta["total"],
                "discount"      => 0,
                "base_iva_0"    => 0,
                "base_iva_12"   => 0,
                "total"         => $carroVenta["total"],
            ];
            DetailSale::create($fillableDetail);
        }
        $this->dispatchBrowserEvent('swalAlertdialog', [
            'title' => 'Movimiento Ingresado',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
        $this->limpiarCarrito();
    }
    public function setProductoSelect($idproducto, $producto, $show = true)
    {
        $this->idproductoSelect = $idproducto;
        $this->productoName = $producto;
        $this->dispatchBrowserEvent('showmodal', ['show' => $show]);
        if ($show == false) {
            usleep(50); # Wait...
        }
    }
}
