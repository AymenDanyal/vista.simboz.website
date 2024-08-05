@extends('frontend.layouts.master')
@section('title', 'Cart Page')
@section('main-content')


<div class="container">
    <div class="row" >
        <div class="col-lg-6 col-12 wow fadeInLeft" style=" visibility: hidden; animation-delay: 0.4s; animation-name: none; padding: 20px 40px 0px 0px;">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex">
                        <h1 class="display-5">My Cart</h1>
                        <div class="d-flex ml-4">
                            <h2 class="display-6  ">
                                <span class="cart-quantity m-3"> {{ Helper::cartCount() }}</span>
                                <span class="visually-hidden"> items</span>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">

                    <ul class="list-unstyled mt-6">
                        @if (Helper::getAllProductFromCart())
                        @foreach (Helper::getAllProductFromCart() as $key => $cart)
                        <li id="cart-li-{{$cart->id}}" class="wow fadeInLeft" style="visibility: hidden; animation-delay: 0.6s">
                            <hr class="divider">
                            <div class="row">
                                <div class="col-3">
                                    <div class="grid-container">
                                        <div class="row mb-1">
                                            <div class="col-12">
                                                <div class="preview">
                                                    <img class="preview-img" src="{{ asset($cart->product['photo']) }}"
                                                        loading="lazy" alt="Product image">
                                                </div>
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <button type="button" class="btn btn-link p-0">
                                                        <img src="https://swan.prod.merch.vpsvc.com/v2/icons/zoom_in.714c54c4dc4f195abc1746b320009833.svg"
                                                            alt="" class="icon icon-size-32">
                                                        <span class="visually-hidden">View larger image</span>
                                                    </button>
                                                    <div class="mt-3">
                                                        <a href="/editor-vue/{{ ($cart->product['id']) }}"
                                                            class="link form-button">Edit</a>
                                                    </div>
                                                </div>
                                                <div class="modal" role="dialog" aria-modal="true"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 offset-1">
                                    <div class="grid-container">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4 id="product-name-{{ $key }}" class="display-6 ">
                                                    {{$cart->product->title}}
                                                </h4>
                                            </div>

                                            <div>
                                                <button data-id="{{$cart->id}}" type="button"
                                                    class="btn btn-link form-button remove">Remove</button>
                                            </div>
                                        </div>
                                        <hr class="divider">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div
                                                    class="d-flex justify-content-between align-items-baseline flex-wrap mt-1">

                                                    <div>
                                                        <span>Quantity</span>
                                                    </div>
                                                    <div>
                                                        <input type="number" value="{{$cart->quantity}}" min="0"
                                                            data-cart-id="{{$cart->id}}"
                                                            data-previous-quantity="{{$cart->quantity}}"
                                                            class="form-control product-quantity" style="max-width: 70px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div
                                                    class="d-flex justify-content-between align-items-baseline flex-wrap mt-1">

                                                    <div>
                                                        <span>Price ( per piece )</span>
                                                    </div>
                                                    <div>
                                                        <span>Rs {{$cart->product->price}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">

                                                <div class="col-12 mb-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div>Discount ( per piece )</div>
                                                        <div class="d-flex flex-column align-items-end">
                                                            <div class="d-flex flex-row align-items-end">
                                                                <div class="d-flex flex-row">
                                                                    <span>{{ $cart->product->discount }} %</span>

                                                                </div>
                                                                <hr class="divider">
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <hr class="divider">
                                                <div class="col-12 mb-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div>Grand Total</div>

                                                        <div class="d-flex flex-column align-items-end">
                                                            <div class="d-flex flex-row align-items-end">
                                                                <div class="d-flex flex-row">
                                                                    <span id='grand-total-{{$cart->id}}'>Rs {{
                                                                        $cart->product->price * $cart->quantity * ((100 -
                                                                        $cart->product->discount) / 100) }}</span>

                                                                    <div class="cart-spinner-{{$cart->id}} spinner-border d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <hr class="divider">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>

                        @endforeach
                        @else
                        <tr>
                            <td class="text-center">
                                You need to <a href="{{ route('login.form') }}" style="color:rgb(54, 54, 204)">Login</a>
                                OR <a style="color:blue" href="{{ route('register.form') }}">Register</a> for comment.
                            </td>
                        </tr>
                        @endif

                    </ul>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-12 wow fadeInRight" style="visibility: hidden; animation-delay: 0.4s; animation-name: none;padding: 20px 0px 0px 40px;">
            <div class="row mt-4">
                <div class="col-12 px-3 py-2 py-sm-5 mb-4 bg-light">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="display-6">Order Summary</h2>
                            <div role="table">
                                <div role="rowgroup">
                                    <div class="mt-3">
                                        <div data-testid="tax-aware-price-row">
                                            <div data-testid="price-row" role="row"
                                                class="d-flex justify-content-between align-items-start">
                                                <div role="columnheader" class="text-secondary font-weight-normal">
                                                    Subtotal
                                                </div>
                                                <div role="cell" class="d-flex flex-column align-items-end">
                                                    <div class="d-flex flex-row align-items-end">
                                                        <span data-testid="price-display"
                                                            class="text-dark text-secondary font-weight-normal">
                                                            <span id="subtotal" class="order-amount">Rs {{ $subtotal }}</span>
                                                            <div class="order-spinner spinner-border d-none"role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-testid="price-row" role="row"
                                            class="d-flex justify-content-between align-items-start">
                                            <div role="columnheader" class="text-secondary font-weight-normal">
                                                <div class="d-flex align-items-center">
                                                    <div class="text-secondary font-weight-normal">
                                                        <h4 class="">Savings</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="cell" class="d-flex flex-column align-items-end">
                                                <div class="d-flex flex-row align-items-end">
                                                    <span data-testid="price-display"
                                                        class="text-secondary font-weight-normal">
                                                        <span id='savings' class="order-amount">Rs {{ $totalSaved }}</span>
                                                        <div class="order-spinner spinner-border d-none" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div data-testid="tax-aware-price-row">
                                                <div data-testid="price-row" role="row"
                                                    class="d-flex justify-content-between align-items-start">
                                                    <div role="columnheader" class="text-secondary font-weight-normal">
                                                        <a href="/shipping" target="_blank"
                                                            class="text-decoration-none">Shipping</a>
                                                        <span> (calculated at checkout)</span>
                                                    </div>
                                                    <div role="cell" class="d-flex flex-column align-items-end">
                                                        <div class="d-flex flex-row align-items-end">
                                                            <span data-testid="price-display"
                                                                class="text-dark text-secondary font-weight-normal">
                                                                <output>-</output>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-testid="price-row" role="row"
                                                class="d-flex mt-3 justify-content-between align-items-start">
                                                <div role="columnheader" class="text-secondary font-weight-normal">
                                                    <span>Tax</span>
                                                    <span> (calculated at checkout)</span>
                                                </div>
                                                <div role="cell" class="d-flex flex-column align-items-end">
                                                    <div class="d-flex flex-row align-items-end">
                                                        <span data-testid="price-display"
                                                            class="text-dark text-secondary font-weight-normal">
                                                            <output>-</output>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                            <div>
                                                <div data-testid="tax-aware-price-row">
                                                    <div data-testid="price-row" role="row"
                                                        class="d-flex justify-content-between align-items-start">
                                                        <h4>Total</h4>
                                                        <div role="cell" class="d-flex flex-column align-items-end">
                                                            <div class="d-flex flex-row align-items-end">
                                                                <span data-testid="price-display"
                                                                    class="text-dark text-primary font-weight-bold">
                                                                    <h4 id="total" class="order-amount">Rs {{ $cartTotal }}</h4>
                                                                    <div class="order-spinner spinner-border d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-4">
                                            <dialog role="dialog" aria-modal="true" class="d-none"
                                                style="z-index: 9000;">
                                            </dialog>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{route('checkout')}}" class="btn btn-primary btn-block w-100">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div data-pp-id="1">
                                            <span id="zoid-paypal-message-uid_ca371166d7_mtk6mjm6ntg">
                                                <style nonce="">
                                                    #zoid-paypal-message-uid_ca371166d7_mtk6mjm6ntg>iframe {
                                                        width: 100%;
                                                        height: 0;
                                                    }

                                                    #zoid-paypal-message-uid_ca371166d7_mtk6mjm6ntg>iframe:nth-of-type(2) {
                                                        display: none;
                                                    }
                                                </style>
                                                <iframe allowtransparency="true"
                                                    name="__zoid__paypal_message__eyJzZW5kZXIiOnsiZG9tYWluIjoiaHR0cHM6Ly93d3cudmlzdGFwcmludC5jb20ifSwibWV0YURhdGEiOnsid2luZG93UmVmIjp7InR5cGUiOiJwYXJlbnQiLCJkaXN0YW5jZSI6MH19LCJyZWZlcmVuY2UiOnsidHlwZSI6InJhdyIsInZhbCI6IntcInVpZFwiOlwiem9pZC1wYXlwYWwtbWVzc2FnZS11aWRfY2EzNzExNjZkN19tdGs2bWptNm50Z1wiLFwiY29udGV4dFwiOlwiaWZyYW1lXCIsXCJ0YWdcIjpcInBheXBhbC1tZXNzYWdlXCIsXCJjaGlsZERvbWFpbk1hdGNoXCI6e1wiX190eXBlX19cIjpcInJlZ2V4XCIsXCJfX3ZhbF9fXCI6XCJcXFxcLnBheXBhbFxcXFwuY29tKDpcXFxcZCspPyRcIn0sXCJ2ZXJzaW9uXCI6XCIxMF8zXzNcIixcInByb3BzXCI6e1wiYWNjb3VudFwiOlwiY2xpZW50LWlkOkFaODFmZ0JOcXZiQTV0a2FxOHQwV2lrLXg4SW1vVWJfM0FzT0I2aTNQWTlzbjNvWDc0QTkzT1d6SUJCaERtVEtFS0d4Q1Rla1FvNklVRWI4XCIsXCJtZXJjaGFudElkXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImN1c3RvbWVySWRcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwiY3VycmVuY3lcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwiYW1vdW50XCI6Ny4xOSxcImJ1eWVyQ291bnRyeVwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJpZ25vcmVDYWNoZVwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJjaGFubmVsXCI6XCJVUFNUUkVBTVwiLFwiZWNUb2tlblwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJjb250ZXh0XCI6e1wiY2FsbFwiOnRydWV9LFwiU2Vzc2lvblwiOlwiY2xhc3NpY2F1c3VhbGQtY2FsbC1nbm9wZXJhbGxcIixcIk91dGJveCBFbnRyeVwiOm51bGx9LFwiU2VyaWFsXCI6bnVsbH19"></iframe>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


  
