@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        @if (session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif

        <h1 class="mb-4 theme">Our Latest Arrivals</h1>
        <div class="home-section m-2 mt-0">
            <h2 class="theme">Men</h2>
            <div class="d-flex flex-wrap p-2 align-items-end">
                @foreach ($productsMen as $product)
                    <div class="panel m-3">
                        <a href="{{ route('product', ['product_id' => $product->id]) }}"><img src="{{ asset('storage/images/' . $product->image($product->id)) }}"
                            alt="{{ $product->image($product->id) }}" class="img-fluid img-small"></img></a>
                        <div class="pt-1 pb-1 pl-2 pr-2 product-info d-flex justify-content-around">
                            <div>
                                <a href="{{ route('product', ['product_id' => $product->id]) }}" class="prod-label my-1">{{ $product->name }}</a>
                                <p class="my-1 text-success">{{ "$" . $product->price }}</p>
                            </div>
                            <div class="mt-1">
                                <form action="{{ route('addcart', ['product_id' => $product->id]) }}" method="POST" class="ml-3 my-0 p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-icon"><i class="fas fa-cart-plus product-action p-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="home-section m-4 mt-0">
            <h2 class="theme">Women</h2>
            <div class="d-flex flex-wrap p-2 align-items-end">
                @foreach ($productsWomen as $product)
                    <div class="panel m-3">
                        <a href="{{ route('product', ['product_id' => $product->id]) }}"><img src="{{ asset('storage/images/' . $product->image($product->id)) }}"
                            alt="{{ $product->image($product->id) }}" class="img-fluid img-small"></img></a>
                        <div class="pt-1 pb-1 pl-2 pr-2 product-info d-flex justify-content-around">
                            <div>
                                <p class="my-1"><a href="{{ route('product', ['product_id' => $product->id]) }}" class="prod-label">{{ $product->name }}</a></p>
                                <p class="my-1 text-success">{{ "$" . $product->price }}</p>
                            </div>
                            <div class="mt-1">
                                <form action="{{ route('addcart', ['product_id' => $product->id]) }}" method="POST" class="ml-3 my-0 p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-icon"><i class="fas fa-cart-plus product-action p-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="home-section m-4 mt-0">
            <h2 class="theme">Children</h2>
            <div class="d-flex flex-wrap p-2 align-items-end">
                @foreach ($productsChildren as $product)
                    <div class="panel m-3                             ">
                        <a href="{{ route('product', ['product_id' => $product->id]) }}"><img src="{{ asset('storage/images/' . $product->image($product->id)) }}"
                            alt="{{ $product->image($product->id) }}" class="img-fluid img-small"></img></a>
                        <div class="pt-1 pb-1 pl-2 pr-2 product-info d-flex justify-content-around">
                            <div>
                                <p class="my-1"><a href="{{ route('product', ['product_id' => $product->id]) }}" class="prod-label">{{ $product->name }}</a></p>
                                <p class="my-1 text-success">{{ "$" . $product->price }}</p>
                            </div>
                            <div class="mt-1">
                                <form action="{{ route('addcart', ['product_id' => $product->id]) }}" method="POST" class="ml-3 my-0 p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-icon"><i class="fas fa-cart-plus product-action p-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
