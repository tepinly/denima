<?php

use Illuminate\Support\Facades\Auth;
use App\Models\ProductSize;

if (!function_exists('checkStock')) {
    function checkStock($product_id) {
        $sizes = ProductSize::where('product_id', $product_id)->get();
        foreach ($sizes as $size) {
            if($size->stock > 0) return true;
        }
        return false;
    }
}

if (!function_exists('cartList')) {
    function cartIndex($id) {
        echo '<div class="card" style="margin: 0; padding: 20px">' . $id['name'] .
            '<form action="{{ route(\'deletecart\') }}" method="POST">
            <button type="submit">Remove</button>
            </form></div>';
    }
}


if (!function_exists('returnItem')) {
    function returnItem($item) {
        return $item;
    }
}
