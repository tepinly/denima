<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'productsMen' => Product::latestProducts(5, 1),
            'productsWomen' => Product::latestProducts(5, 2),
            'productsChildren' => Product::latestProducts(5, 3),
        ]);
    }
}
