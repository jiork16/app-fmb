<?php

namespace App\Http\Livewire;

use App\Models\Laboratory;
use App\Models\Product;
use App\Models\ProductTypes;
use App\Models\Sale;
use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $totales["clientes"] = 0;
        $totales["proveedores"] = Supplier::all()->count();
        $totales["tipoMedicamento"] = ProductTypes::all()->count();
        $totales["laboratorios"] = Laboratory::all()->count();
        $totales["productos"] = Product::productsActive("")->count();
        $totales["ventas"] = Sale::sales()->count();
        return view('livewire.index', compact("totales"));
    }
}
