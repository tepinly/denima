@extends('layouts.app', ['product' => $product])

@section('content')
    <div class="container">
        <h3 class="theme">{{ $product->name }}</h3>
        <div class="product-upper d-flex flex-wrap align-items-center">
            <div class="main-product text-center">
                <img class="main-img mr-2" id="main-img" src="{{ asset('storage/images/' . $colors[0]->image) }}" alt="">
                <div class="color-switch d-flex justify-content-center mt-3">
                    @foreach ($colors as $color)
                        <button id="{{ $color->id }}"
                            style="background-color: {{ $color->color }}; border: 4px solid {{ $color->color }};"
                            class="color-btn mr-2" onclick="changeColor('{{ $color->image }}', '{{ $color->id }}')">

                        </button>
                    @endforeach
                </div>
            </div>

            <div class="product-interaction mt-4 pt-3 justify-self-right">
                <h4 class="theme">Sizes Available</h4>
                @foreach ($sizes as $size)
                    @if ($size->available($size->id))
                        <p style="display: inline-block">
                            {{ $size->value }} @if (!$loop->last) | @endif
                        </p>
                    @else
                    @endif
                @endforeach
                <h4 class="theme mb-4">Price: <span class="h5 text-success">${{ $product->price }}</span></h4>
                @if (!checkStock($product->id))
                    <h4 style="color:brown;">Out of Stock</h4>
                @else
                    <form action="{{ route('addcart', ['product_id' => $product->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-default">Add to Cart</button>
                    </form>
                    <form method="POST" action="{{ route('checkoutcart', ['product_id' => $product->id]) }}"
                        class="card-form mt-2">
                        @csrf
                        <button type="submit" class="btn btn-default pay">
                            Instant Checkout
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeColor(image, color) {
            document.querySelector('#main-img').src=`{{ asset('storage/images/' . '${image}' ) }}`;
        }

    </script>
@endsection
