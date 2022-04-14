<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    private $arrSize = [36, 37, 38, 39, 40, 41, 42];
    private $arrBrand = ['nike', 'addidas', 'vans'];
    private $arrColor = ['black', 'yellow', 'blue', 'red', 'white'];
    private $arrGender = ['male', 'female'];

    public function definition() {
        return [
            'name' => $this->faker->name(),
            'brand' => $this->faker->randomElement($this->arrBrand),
            'size' => $this->faker->randomElement($this->arrSize),
            'color' => $this->faker->randomElement($this->arrColor),
            'price' => $this->faker->numberBetween(500000.0, 3000000.0),
            'gender' => $this->faker->randomElement($this->arrGender)
        ];
    }
}
