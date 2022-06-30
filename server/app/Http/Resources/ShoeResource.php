<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShoeResource extends JsonResource {

    public function calculateRating($reviews) {
        $reviewLength = count($reviews);
        if ($reviewLength == 0) return 0;
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating +=  $review->rating;
        }
        return round($totalRating / $reviewLength);
    }

    public function calculateSaledQuantity($orders) {
        $total = 0;
        foreach ($orders as $order) {
            $total +=  $order->pivot->quantity;
        }
        return $total;
    }
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
            'brand' => $request->method == 'update' ? $this->brand->id : $this->brand->name,
            'category' => $request->method == 'update' ? $this->category->id : $this->category->name,
            'gender' => $this->gender,
            'totalRating' => $this->calculateRating($this->reviews),
            'saledQuantity' => $this->calculateSaledQuantity($this->orders),
            'defaultImage' => $this->colors()->where('default', 1)->select('image')->orderBy('images.id', 'asc')->first(),
            'subImage' => $this->colors()->select('colors.name as color', 'image', 'default')->orderBy('images.id', 'asc')->get(),
            'details' => DetailResource::collection($this->shoeDetails),
        ];
    }
}