@endsection
@push('styles')
<style>
    .icon {
        display: inline-block;
        vertical-align: middle;
    }

    .icon-size-32 {
        width: 32px;
        height: 32px;
        font-size: 32px;
        background-size: cover;
    }

    .cart-quantity {
        background-color: #307db7;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 16px;
        text-align: center;
        line-height: 50px;
    }

    .form-button {
        border: 1px solid black;
        padding: 3px 20px;
        border-radius: 11px;
        color: black;
        background: white;
    }

   
 

   
</style>
@endpush
@push('scripts')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });

            
            // Listen for changes in the input fields
            let debounceTimer;

            $('.product-quantity').on('change', function() {
                var $this = $(this);
                var newQuantity = $this.val();
                var cartId = $this.data('cart-id');
                var previousQuantity = $this.data('previous-quantity');

                // Show the spinner and hide the cart total
                $(`.cart-spinner-${cartId}`).removeClass('d-none');
                $(`.order-spinner`).removeClass('d-none');
                $(`#grand-total-${cartId}`).addClass('d-none');
                $(`.order-amount`).addClass('d-none');

                if (newQuantity == 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You want to remove this item from the cart?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Proceed with deletion logic
                            $.ajax({
                                url: '/cart-update',
                                type: 'POST',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    quantity: newQuantity,
                                    cartId: cartId
                                },
                                success: function(response) {
                                    console.log(response);
                                    $(`#cart-li-${cartId}`).remove();
                                    Swal.fire("Deleted!", "The item has been removed from the cart.", "success");
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating cart:', error);
                                },
                                complete: function() {
                                    // Hide the spinner and show the cart total
                                    $(`.cart-spinner-${cartId}`).addClass('d-none');
                                    $(`.order-spinner`).addClass('d-none');
                                    $(`#grand-total-${cartId}`).removeClass('d-none');
                                    $(`.order-amount`).removeClass('d-none');
                                }
                            });
                        } else {
                            // User canceled deletion, revert the quantity
                            $this.val(previousQuantity);
                            Swal.fire("Cancelled", "The item was not removed.", "info");
                            
                            // Hide the spinner and show the cart total
                            $(`.cart-spinner-${cartId}`).addClass('d-none');
                            $(`.order-spinner`).addClass('d-none');
                            $(`#grand-total-${cartId}`).removeClass('d-none');
                            $(`.order-amount`).removeClass('d-none');
                        }
                    });
                } else {
                    // Update previous quantity data
                    $this.data('previous-quantity', newQuantity);

                    // Debounced AJAX request for quantity change
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        $.ajax({
                            url: '/cart-update',
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                quantity: newQuantity,
                                cartId: cartId
                            },
                            success: function(response) {
                                console.log(response);
                                $('#grand-total-' + response.cartId).text(response.amount); // Product total price
                                $('.cart-quantity').text(response.cartQuantity); // Cart product quantity
                                $('#subtotal').text('Rs ' + (response.cartTotal + response.totalSaved)); // Cart total without discount
                                $('#savings').text('Rs ' + response.totalSaved); // Amount saved because of discount
                                $('#total').text('Rs ' + response.cartTotal); // Amount after discount


                                $(`.order-amount`).removeClass('d-none');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error updating cart:', error);
                            },
                            complete: function() {
                                // Hide the spinner and show the cart total
                                $(`.cart-spinner-${cartId}`).addClass('d-none');
                                $(`.order-spinner`).addClass('d-none');
                                $(`#grand-total-${cartId}`).removeClass('d-none');
                            }
                        });
                    }, 500); // 500ms debounce delay
                }
            });


            $('.remove').on('click', function() {
                var id = $(this).data('id');
                console.log(id);
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You want to remove this item from the cart?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(id) {
                                
                                $.ajax({
                                    type: 'DELETE',
                                    url: `cart-delete/${id}`,
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    success: function(data) {
                                        $(`#cart-li-${id}`).remove();
                                        $('.cart-quantity').text(data.cartTotal);
                                        $('#subtotal').text('Rs '+response.cartTotal+response.totalSaved);
                                        $('#savings').text('Rs '+response.totalSaved);
                                        $('#total').text('Rs '+response.cartTotal);
                                        $(`.order-amount`).removeClass('d-none');
                                        Swal.fire("Deleted!", "The item has been removed from the list.", "success");
                                    },
                                    error: function(data) {
                                        // Handle errors and display error messages
                                        var errors = data.responseJSON.errors;
                                        console.log(errors);
                                        // Handle errors as needed
                                    }
                                });
                            }
                        } else {
                            Swal.fire("Cancelled", "The item was not removed.", "info");
                        }
                        return;
                    });
            });

         
        });
</script>
@endpush