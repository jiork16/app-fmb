<?php

namespace App\Http\Livewire;

use stdClass;
use App\Models\Sale;
use App\Traits\SortBy;
use Livewire\Component;
use App\Models\DetailSale;
use Livewire\WithPagination;
use App\Http\Resources\SaleResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\DetailSaleResource;


class ListSale extends Component
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
    public $startDate = '';
    public $endDate = '';
    public $totalVendido = 0.00;
    private $saleDetalle = [];
    public function render()
    {
        session()->flash('Modulo', 'Reporte Venta');
        $data = QueryBuilder::for(Sale::sales($this->startDate, $this->endDate))->paginate($this->perPage);
        $saleDataP =  SaleResource::collection(
            $data
        )->response()->getData();

        $saleDataP->paginate = $data;
        $this->obtenerVemtaTotal($saleDataP);

        return view('livewire.sales.list-sale', ['saleData' => $saleDataP, 'saleDetalle' => $this->saleDetalle]);
    }
    public function obtenerVemtaTotal($datos)
    {
        $this->totalVendido = 0;
        foreach ($datos->data as $dato) {
            $this->totalVendido = $this->totalVendido + $dato->total;
        }
    }
    public function obtenerDetalle($idSale)
    {
        $datas =  DetailSaleResource::collection(
            QueryBuilder::for(DetailSale::where("sale_id", "=", $idSale))->get()
        )->response()->getData();
        $object = new stdClass;
        foreach ($datas->data as $data) {
            $object->product_id     =   $data->product_id;
            $object->unit           =   $data->unit;
            $object->price          =   $data->price;
            $object->sub_total      =   $data->sub_total;
            $object->discount       =   $data->discount;
            $object->base_iva_0     =   $data->base_iva_0;
            $object->base_iva_12    =   $data->base_iva_12;
            $object->total          =   $data->total;
            $object->producto       =   $data->producto;
            array_push($this->saleDetalle, (array) $object);
        }
        $this->saleDetalle = json_decode(json_encode($this->saleDetalle));
    }
}
