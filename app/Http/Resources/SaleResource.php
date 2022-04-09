<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'id'                => $this->id,
            'client_id'         => $this->client_id,
            'user_id'           => $this->user_id,
            'form_payment_id'   => $this->formPayment->description,
            'sub_total'         => $this->sub_total,
            'discount'          => $this->discount,
            'base_iva_0'        => $this->base_iva_0,
            'base_iva_12'       => $this->base_iva_12,
            'total'             => $this->total,
            'date_sale'         => $this->date_sale,
            'detalle'           => new DetailSaleResource($this->detailSales[0])
        ];
        //return parent::toArray($request);
    }
}
