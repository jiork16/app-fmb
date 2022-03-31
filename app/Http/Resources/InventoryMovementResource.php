<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryMovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'stockUnidad'   => parent::toArray($request)['totalStockUnidad'],
            'stockCaja'     => parent::toArray($request)['totalStockCaja'],
            'producto'      => $this->products,
            'laboratorio'   => $this->products->laboratory
        ];
        // return parent::toArray($request);
    }
}
