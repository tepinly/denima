<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColorImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products/index', [
            'categories' => Category::all()
        ]);
    }

    public function category($category_id)
    {
        return view('products/category', [
            'products' => Product::category($category_id),
            'category' => Category::getName($category_id)
        ]);
    }

    public function product($product_id)
    {
        return view('products/product', [
            'product' => Product::getProduct($product_id),
            'colors' => ProductColorImage::getColors($product_id),
            'sizes' => ProductSize::getSizes($product_id),
        ]);
    }
}
