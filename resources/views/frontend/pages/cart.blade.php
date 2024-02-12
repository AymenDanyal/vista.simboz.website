@extends('frontend.layouts.master')
@section('title', 'Cart Page')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ 'home' }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        
                            <form action="{{ route('cart.update') }}"
                            <tbody id="cart_item_list">
                                @if (Helper::getAllProductFromCart()) @foreach (Helper::getAllProductFromCart() as $key => $cart)
										<tr>
											@php
											$photo=explode(',',$cart->product['photo']);
											@endphp
											<td class="image" data-title="No"><img src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="{{ route('product-detail', $cart->product['slug']) }}" target="_blank">{{ $cart->product['title'] }}</a></p>
												<p class="product-des">{!! $cart['summary'] !!}</p>
											</td>
											<td class="price" data-title="Price"><span>${{ number_format($cart['price'], 2) }}</span></td>
											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{ $key }}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="quant[{{ $key }}]" class="input-number"  data-min="1" data-max="100" value="{{ $cart->quantity }}">
													<input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $key }}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount" data-title="Total" >
												<span class="money cart_single_price{{ $cart->product_id }}">${{ $cart->amount }}</span>
											</td>
											<td class="action" data-title="Remove" data-cart-id="{{ $cart->id }}">
												<a href="#" class="remove-cart-item">
													<i class="ti-trash remove-icon"></i>
												</a>
											</td>				</tr>
									@endforeach
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										
									</track>
								@else
										<tr>
											<td class="text-center">
												You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a> for comment.


											</td>
										</tr> @endif
                                </form>
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="{{ route('coupon-store') }}" method="POST">
                                            @csrf
                                            <input name="code" placeholder="Enter Your Coupon">
                                            <button class="btn">Apply</button>
                                        </form>
                                    </div>
                                    {{-- <div class="checkbox">`
										@php
											$shipping=DB::table('shippings')->where('status','active')->limit(1)->get();
										@endphp
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox" onchange="showMe('shipping');"> Shipping</label>
									</div> --}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
										<li id="orderSubtotal" class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
											You Pay<span>${{ number_format(Helper::totalCartPrice(), 2) }}</span>
										</li>

                                        @if (session()->has('coupon'))
                                            <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">You
                                                Save<span>${{ number_format(Session::get('coupon')['value'], 2) }}</span>
                                            </li>
                                        @endif
                                        @php
                                            $total_amount = Helper::totalCartPrice();
                                            if (session()->has('coupon')) {
                                                $total_amount = $total_amount - Session::get('coupon')['value'];
                                            }
                                        @endphp
                                        @if (session()->has('coupon'))
                                            <li class="last" id="order_total_price">You
                                                Pay<span>${{ number_format($total_amount, 2) }}</span></li>
                                        @else
                                            {{-- <li class="last" id="order_total_price">You
                                                Pay<span>${{ number_format($total_amount, 2) }}</span>
                                            </li> --}}
                                            
                                        @endif
                                    </ul>
                                    <div class="button5">
                                        <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ route('product-grids') }}" class="btn">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    <!-- Start Shop Newsletter  -->
    @include('frontend.layouts.newsletter')
    <!-- End Shop Newsletter -->

@endsection
@push('styles')
    <style>
        li.shipping {
            display: inline-flex;
            width: 100%;
            font-size: 14px;
        }

        li.shipping .input-group-icon {
            width: 100%;
            margin-left: 10px;
        }

        .input-group-icon .icon {
            position: absolute;
            left: 20px;
            top: 0;
            line-height: 40px;
            z-index: 3;
        }

        .form-select {
            height: 30px;
            width: 100%;
        }

        .form-select .nice-select {
            border: none;
            border-radius: 0px;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
            width: 100%;
        }

        .list li {
            margin-bottom: 0 !important;
        }

        .list li:hover {
            background: #F7941D !important;
            color: white !important;
        }

        .form-select .nice-select::after {
            top: 14px;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("select.select2").select2();
        });
        $('select.nice-select').niceSelect();
    </script>
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
            $('.input-number').on('change', function() {
                updateCart($(this).closest('tr'));
            });

            

            // Function to update the cart using AJAX
            function updateCart(row) {
                // Get the data from the row
                var qty = row.find('.input-number').val();
                var qty_id = row.find('input[name="qty_id[]"]').val();
                var _token = $('input[name="_token"]').val();
				let cartId = $(this).closest('td').data('cart-id');

                // Make the AJAX request
                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update') }}",
                    data: {
                        qty: qty,
                        qty_id: qty_id,
                        _token: _token
                    },
                    success: function(data) {
                        // Handle success, update the DOM if needed
                        
						
                        let orderSubtotal = $('#orderSubtotal');
                        orderSubtotal.attr('data-price', data.newAmount);
                        orderSubtotal.find('span').text('$' + data.newAmount.toFixed(2));
                        // You may want to update the total price, or display a success message

						let productPrice = '$' + data.productPrice.toFixed(2);
                        console.log(productPrice);
                        $(`.cart_single_price${data.productId}`).text(productPrice);
                        
                        
                    },
                    error: function(data) {
                        // Handle errors and display error messages
                        var errors = data.responseJSON.errors;
                        console.log(errors);
                        // Handle errors as needed
                    }
                });
            }
        });
    </script>
@endpush
