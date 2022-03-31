<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Carrito extends Component
{
    public $carroVentaHijo;
    public function render()
    {

        return view('livewire.carro.carrito', ['carroVenta' => $this->carroVentaHijo]);
    }
}
