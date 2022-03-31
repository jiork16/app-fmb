<?php

namespace App\Http\Livewire;

use App\Traits\SortBy;
use Livewire\Component;
use App\Models\Products;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\GenericResource;

class ListProduct extends Component
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
    public $orderBy =  'products.id';
    /**
     * Ordenar de manera ascendente o descendente
     *
     * @var boolean
     */
    public $orderAsc = true;

    /**
     * Renderizar el componete con las listas de transacciones realizadas
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        session()->flash('Modulo', 'Product');
        $data = Products::leftJoin('laboratories', function ($join) {
            $join->on('laboratories.id', '=', 'products.laboratorie_id');
        })
            ->where(function ($query) {
                $query->where('products.description', 'like', '%' . $this->search . '%')
                    ->orWhere('products.utility', 'like', '%' . $this->search . '%')
                    ->orWhere('laboratories.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        //dd($data);
        return view('livewire.product.list-product', compact('data'));
    }
}
