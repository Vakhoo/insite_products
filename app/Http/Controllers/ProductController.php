<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductGroupItem;


class ProductController extends Controller
{
    
    public function addProductInCart(Request $req){

        // აქ პირობაში არ იყო უზერის ჩამატებაც მაგრამ აუცილებელია და ორივე დავტოვე
        if ($req["user_id"]) {
            return Cart::create([
            "user_id" => $req->user_id,
            "product_id" => $req->product_id,
        ]);
        }else{
            return Cart::create([

            "product_id" => $req->product_id,
            
        ]);

        }
    }

    public function removeProductFromCart(Request $req){

        return Cart::where("product_id", $req->product_id)->delete();
    }

    public function setCartProductQuantity(Request $req){

        return Cart::where("product_id", $req->product_id)->update([
        "quantity" => $req->quantity,]);
    }


    public function getUserCart($user_id){


    // cart -ში უნდა იყოს ისეთი პროდუქტი ჩამატებული, რომელი product ცხრილშიც არის
    // წინააღმდეგ შემთხვევაში ერორი დაბრუნდება

    $toReturn =[];
    $toReturnHelper =[];
    $discount = 0;



    $cartItems = Cart::with(["product" => function($query){
        return $query->select(["product_id", "price"]);
    }])->where("user_id", $user_id)->get(["user_id","product_id", "quantity"]);

    foreach ($cartItems as $cartItem) {
        $groupId = ProductGroupItem::select("group_id")->where("product_id", $cartItem->product_id)->get();

        $groupId = ProductGroupItem::select("group_id")->with("discount")->where("product_id", $cartItem->product_id)->first();
        if($groupId){
            $arr = [];
            $otherGroupId = ProductGroupItem::select("product_id")->where("group_id", $groupId->group_id)->get();
            foreach ($otherGroupId as $value) {
                array_push($arr, $value->product_id);            
            }
            $otherProduct = Cart::where("user_id", "=",$cartItem->user_id)->whereIn("product_id", $arr)->get();
            $minQuantity=$otherProduct[0]->quantity;
            foreach ($otherProduct as $value) {

                if ($minQuantity>$value->quantity) {
                    $minQuantity = $value->quantity;
                }
            }
            if ($otherProduct->count()==$otherGroupId->count()) {
                $diss = $groupId->discount->discount;
                $discount += ($cartItem->Product->price *$diss /100) * $minQuantity ;
            }
        }


        array_push($toReturnHelper, [
            "product_id" => $cartItem->product_id,
            "quantity" => $cartItem->quantity,
            "price" => $cartItem->Product->price
        ]);
    }
    $toReturn["products"] = $toReturnHelper;
    $toReturn["discount"]=$discount;

    return $toReturn;

}

}
