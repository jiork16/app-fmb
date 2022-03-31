<?php

namespace App\Http\Livewire;

use App\Http\Resources\InventoryMovementResource;
use App\Models\Sale;
use Livewire\Component;
use Spatie\QueryBuilder\QueryBuilder;

class ListSale extends Component
{
    public function render()
    {

        $data = InventoryMovementResource::collection(QueryBuilder::for(Sale::sales())->paginate(10))->response()->getData();
        return view('livewire.sales.list-sale', compact('data'));
    }
}
