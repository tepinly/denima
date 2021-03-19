<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use function PHPSTORM_META\map;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::getProduct($id);
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $id => [
                    "id" => $id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image($id)
                ]
            ];

            session()->put('cart', $cart);
        }
        // if cart not empty then check if this product exist then increment quantity
        else if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }
        // if item not exist in cart then add to cart with quantity = 1
        else {
            $cart[$id] = [
                "id" => $id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image($id)
            ];

            session()->put('cart', $cart);
        }

        return back();
    }

    public function removeFromCart($id) {
        $product = Product::getProduct($id);
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back();
    }

    public function checkoutCart($id) {
        $this->addToCart($id);
        return $this->index();
    }

    public function index() {
        if(!auth()->user()) {
            return redirect(route('login'));
        }
        $cart = session()->get('cart');
        $intent = auth()->user()->createSetupIntent();
        $total = 0;

        if($cart) {
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('cart/index', [
            'cart' => $cart,
            'total' => $total,
            'intent' => $intent
        ]);
    }

    public function purchase(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');
        $total = $request->total;

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        //$user->notify(new OrderProcessed($product));
        session()->forget('cart');
        return back()->with('message', 'Product purchased successfully!');
    }
}
