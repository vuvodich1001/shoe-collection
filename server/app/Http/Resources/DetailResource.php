<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'color' => $request->method == 'update' ? $this->color->id : $this->color->name,
            'size' => $request->method == 'update' ? $this->size->id : $this->size->name,
            'quantity' => $this->quantity,
            'stock' => $this->stock
        ];
    }
}
