@extends('frontend.layouts.master')

@section('title', 'Vizu || PRODUCT PAGE')

@section('main-content')
<div class="container">
    <div class="single-product">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="product-image">
                    <div class="product-image-main mb-3">

                        <img src="{{ asset($product_detail->photo) }}" alt="Product Main Image" id="product-main-image"
                            class="img-fluid">
                    </div>
                    <div class="product-image-slider d-flex justify-content-between">
                        <img src="{{ asset($product_detail->photo) }}" alt="Product Image" class="image-list img-fluid">
                        <img src="{{ asset($product_detail->photo) }}" alt="Product Image" class="image-list img-fluid">
                        <img src="{{ asset($product_detail->photo) }}" alt="Product Image" class="image-list img-fluid">
                        <img src="{{asset( asset($product_detail->photo) )}}" alt="Product Image"
                            class="image-list img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="row">
                    <div class="col-md-7 col-12">
                        <div class="product">
                            <div class="product-title mb-2">
                                <h2> {{$product_detail->title}} </h2>
                            </div>
                            <div class="product-rating mb-2 d-flex align-items-center">
                                @if($reviews['review_count'] > 0)
                                {{-- Display average rating --}}
                                <span class="average-rating fw-bold me-2">{{ $reviews['average_rating'] }}</span>

                                {{-- Display filled and empty stars --}}
                                @php
                                $fullStars = floor($reviews['average_rating']);
                                $halfStar = ($reviews['average_rating'] - $fullStars >= 0.5) ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                                @endphp

                                {{-- Full Stars --}}
                                @for ($i = 0; $i < $fullStars; $i++) <span class="star text-warning"><i
                                        class="fa fa-star"></i></span>
                                    @endfor

                                    {{-- Half Star --}}
                                    @if ($halfStar)
                                    <span class="star text-warning"><i class="fa fa-star-half-alt"></i></span>
                                    @endif

                                    {{-- Empty Stars --}}
                                    @for ($i = 0; $i < $emptyStars; $i++) <span class="star text-secondary"><i
                                            class="fa fa-star"></i></span>
                                        @endfor

                                        {{-- Display number of reviews --}}
                                        <span class="review-count ms-2 text-muted">({{ $reviews['review_count'] }} {{
                                            Str::plural('Review', $reviews['review_count']) }})</span>
                                        @else
                                        {{-- No reviews available --}}
                                        <span class="review-count text-muted">No reviews yet</span>
                                        @endif
                            </div>

                            <div class="product-price mb-3">
                                <span class="offer-price">Rs {{ number_format($product_detail->price -(($product_detail->discount / 100) * $product_detail->price), 0) }}
                                </span>
                                <span class="sale-price">Rs {{$product_detail->price}}</span>
                            </div>
                            @if($product_detail->stock > 0)
                                <h5>
                                    
                                    <i class="fa-regular fa-circle-check" style="color: #058f65;margin-right:3px;"></i>
                                    In stock

                                    ({{$product_detail->stock}})
                                </h5>
                            @else
                                <h5>
                                    {{$product_detail->stock}}
                                    <i class="fa-regular fa-circle-xmark" style="color: #e74c3c;margin-right:3px;"></i>
                                    Out of stock
                                </h5>
                            @endif

                            <div class="product-details mb-3">
                                @if($product_detail->discount > 0)
                                    Discount: {{ $product_detail->discount }}%
                                @endif


                                @foreach ($product_param as $filterName => $parameters)
                                    @if ($filterName == 'Color')
                                        <div class="product-color mb-3">
                                            <h4>Color</h4>
                                            <div class="color-layout d-flex justify-content-start">
                                                @foreach ($product_param['Color'] as $index => $color)
                                                    <div>
                                                        <input id="{{ $color }}" type="radio" name="Color" value="{{ $color }}" class="color-input">
                                                        <label for="{{ $color }}" class="mr-2" style="background-color:{{ $color }};"></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <span class="divider"></span>
                                    @endif
                                    @if ($filterName == 'Size')
                                        <div class="product-param mb-3">
                                            <h4>Size</h4>
                                            <div class="param-layout d-flex">
                                                @foreach ($product_param['Size'] as $index => $size)
                                                    <div>
                                                        <input type="radio" name="size" value="{{ $size }}" id="size-{{ $index }}" class="param-input">
                                                        <label for="size-{{ $index }}" class="param">{{ $size }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    
                                    @if($filterName!='Color'&&$filterName!='Size')
                                        
                                        <div class="product-param mb-3">
                                            <h4>{{$filterName }}</h4>
                                            <div class="param-layout d-flex">
                                                @foreach ($parameters as $parameter)
                                                    <div>
                                                        <input type="radio" name="param" value="{{$parameter}}" id="param-{{ $parameter }}" class="param-input">
                                                        <label for="param-{{ $parameter }}" class="param">{{ $parameter }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                          
                         
                            
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="order-section mt-4">
                            <div class="align-items-center d-flex justify-content-left mb-2">
                                <div>
                                    <h3 style="font-weight: 400; font-family: inherit;" class="qtyPrice">Rs {{ number_format($product_detail->price - (($product_detail->discount / 100) * $product_detail->price)) }}</h3>
                                </div>
                                <div>
                                    <h3 class="sale-price qty-sale-price"id="order-price">Rs {{ number_format($product_detail->price) }}</h3>
                                </div>
                            </div>
                            <h4 class="price-desc">Price per product, Includes VAT</h4>
                            <div class="row mb-3">
                                <div class="col-4 qty-btn-div d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-secondary btn-qty qtyminus"
                                        aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" max="{{ $product_detail->stock }}" step="1" value="1"class="form-control text-center qty-input mx-2" style="width: 36px;">
                                    <button class="btn btn-outline-secondary btn-qty qtyplus"
                                        aria-hidden="true">&plus;</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-0">
                                    <a class="btn btn-primary w-100 mb-0" href="{{ route('editor-vue', ['productId' => $product_detail->id]) }}">
                                        <i class="fa-solid fa-paintbrush" ></i>
                                        Edit myself
                                    </a>
                                </div>
                                <div class="col-12 mt-0">
                                    <button class="btn btn-secondary w-100">
                                        <i class="fa-solid fa-compass-drafting"></i>
                                        
                                        Edit with designer
                                    </button>
                                </div>
                                <hr>
                            </div>
                            <div class="">
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fa-solid fa-truck-fast fa-icon me-2"></i>
                                        <span>Shipping all over country</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fa-solid fa-lock fa-icon me-2"></i>
                                        <span>Secure payment</span>
                                    </li>
                                    {{-- <li class="d-flex align-items-center mb-3">
                                        <i class="fa-regular fa-star fa-icon me-2"></i>
                                        <span>2 year full warranty</span>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('frontend.pages.cart_bar')
@endsection


@push('styles')
<style>
    .order-section [type='number']::-webkit-outer-spin-button,
    .order-section input[type='number']::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .order-section input[type='number'] {
        -moz-appearance: textfield;
    }


    .order-section li {
        list-style-type: none;
        margin: 0;
    }

    .order-section li i {
        margin: 2px 10px 0px 0px;
    }

    .order-section .fa-paintbrush,
    .order-section .fa-compass-drafting {
        color: #ffffff;
        margin-right: 10px;
    }

    .price-desc {
        color: #c1c1c1;
        font-size: 15px;
        margin-bottom: 17px;
        font-family: 'Montserrat';
    }

    .btn-qty {
        background-color: #eee;
        border-radius: 4px;
        padding: 5px 14px;
        border: none;
        font-size: 25px;
    }

    .qty-btn-div {
        border: 1px solid #c1c1c1;
        border-radius: 7px;
        width: auto;
        height: auto;
        padding: 5px;
        margin-left: 12px;
    }

    .qty-input {
        padding: 4px 0px;
        border: none;
    }

    .order-section {
        padding: 17px 36px;
        border-radius: 10px;
        border: 1px solid #c1c1c1;
    }

    .single-product .breadcrumb {
        background: #48484810;
        padding: 8px 4px;
        border-radius: 8px;
        font-size: 15px;
    }

    .breadcrumb span {
        display: inline-flex;
        flex-direction: row;
        gap: 8px;
        margin-left: 8px;
    }

    .breadcrumb span:not(:last-child)::after {
        content: '/';
    }

    .breadcrumb span a {
        text-decoration: none;
        color: #5344db;
    }

    /** product image **/

    .single-product .product-image {
        width: 100%;
    }

    .product-image .product-image-main {
        position: relative;
        display: block;
        height: 480px;
        background: white;
        padding: 10px;
    }

    .product-image-main img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product-image-slider {
        display: flex;
        gap: 10px;
        margin: 10px 0;
    }

    .product-image-slider img {
        width: 90px;
        height: 90px;
        background: white;
        padding: 6px;
        cursor: pointer;
    }

    /** product title **/

    .product-title {
        margin-top: 20px;

    }

    .product-title h2 {
        font-weight: 400;

    }

    /** product rating **/
    .product-rating {
        display: flex;
        margin-top: 4px;
        margin-bottom: 10px;
        align-items: center;
    }

    .product-rating span:not(:last-child) {
        color: #ffc600;
    }

    .product-rating .review {
        color: var(--grey);
        font-size: 12px;
        font-weight: 500;
    }

    /** Product price **/
    .product-price {
        display: flex;
        position: relative;
        margin: 10px 0;
        align-items: center;
    }

    .product-price .offer-price {
        font-size: 26px;
        font-weight: 400;
    }

    .sale-price {
        font-size: 18px;
        font-weight: 400;
        text-decoration: line-through;
        color: #c1c1c1;
        margin-left: 12px;
    }

    /** Product Details **/
    .product-details {
        margin: 10px 0;
    }

    .product-details h3 {
        font-size: 18px;
        font-weight: 500;
    }

    .product-details p {
        margin: 5px 0;
        font-size: 14px;
        line-height: 1.2rem;
    }

    /** Product size **/
    .product-param {
        margin: 10px 0;
    }

    .product-param h4 {
        font-size: 16px;
        font-weight: 500;
    }

    .product-param .param-layout {
        margin: 5px 0;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .product-param .param-layout .param-input {
        display: none;
    }

    .product-param .param-layout .param {
        background: #efefef;
        padding: 10px 18px;
        border: 1px solid #efefef;
        border-radius: 4px;
        margin-left: 0px;
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;
    }
    

    .product-param .param-layout .param:hover {
        border: 1px solid var(--grey);
    }

    .product-param .param-layout input[type="radio"]:checked+.param {
        background-color: rgb(35, 35, 35);
        border: 1px solid var(--grey);
        color: #efefef;
        box-shadow: 0 3px 6px #949494;

    }


    /** Product Color **/
    .product-color {
        margin: 10px 0;
        justify-content: center;
    }

    .product-color h4 {
        font-size: 16px;
        font-weight: 500;
    }

    .product-color .color-layout {
        margin: 5px 0;
        display: flex;
        gap: 10px;
    }

    .product-color .color-layout label {
        border-radius: 8px;
        cursor: pointer;
        content: '';
        width: 40px;
        height: 40px;
        display: inline-block;
        border: 2px solid #c1c1c1;  
    }

    .product-color .color-layout .black {

        background-color: black;
    }

    .product-color .color-layout .red {
        background-color: red;
    }

    .product-color .color-layout .blue {
        background-color: blue;
    }

    .product-color .color-layout input[type="radio"]:checked+label {
        box-shadow: 0 3px 6px #949494;
    }

    .product-color .color-layout .color-input {
        display: none;
    }


    /** divider **/
    .divider {
        display: block;
        height: 1px;
        width: 100%;
        background: #48484830;
        margin: 20px 0;
    }

    /** product Button Group **/

    .product-btn-group {
        display: flex;
        gap: 15px;
    }

    .product-btn-group .button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 10px 24px;
        font-size: 16px;
        font-weight: 500;
    }

    .product-btn-group .buy-now {
        background-color: #5344db;
        color: #fff;
        border: 1px solid #5344db;
        border-radius: 4px;
        cursor: pointer;
    }

    .product-btn-group .buy-now i {
        font-size: 20px;
    }

    .product-btn-group .buy-now:hover {
        box-shadow: 0 3px 6px #949494;
    }

    .product-btn-group .add-cart {

        background-color: #efefef;
        color: var(--grey);
        border-radius: 4px;
        cursor: pointer;
    }

    .product-btn-group .add-cart i {
        font-size: 20px;
    }

    .product-btn-group .add-cart:hover {
        box-shadow: 0 3px 6px #949494;
        background: var(--grey);
        color: #fff;
    }

    .product-btn-group .heart {
        color: var(--grey);
        cursor: pointer;
    }

    .product-btn-group .heart i {
        font-size: 20px;
    }

    .product-btn-group .heart:hover {
        color: #5344db;
    }


    /** Responsive Mobile **/
    @media screen and (max-width:520px) {
        .container {
            padding: 20px;
            height: auto;
        }

        .row {
            display: block;
        }

        .col-6 {
            width: 100%;
            display: block;
        }

        .single-product {
            width: 100%;
            position: relative;
        }

        .product-image .product-image-main {
            width: 100%;
            height: 280px;
        }

        .product-image-slider {
            gap: 5px;
        }

        .breadcrumb {
            display: none;
        }

        .product-title h2 {
            font-size: 24px;
            line-height: 1.6rem;
        }

        .product-param {
            display: block;
        }

        .product-param .param-layout {
            display: block;
            margin: 10px 0;

        }

        .product-param .param-layout .param {
            padding: 6px 10px;
        }

        .product-btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    }

    /** Responsive Tablet **/
    @media (min-width: 520px) and (max-width: 1080px) {
        .container {
            display: block;
            height: auto;
            padding: 20px;
        }

    }
</style>
@endpush
@push('scripts')
<script>
    //slider
    $(document).ready(function() {
        const sliderMainImage = $("#product-main-image");
        const sliderImageList = $(".image-list");

        sliderImageList.eq(0).on("click", function() {
            sliderMainImage.attr("src", $(this).attr("src"));
            console.log(sliderMainImage.attr("src"));
        });

        sliderImageList.eq(1).on("click", function() {
            sliderMainImage.attr("src", $(this).attr("src"));
            console.log(sliderMainImage.attr("src"));
        });

        sliderImageList.eq(2).on("click", function() {
            sliderMainImage.attr("src", $(this).attr("src"));
            console.log(sliderMainImage.attr("src"));
        });

        sliderImageList.eq(3).on("click", function() {
            sliderMainImage.attr("src", $(this).attr("src"));
            console.log(sliderMainImage.attr("src"));
        });

        // Quantity controls
        var $input = $('.qty-input');
        var $btnminus = $('.qtyminus');
        var $btnplus = $('.qtyplus');

        if ($input.length && $btnminus.length && $btnplus.length) {
            var min = Number($input.attr('min'));
            var max = Number($input.attr('max'));
            var step = Number($input.attr('step'));

            function qtyminus(e) {
                var current = Number($input.val());
                var newval = current - step;
                if (newval < min) {
                    newval = min;
                } else if (newval > max) {
                    newval = max;
                }
                $input.val(newval);
                e.preventDefault();
            }

            function qtyplus(e) {
                var current = Number($input.val());
                var newval = current + step;
                if (newval > max) {
                    newval = max;
                }
                $input.val(newval);
                e.preventDefault();
            }

            $btnminus.on('click', qtyminus);
            $btnplus.on('click', qtyplus);
        }
   
        $('.btn-qty').on('click', function() {
            var qty = $('#qty').val(); // Use .val() to get the value
            var discountPrice = {{ $product_detail->price - (($product_detail->discount / 100) * $product_detail->price) }};
            var originalPrice = {{ $product_detail->price }};

            var qtyPrice = Math.round(discountPrice * qty); 
            var qtySalePrice = Math.round(originalPrice * qty);

            $('.qty-sale-price').text('Rs '+qtySalePrice);
            $('.qtyPrice').text('Rs '+qtyPrice);

            //console.log(qtyPrice, qtySalePrice);
        });

    });
</script>
@endpush