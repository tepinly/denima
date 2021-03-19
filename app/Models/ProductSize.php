<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    public function products() {
        $this->belongsTo(Product::class);
    }

    public static function getSizes($product_id) {
        $sizes = ProductSize::where('product_id', $product_id)->get();
        return $sizes;
    }

    public static function available($id) {
        $size = ProductSize::find($id);
        return $size->stock > 0 ? true : false;
    }
}
