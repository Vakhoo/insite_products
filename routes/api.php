<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductGroupItem;
use App\Http\Controllers\ProductController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// დამატებულია სიდერებიც


Route::post("/cart/add", [ProductController::class, "addProductInCart"]);

Route::post("/cart/remove", [ProductController::class, "removeProductFromCart"]);


Route::post("/cart/set", [ProductController::class, "setCartProductQuantity"]);

Route::get("/cart/products/{user_id}", [ProductController::class, "getUserCart"]);