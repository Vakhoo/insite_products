<?php

namespace Database\Factories;

use App\Models\cart;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
class cartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::Factory(),
            "product_id" => Product::Factory(),
            "quantity" => $this->faker->randomDigitNotNull
        ];
    }
}


