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
            'sale_id'       => $this->sale_id,
            'product_id'    => $this->client_id,
            'unit'          => $this->user_id,
            'price'         => $this->formPayment->description,
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
