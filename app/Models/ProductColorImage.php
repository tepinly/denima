<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorImage extends Model
{
    use HasFactory;

    public function products() {
        $this->belongsTo(Product::class);
    }

    public static function getColors($product_id) {
        $colors = ProductColorImage::where('product_id', $product_id)->get();
        return $colors;
    }

    public static function image($color_id) {
        $image = ProductColorImage::where('id', $color_id)->value('image');
        return $image;
    }
}
