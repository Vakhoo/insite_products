<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\UserProductGroup;
use App\Models\cart;
use App\Models\ProductGroupItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(4)->create();


        $product = Product::factory(3)->create([
            "user_id"=>10
        ]);
        Product::factory(3)->create();


        $group = UserProductGroup::factory()->create([
            "user_id"=>10
        ]);
        UserProductGroup::factory(3)->create();


        ProductGroupItem::factory()->create([
            "product_id" =>1,
            "group_id" =>1
        ]);
        ProductGroupItem::factory()->create([
            "product_id" =>2,
            "group_id" =>1
        ]);
        ProductGroupItem::factory()->create([
            "product_id" =>3,
            "group_id" =>2
        ]);


        for ($i=1; $i < 5; $i++) { 
            cart::factory()->create([
            "user_id" => 15,
            "product_id" =>$i
        ]);
        }

        cart::factory(3)->create([
            "user_id" =>15
        ]);
        cart::factory(3)->create();
    }
}
