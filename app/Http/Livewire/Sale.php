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
     * Ordenar los registros segun la columna.
     *
     * @var string
     */
    public $orderBy =  'products.description';
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
    public float $totalDescuento = 0.00;
    public int $idproductoSelect = 0;
    public float $subTotal = 0.00;
    public int $cantidaProducto = 1;
    public $presentacion = "";
    public bool $siPvpr = false;
    protected $listeners = ['agregar' => 'agregarCarrito', 'setProduct' => 'setProductoSelect'];
    public $carroVenta = [];
    public function render()
    {
        session()->flash('Modulo', 'Venta');
        $this->fechMaxInvent = InventoryMovement::maxiInvent()->get()[0]->fecha;
        $data = QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search, 0, $this->orderBy, $this->orderAsc))->paginate($this->perPage);
        $inventarioData = InventoryMovementResource::collection(
            $data
        )->response()->getData();

        $inventarioData->paginate = $data;

        return view('livewire.sales.sales', ['inventarioData' =>  $inventarioData, 'carroVenta' => $this->carroVenta]);
    }
    public function agregarCarrito()
    {
        if ($this->presentacion != "") {
            $object = new stdClass;
            $datoProducto = InventoryMovementResource::collection(
                QueryBuilder::for(InventoryMovement::stock($this->fechMaxInvent, $this->search, $this->idproductoSelect))->get()
            )->response()->getData();
            foreach ($datoProducto->data as $producto) {
                $descuento              = $producto->producto->porcen_discount;
                $pvu                    = $descuento > 0 ? $producto->producto->pvpu_discount : $producto->producto->pvpu;
                $pvc                    = $descuento > 0 ? $producto->producto->pvpc_discount : $producto->producto->pvpc;
                $object->idCarro        = uniqid(true);
                $object->id             = $producto->producto->id;
                $object->description    = $producto->producto->description;
                $object->pvpu           = $producto->producto->pvpu;
                $object->pvpc           = $producto->producto->pvpc;
                $object->pvpr           = $producto->producto->pvpr;
                $object->pvpud          = $pvu;
                $object->pvpcd          = $pvc;
                $object->cantidad       = $this->cantidaProducto;
                $object->unidadProducto = $producto->producto->unit;
                if ($this->siPvpr) {
                    $object->precio     =   $object->pvpr;
                    $object->total      =  $this->cantidaProducto * $object->pvpr;
                } else {
                    $object->precio     = ($this->presentacion == "UNIDAD") ? $pvu : $pvc;
                    $object->total      = ($this->presentacion == "UNIDAD") ? $this->cantidaProducto *  $pvu : $this->cantidaProducto *   $pvc;
                }
                $object->descuento = 0;
                if ($descuento > 0) {
                    $object->descuento  = ($this->presentacion == "UNIDAD")  ? $pvu : $pvc;
                }
                $object->siPvpr         = $this->siPvpr;
                $object->presentacion   = $this->presentacion;
            }
            array_push($this->carroVenta, (array) $object);
            $this->calcularTotalCarrito();
            $this->cantidaProducto = 1;
        } else {
            $this->dispatchBrowserEvent('swalAlertdialog', [
                'title' => 'Presentacion',
                'icon' => 'warning',
                'confirmButtonText' => 'OK'
            ]);
        }
        $this->presentacion = "";
    }
    public function cambioRegistroCarro($idCarro, $tipoCambio, $nuevoValor)
    {

        foreach ($this->carroVenta as &$carroVenta) {

            if ($carroVenta["idCarro"] == $idCarro) {
                switch ($tipoCambio) {
                    case 1:  # Presentacion
                        //dd($nuevoValor);
                        if ($nuevoValor == "UNIDAD") {
                            $carroVenta["precio"]       = $carroVenta["descuento"] > 0 ? $carroVenta["pvpud"] : $carroVenta["pvpu"];
                            $carroVenta["total"]        = $carroVenta["cantidad"] * $carroVenta["precio"];
                        } else {
                            $carroVenta["precio"]       = $carroVenta["descuento"] > 0 ? $carroVenta["pvpcd"] : $carroVenta["pvpc"];
                            $carroVenta["total"]        = $carroVenta["cantidad"] * $carroVenta["precio"];
                        }
                        $carroVenta["presentacion"]     = $nuevoValor;
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
                                    $carroVenta["precio"] = $carroVenta["descuento"] > 0 ? $carroVenta["pvpud"] : $carroVenta["pvpu"];
                                } else {
                                    $carroVenta["precio"] = $carroVenta["descuento"] > 0 ? $carroVenta["pvpcd"] : $carroVenta["pvpc"];
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
        $this->totalDescuento = 0;
        $this->subTotal = 0;
    }
    public function calcularTotalCarrito()
    {
        $this->totalCarrito = 0;
        $this->totalDescuento = 0;
        $this->subTotal = 0;
        foreach ($this->carroVenta as $carroVenta) {
            if ($carroVenta["siPvpr"]) {
                $this->subTotal  = $this->subTotal + $carroVenta["pvpr"];
            } else {
                if ($carroVenta["presentacion"]  == "UNIDAD") {
                    $this->subTotal  =  $this->subTotal + $carroVenta["pvpu"];
                } else {
                    $this->subTotal  =  $this->subTotal + $carroVenta["pvpc"];
                }
                $this->totalCarrito = $this->totalCarrito  + $carroVenta["total"];
                $this->totalDescuento = $this->totalDescuento  + ($carroVenta["descuento"] *  $carroVenta["cantidad"]);
            }
        }
    }
    public function relizarVenta()
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
            "sub_total"         => $this->subTotal,
            "discount"          => $this->totalDescuento > 0 ? ($this->subTotal - $this->totalDescuento) : 0,
            "base_iva_0"        => 0,
            "base_iva_12"       => 0,
            "total"             => $this->totalCarrito,
            "date_sale"         => now()
        ];
        $sale = ModelsSale::create($fillableSale);
        foreach ($this->carroVenta as $carroVenta) {
            $descuento  = 0;
            $precio   = 0;
            if ($carroVenta["siPvpr"] == false) {
                $precio             = $carroVenta["presentacion"] == "UNIDAD" ?  $carroVenta["pvpu"] : $carroVenta["pvpc"];
                if ($carroVenta["descuento"] > 0) {
                    $descuento             = $carroVenta["presentacion"] == "UNIDAD" ?  $carroVenta["pvpud"] : $carroVenta["pvpcd"];
                }
            } else {
                $precio             = $carroVenta["pvpr"];
            }
            $fillableDetail = [
                "sale_id"       => $sale->id,
                "product_id"    => $carroVenta["id"],
                "unit"          => $carroVenta["cantidad"],
                "price"         => $precio,
                "sub_total"     => $precio * $carroVenta["cantidad"],
                "discount"      => $descuento > 0 ? (($precio * $carroVenta["cantidad"]) - ($descuento * $carroVenta["cantidad"])) : 0,
                "base_iva_0"    => 0,
                "base_iva_12"   => 0,
                "total"         => $carroVenta["total"],
            ];
            DetailSale::create($fillableDetail);
        }
        if (DetailSale::where('sale_id', $sale->id,)->count() == count($this->carroVenta)) {
            $this->dispatchBrowserEvent('swalAlertdialog', [
                'title' => 'Movimiento Ingresado',
                'icon' => 'success',
                'confirmButtonText' => 'OK'
            ]);
            $this->limpiarCarrito();
        } else {
            $this->dispatchBrowserEvent('swalAlertdialog', [
                'title' => 'Problema al ingresar el Movimiento',
                'icon' => 'error',
                'confirmButtonText' => 'OK'
            ]);
        }
    }
    public function setProductoSelect($idproducto)
    {
        $this->idproductoSelect = $idproducto;
    }
}
