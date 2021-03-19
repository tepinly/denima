@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="theme">{{ $category }}</h1>
        <div class="d-flex flex-wrap p-2 align-items-end">
            @foreach ($products as $product)
                <div class="panel m-3">
                    <a href="{{ route('product', ['product_id' => $product->id]) }}"><img src="{{ asset('storage/images/' . $product->image($product->id)) }}"
                        alt="ID: {{ $product->image($product->id) }}" class="img-fluid img-small"></img></a>
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
@endsection
