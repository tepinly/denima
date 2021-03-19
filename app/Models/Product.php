<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories() {
        $this->BelongsTo(Category::class, 'category_id')->withTimestamps();
    }

    public function product_sizes() {
        $this->hasMany(ProductSize::class);
    }

    public function product_color_images() {
        $this->hasMany(ProductColorImage::class);
    }

    public static function getProduct($product_id) {
        $product = Product::where('id', $product_id)->first();
        return $product;
    }

    public static function category($n) {
        $products = Product::where('category_id', $n)->get();
        return $products;
    }

    public static function latestProducts($num, $category) {
        $products = Product::latest()->where('category_id', $category)->where('stock', '>', '0')->limit($num)->get();
        return $products;
    }

    public static function sizes($product_id) {
        $sizes = ProductSize::where('product_id', $product_id)->get();
        return $sizes;
    }

    public static function images($product_id) {
        $images = ProductColorImage::where('product_id', $product_id)->get();
        return $images;
    }

    public static function image($product_id) {
        $image = ProductColorImage::where('product_id', $product_id)->value('image');
        return $image;
    }
}
