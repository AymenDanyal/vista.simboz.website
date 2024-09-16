<div class="container-fluid fixed-top-row w-100 d-flex justify-content-between align-items-center">
    <!-- Left Section -->
    <div class="d-flex col-4">
        <!-- Logo Section -->
        <div class="p-2 d-flex col-6 justify-content-start align-items-center">
            <i class="fa-solid fa-print fs-1 me-3"></i>
            <span class="fs-6" style="text-transform: capitalize;">You need it, we print it!</span>
        </div>
        <!-- Additional Text Section -->
        <div class="p-2 col-6 d-flex align-items-center">
            <i class="fa-solid fa-circle-question fs-1 me-3"></i>
            <div>
                <span class="fs-6 d-block">Need help?</span>
                <span class="fs-8 d-block">Call us at: <a href="tel:03142165733">03142165733</a></span>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="d-flex col-8 justify-content-end align-items-center">
        <!-- Price and Quantity Section -->
        <div class="p-2 d-flex col-10 justify-content-end align-items-center">
            <div class="d-flex align-items-center">
                <div>
                    <div class="align-items-center d-flex justify-content-left">
                        <div>
                            <span style="font-weight: 400; font-family: inherit;font-size:30px;" class="qtyPrice">Rs {{ number_format($product_detail->price - (($product_detail->discount / 100) * $product_detail->price)) }}</span>
                        </div>
                        {{-- <div>
                            <h3 class="sale-price qty-sale-price" id="order-price">Rs {{ number_format($product_detail->price) }}</h3>
                        </div> --}}
                    </div>
                    <h4 class="price-desc m-0">Price per product, Includes VAT</h4>
                </div>
            </div>
            <div class="justify-content-center d-flex align-items-center ms-3">
                

                @if($count_priceRange>1)
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <button class="param qty-modal" aria-hidden="true">
                            <span style="font-size: 19px;font-weight: 500;color: #000;font-weight: 400;">
                                Quantity 
                            </span>
                            <span style="" class="range-qty"> 
                                100 
                            </span>
                            <i class="fas fa-arrow-right" style="color: #a09c9c;"></i>
                        </button>
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-4 qty-btn-div d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-secondary btn-qty qtyminus" aria-hidden="true">&minus;</button>
                            <input type="number" name="qty" id="qty" min="1" max="{{ $product_detail->stock }}" step="1" value="1" class="form-control text-center qty-input" style="width: 60px; font-size: 20px;" readonly>
                        <button class="btn btn-outline-secondary btn-qty qtyplus"aria-hidden="true">&plus;</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- Button Section -->
        <div class="p-2 text-center">
            <span class="btn btn-primary" id="add-to-cart">Add to cart</span>
        </div>
    </div>
</div>


<style>
    .fixed-top-row {
        position: fixed;
        bottom: 0;
        left: 0;
        padding: 24px 15px width: 100%;
        z-index: 1000;
        background-color: white;
        border: 1px solid #c1c1c1;
    }
</style>
