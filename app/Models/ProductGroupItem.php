<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\UserProductGroup;

class ProductGroupItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'group_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "product_id");
    }
    public function discount()
    {
        return $this->belongsTo(UserProductGroup::class, "group_id", "group_id");
    }
}
