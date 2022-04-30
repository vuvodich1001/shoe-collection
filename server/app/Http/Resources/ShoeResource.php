<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShoeResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand->name,
            'category' => $this->category->name,
            'gender' => $this->gender,
            'defaultImage' => $this->colors()->where('default', 1)->select('image')->orderBy('images.id', 'asc')->first(),
            'subImage' => $this->colors()->select('colors.name as color', 'image', 'default')->orderBy('images.id', 'asc')->get(),
            'detail' => DetailResource::collection($this->shoeDetails),
        ];
    }
}
