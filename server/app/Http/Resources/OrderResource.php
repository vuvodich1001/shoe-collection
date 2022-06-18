<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'total' => $this->total,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'shipping_fee' => $this->shipping_fee,
            'create_date' => $this->created_at,
            'address' => $this->address,
            'shoes' => OrderDetailResource::collection($this->shoes)
        ];
    }
}
