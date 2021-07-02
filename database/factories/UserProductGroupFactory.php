<?php

namespace Database\Factories;

use App\Models\UserProductGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserProductGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProductGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::Factory(),
            "discount" => $this->faker->numberBetween($min = 10, $max = 20)
        ];
    }
}
