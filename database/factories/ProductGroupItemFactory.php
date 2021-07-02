<?php

namespace Database\Factories;

use App\Models\ProductGroupItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserProductGroup;
use App\Models\Product;
use App\Models\User;

class ProductGroupItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductGroupItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "group_id" => User::Factory(),
            "product_id" =>  Product::Factory()
        ];
    }
}
