<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductGroupItem;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'price',
    ];

    public function groupItem(){
        return $this->hasMany(ProductGroupItem::class, "product_id", "product_id");
    }
}
