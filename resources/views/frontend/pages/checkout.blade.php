@extends('frontend.layouts.master')
@section('title','Checkout page')
@section('main-content')
<!-- Start Checkout -->
<div class="container">
    <form class="form" method="POST" action="{{route('cart.order')}}">
        @csrf

        <div class="row">

            <div class="col-lg-6 col-12 wow fadeInLeft" style=" visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                <div class="checkout-form ">

                    <!-- Form -->
                    <div class="row mt-4" >
                        <h2 class="display-5">Shipping address</h2>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">First name*</label>
                                </div>
                                @error('first_name')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Last name*</label>
                                </div>
                                @error('last_name')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="email" name="email" id="email" value="{{old('email')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Email*</label>
                                </div>

                                @error('email')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="number" name="phone" id="phone" value="{{old('phone')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Number*</label>
                                </div>

                                @error('phone')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">


                                    <label class="country">Country*</label>
                                    <select class="form-control" name="country" id="country">
                                        <option selected value="PK">Pakistan</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="text" name="address1" id="address1" value="{{old('address1')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Address Line 1*</label>
                                </div>

                                @error('address1')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="text" name="address2" id="address2" value="{{old('address2')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Address Line 2</label>
                                </div>

                                @error('address2')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <div class="floating-label-group">
                                    <input type="text" name="post_code" id="post_code" value="{{old('post_code')}}"
                                        class="form-control" autocomplete="off" autofocus required />
                                    <label class="floating-label">Postal Code</label>
                                </div>

                                @error('post_code')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!--/ End Form -->
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
                                                                <span id="subtotal" class="order-amount">Rs {{ $subtotal}}</span>
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
                                                <a href="{{route('checkout')}}" class="btn btn-primary btn-block checkout-button">Checkout</a>
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
        <div class="form-group">
            <div class="floating-label-group">
                <input type="checkbox" name="saveAddress" id="saveAddress" class="" 
                       value="{{ old('saveAddress') }}" autocomplete="off" required />
                <label for="saveAddress" class="floating-label">Save Address*</label>
            </div>
        
            @error('saveAddress')
            <span class='text-danger'>{{ $message }}</span>
            @enderror
        </div>
        
    </form>
</div>

</div>

<!--/ End Checkout -->




@endsection
@push('styles')
<style>
    .form-control {
        padding: 1.7rem 1.75rem 0.2rem;
        border: 1px solid #383838;
    }

    .floating-label-group {
        position: relative;
        margin-top: 15px;
        margin-bottom: 25px;
    }

    .country,
    .floating-label-group .floating-label {
        font-size: 22px;
        color: #000;
        position: absolute;
        pointer-events: none;
        top: 17px;
        left: 24px;
        transition: all 0.1s ease;
        font-style: italic;
    }

    .country,
    .floating-label-group input:focus~.floating-label,
    .floating-label-group input:not(:focus):valid~.floating-label {
        top: 2px;
        bottom: 0px;
        left: 23px;
        font-size: 14px;
        opacity: 1;
        color: #404040;
        font-style: italic;
    }

    
</style>
@endpush
@push('scripts')


<script>


</script>

@endpush