<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'product_id'    => $this->product_id,
            'unit'          => $this->unit,
            'price'         => $this->price,
            'sub_total'     => $this->sub_total,
            'discount'      => $this->discount,
            'base_iva_0'    => $this->base_iva_0,
            'base_iva_12'   => $this->base_iva_12,
            'total'         => $this->total,
            'producto'      => $this->products->description
        ];
        //return parent::toArray($request);
    }
}
