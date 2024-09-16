@extends('frontend.layouts.master')

@section('title', 'Vizu || PRODUCT PAGE')

@section('main-content')
<div class="container">
    <div class="single-product">
        <div class="row">
            <div class="col-md-6 col-12  wow fadeInLeft" style=" visibility: hidden; animation-delay: 0.2s; ">
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
            <div class="col-md-6 col-12  wow fadeInRight" style=" visibility: hidden; animation-delay: 0.2s; ">
                <div class="row">
                    <div class="">
                        <div class="product">
                            <div class="product-title mb-2">
                                <h2> {{$product_detail->title}} </h2>
                            </div>
                            <div class=" product-rating mb-2 d-flex align-items-center">
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


                            <div class="product-price mb-3 row">
                                <div class="col-12">
                                    <div class="align-items-center d-flex justify-content-left mb-2">
                                        <div>
                                            <h3 style="font-weight: 400; font-family: inherit;" class="qtyPrice">Rs {{
                                                $priceRange[0]->price }}
                                            </h3>
                                        </div>
                                        {{-- <div>
                                            <h3 class="sale-price qty-sale-price" id="order-price">
                                                Rs {{number_format($product_detail->price) }}</h3>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4 class="price-desc">Price per product, Includes VAT Rs {{ $priceRange[0]->price
                                        }}</h4>
                                </div>
                                <div class="col-12">
                                    @if($count_priceRange>1)
                                    <div class="row mb-3">
                                        <div class="col-6 d-flex justify-content-between align-items-center">
                                            <button class="param qty-modal" aria-hidden="true">
                                                <span
                                                    style="font-size: 19px;font-weight: 500;color: #000;font-weight: 400;">
                                                    Quantity
                                                </span>
                                                <span class="range-qty" id="qty">
                                                    {{ $priceRange[0]->max_range}}
                                                </span>
                                                <i class="fas fa-arrow-right" style="color: #a09c9c;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row mb-3">
                                        <div
                                            class="col-4 qty-btn-div d-flex justify-content-between align-items-center">
                                            <button class="btn btn-outline-secondary btn-qty qtyminus"
                                                aria-hidden="true">&minus;</button>
                                            <input type="number" name="qty" id="qty" min="1"
                                                max="{{ $product_detail->stock }}" step="1" value="1"
                                                class="form-control text-center qty-input"
                                                style="width: 60px; font-size: 20px;" readonly>
                                            <button class="btn btn-outline-secondary btn-qty qtyplus"
                                                aria-hidden="true">&plus;</button>
                                        </div>
                                    </div>
                                    @endif


                                </div>

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

                            <div class="product-details mb-3 wow fadeInRight"
                                style=" visibility: hidden; animation-delay: 0.8s; ">
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
                                            <input id="{{ $color['value'] }}" class="color-input param-input"
                                                type="radio" data-price="{{ $color['price'] }}"
                                                data-parm-id="{{ $color['param_id'] }}" name="Color"
                                                value="{{ $color['value'] }}" @if ($loop->first) checked @endif>
                                            <label for="{{ $color['value'] }}" class="param mr-2"
                                                style="background-color:{{ $color['value'] }};">
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="divider"></span>
                                @endif

                                @if ($filterName =='Finish')
                                <div class="product-color mb-3">
                                    <h4>Finish</h4>
                                    <div class="">
                                        <div class="row">

                                            @foreach ($product_param['Finish'] as $index => $finish)
                                            <div class="col-4">
                                                <input id="{{ $finish['param_id'] }}" class="d-none param-input"
                                                    type="radio" data-price="{{ $finish['price'] }}"
                                                    data-parm-id="{{ $finish['param_id'] }}" name="finish"
                                                    value="{{ $finish['value'] }}" @if ($loop->first) checked @endif>
                                                <label for="{{ $finish['param_id'] }}" class="mr-2 param-finish"
                                                    style="background-image: url('{{ $finish['value'] }}'); ">
                                                   
                                                </label>
                                                <div class="d-flex align-center justify-content-center w-100">
                                                    <span class="param-price w-100 text-center">
                                                        + Rs {{ $finish['price']}}
                                                    </span>
                                                </div>
                                            </div>
                                            

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <span class="divider"></span>
                                @endif

                                @if ($filterName == 'Size')
                                <div class="product-param mb-3">
                                    <h4>Size</h4>
                                    <div class="param-layout d-flex text-center">
                                        @foreach ($product_param['Size'] as $index => $size)
                                        <div>
                                            <div>
                                                <input class="param-input" type="radio" name="size"
                                                    data-price="{{ $size['price'] }}" value="{{ $size['value'] }}"
                                                    id="size-{{ $index }}" data-parm-id="{{ $size['param_id'] }}" @if($loop->first) checked @endif>
                                                <label for="size-{{ $index }}" class="param">{{ $size['value']}}
                                                    <div class="d-flex align-center justify-content-center w-100">
                                                        <span class="param-price w-100 text-center">
                                                            + Rs {{ $size['price']}}
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif


                                @if($filterName!='Color'&&$filterName!='Size'&&$filterName!='Finish')

                                <div class="product-param mb-3">
                                    <h4>{{$filterName }}</h4>
                                    <div class="param-layout d-flex text-center">

                                        @foreach ($parameters as $parameter)
                                        <div>
                                            {{-- {{ dd($parameter['value']) }} --}}
                                            <input class="param-input" type="radio" name="param"
                                                value="{{$parameter['value']}}" data-price="{{ $parameter['price'] }}"
                                                id="param-{{ $parameter['value'] }}"
                                                data-parm-id="{{ $parameter['param_id'] }}" @if ($loop->first) checked
                                            @endif>

                                            <label for="param-{{ $parameter['value'] }}" class="param">{{
                                                $parameter['value'] }}

                                                <div class="d-flex align-center justify-content-center w-100">
                                                    <span class="param-price w-100 text-center">
                                                        + Rs {{ $parameter['price']}}
                                                    </span>
                                                </div>

                                            </label>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @endforeach

                            </div>




                        </div>
                    </div>
                    {{-- <div class="col-md-5 col-12">
                        <div class="order-section mt-4">
                            <div class="align-items-center d-flex justify-content-left mb-2">
                                <div>
                                    <h3 style="font-weight: 400; font-family: inherit;" class="qtyPrice">Rs {{
                                        number_format($product_detail->price - (($product_detail->discount / 100) *
                                        $product_detail->price)) }}</h3>
                                </div>
                                <div>
                                    <h3 class="sale-price qty-sale-price" id="order-price">Rs {{
                                        number_format($product_detail->price) }}</h3>
                                </div>
                            </div>
                            <h4 class="price-desc">Price per product, Includes VAT</h4>
                            <div class="row mb-3">
                                <div class="col-4 qty-btn-div d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-secondary btn-qty qtyminus"
                                        aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" max="{{ $product_detail->stock }}"
                                        step="1" value="1" class="form-control text-center qty-input mx-2"
                                        style="width: 36px;">
                                    <button class="btn btn-outline-secondary btn-qty qtyplus"
                                        aria-hidden="true">&plus;</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-0">
                                    <a class="btn btn-primary w-100 mb-0"
                                        href="{{ route('editor-vue', ['productId' => $product_detail->id]) }}">
                                        <i class="fa-solid fa-paintbrush"></i>
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
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fa-regular fa-star fa-icon me-2"></i>
                                        <span>2 year full warranty</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal wow fadeInRight" style="visibility: hidden; animation-delay: 0.2s;" id="quantityModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content" style="height: 100vh;">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="pt-2">Choose Your Quantity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="flex-grow: 1; overflow-y: auto;">
                <div class="row">
                    <div class="col-12">
                        @foreach ($priceRange as $key => $value )
                        <div class="row mb-3 option-row  {{ $key === 0 ? 'selected' : '' }}" data-value="1">
                            <div class="col-4">
                                <span id="range{{ $key }}">{{ $value->max_range }}</span>
                            </div>

                            <div class="col-4">
                                <span id="price{{ $key }}">Rs {{ $value->price }}</span>
                            </div>
                            <div class="col-4">
                                <span>Rs {{ number_format($value->price / $value->max_range, 1) }} / unit</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center"
                style="position: sticky; bottom: 0; background-color: white; z-index: 10;">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <button type="button" class="btn btn-primary w-100 quantity-select" data-bs-dismiss="modal">
                        Select this quantity
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@include('frontend.pages.cart_bar')
@endsection



@push('scripts')

<script>
    //slider
    $(document).ready(function() {
        var qtyPrice;
        var rangeValue;
        updateValue();
        
        $('.quantity-select').on('click', function() {
            updateValue();
        });
        let selectedValue = null;
        $('.option-row').on('click', function() {
            $('.option-row').removeClass('selected');
            $(this).addClass('selected');
            selectedValue = $(this).data('value');
            $('#submitSelection').prop('disabled', false);    
        });
        $('#submitSelection').on('click', function() {
            if (selectedValue) {
                console.log('Selected Option:', selectedValue); 
            } else {
                alert('Please select an option.');
            }
        });
        $('.qty-modal').on('click', function() {
            $('#quantityModal').modal('show');
        });
        $('.param-input').on('click', function() {
            updateValue();
        });

        function updateValue() {
            //console.log('updateValue');
            
            let pramPrice = 0;
            const countPriceRange = {{ $count_priceRange }};
            
            $('.param-input:checked').each(function() {
                pramPrice += parseInt($(this).data('price'), 10);
            });

            const selectedOption = $('.option-row.selected');
            const key = selectedOption.index();
            
            rangeValue = parseInt($('#range' + key).text());
            qtyPrice = $('#price' + key).text();
            qtyPrice = parseInt(qtyPrice.replace(/[^0-9]/g, ''), 10);
            
            if (countPriceRange <= 1) {
                var productQty = parseInt($('#qty').val(), 10); // Ensure the base is set to 10 for parseInt
                qtyPrice = ((productQty * qtyPrice) + (pramPrice * productQty)); // Correct calculation

             
                $('.qtyPrice').text('Rs ' + qtyPrice);
                $('.range-qty').text('Rs ' + rangeValue);

            } else {
               
                qtyPrice=pramPrice + qtyPrice;
                $('.qtyPrice').empty().text('Rs ' + qtyPrice);
                $('.range-qty').text('Rs ' + rangeValue);
            }
        }

       
        $('#add-to-cart').on('click',function(){
            var productId = {{$product_detail->id}}
            var paramIds = [];
            $('.param-input:checked').each(function() {
                var id = $(this).data('parm-id');
                paramIds.push(id);                    
            });
            var producQty = rangeValue; 
            var productPrice = qtyPrice; 
            console.log(qtyPrice,producQty);
            $.ajax({
                type: "POST",
                url: "{{ route('add-to-cart') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    paramIds: paramIds,
                    productId: productId,
                    producQty: producQty,
                    productPrice: productPrice,
                },
                success: function(response) {
                    window.location.href = '/cart';
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the error message to understand what went wrong
                    alert('An error occurred: ' + xhr.responseText);
                }
            });

        });
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
                updateValue();
            }

            function qtyplus(e) {
                var current = Number($input.val());
                var newval = current + step;
                if (newval > max) {
                    newval = max;
                }
                $input.val(newval);
                e.preventDefault();
                updateValue();
            }

            $btnminus.on('click', qtyminus);
            $btnplus.on('click', qtyplus);
        }
    });

    
</script>
@endpush

@push('styles')
<style>
    .range-qty {
        font-size: 14px;
        font-weight: 500;
        color: black;
        padding: 0px 7px;
    }

    .qty-button {
        background-color: #fff;
        border: 1px solid #c1c1c1;
        padding: 13px 19px;
        border-radius: 13px;
        margin: 16px 0px;
        color: #212529;
        font-size: 1rem;
    }

    .option-row {
        background-color: #fff;
        border: 1px solid #c1c1c1;
        color: #212529;
        padding: 10px 10px;
        border-radius: 10px;
        margin: 10px;
    }

    .option-row.selected {
        background-color: #fff;
        color: #212529;
        padding: 10px 10px;
        border-radius: 10px;
        border: 2px solid black;
        margin: 10px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-header h5 {
        color: #000;
        font-weight: 400;
        font-size: 26px;
        margin: 0px 0px 0px 16px;
    }

    .modal-body span {
        color: #000;
        font-weight: 400;
        font-size: 16px;
        padding: 3px 0px 0px 1px;
    }

    .modal {
        left: auto;
        right: 17px;
        width: 25%;
        top: 0;
    }



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
        color: #c1c1c1;
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

    .param {
        background: #efefef;
        padding: 10px 18px;
        border: 1px solid #efefef;
        border-radius: 4px;
        margin-left: 0px;
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;
    }

    .param-price {

        border-radius: 4px;
        margin-left: 0px;
        font-size: 16px;
        font-weight: 400;
        cursor: pointer;
        color: #b6b6b6;

    }

    .param:hover {
        border: 1px solid #c1c1c1;
    }

    .product-param .param-layout input[type="radio"]:checked+.param {
        background-color: rgb(35, 35, 35);
        border: 1px solid #c1c1c1;
        color: #efefef;
        box-shadow: 0 3px 6px #949494;

    }

    .param-finish {
        width: 100% !important;
        height: 168px !important;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        border-radius: 10px;
    }

    .param-finish:hover {
        border: 1px solid #c1c1c1;
    }

    .param-input:checked+.param-finish {
        box-shadow: 4px 6px 11px 2px #949494;
        border: 2px solid #6b5f5f;
    }




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
        border: 1px solid black;
    }

    .product-color .color-layout .color-input {
        display: none;
    }

    .divider {
        display: block;
        height: 1px;
        width: 100%;
        background: #48484830;
        margin: 20px 0;
    }

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
        color: #c1c1c1;
        border-radius: 4px;
        cursor: pointer;
    }

    .product-btn-group .add-cart i {
        font-size: 20px;
    }

    .product-btn-group .add-cart:hover {
        box-shadow: 0 3px 6px #949494;
        background: #c1c1c1;
        color: #fff;
    }

    .product-btn-group .heart {
        color: #c1c1c1;
        cursor: pointer;
    }

    .product-btn-group .heart i {
        font-size: 20px;
    }

    .product-btn-group .heart:hover {
        color: #5344db;
    }


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

    @media (min-width: 520px) and (max-width: 1080px) {
        .container {
            display: block;
            height: auto;
            padding: 20px;
        }

    }
</style>
@endpush