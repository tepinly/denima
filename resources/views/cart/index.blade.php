@extends('layouts.app', ['cart' => $cart])

@section('content')
    <div class="container">
        @if (!$cart)
            <h1 class="theme text-center mt-4">Cart is currently empty</h1>
        @else
            @foreach ($cart as $item)
                <div class="d-flex justify-content-between align-items-center cart-panel py-2">
                    <div class="d-flex align-items-center">
                        <p>
                            <img src="{{ asset('storage/images/' . $item['image']) }}" alt="" class="cart-image">
                        </p>
                        <p class="ml-3"><span class="theme font-weight-bold">{{ $item['name'] }}</span><br>Quanatity:
                            {{ $item['quantity'] }}<br>${{ $item['price'] }}</p>
                    </div>
                    <form action="{{ route('deletecart', ['product_id' => $item['id']]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-default">Remove</button>
                    </form>
                </div>
            @endforeach

            <div class="checkout-box">
                <h5 class="theme">Total: <span style="font-size: medium">${{ $total }}</span></h5>
                <h4 class="theme mt-4">Proceed to checkout</h4>
                <form method="POST" action="{{ route('cart.purchase') }}" class="card-form mt-3 mb-3">
                    @csrf
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="payment_method" class="payment-method">
                    
                    <input class="StripeElement mb-2 input-field" name="card_holder_name" placeholder="Card holder name"
                        required>
                    <div class="col-lg-4 col-md-6">
                        <div id="card-element" class="input-field"></div>
                    </div>
                    <div id="card-errors" role="alert"></div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-default pay">
                            Checkout
                        </button>
                    </div>
                </form>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe("{{ env('STRIPE_KEY') }}")
        let elements = stripe.elements()
        let style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
        let card = elements.create('card', {
            style: style
        })

        card.mount('#card-element')
        let paymentMethod = null

        $('.card-form').on('submit', function(e) {
            $('button.pay').attr('disabled', true)
            if (paymentMethod) {
                return true
            }
            stripe.confirmCardSetup(
                "{{ $intent->client_secret }}", {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: $('.card_holder_name').val()
                        }
                    }
                }
            ).then(function(result) {
                if (result.error) {
                    $('#card-errors').text(result.error.message)
                    $('button.pay').removeAttr('disabled')
                } else {
                    paymentMethod = result.setupIntent.payment_method
                    $('.payment-method').val(paymentMethod)
                    $('.card-form').submit()
                }
            })
            return false
        })

    </script>
@endsection
