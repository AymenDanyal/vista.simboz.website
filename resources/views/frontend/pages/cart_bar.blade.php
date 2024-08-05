<div class="container-fluid">
    <div class="fixed-top-row w-100 d-flex justify-content-between align-items-center">
        <!-- Left Section -->
        <div class="d-flex col-6">
            <!-- Logo Section -->
            <div class="p-4 d-flex col-6 justify-content-start">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-print fs-1 me-3"></i>
                    <span class="fs-6" style="text-transform: capitalize;">You need it, we print it!</span>
                </div>
            </div>
            <!-- Additional Text Section -->
            <div class="p-4 col-6 d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-question fs-1 me-3"></i>
                    <div>
                        <span class="fs-6 d-block">Need help?</span>
                        <span class="fs-8 d-block">Call us at: <a href="tel:03142165733">03142165733</a></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="d-flex col-6 justify-content-end">
            <!-- Help Section -->
            <div class="p-4 col-6 d-flex align-items-center justify-content-end">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-question fs-1 me-3"></i>
                    <div>
                        <div class="align-items-center d-flex justify-content-left mb-2">
                            <div>
                                <h3 style="font-weight: 400; font-family: inherit;" class="qtyPrice">Rs {{ number_format($product_detail->price - (($product_detail->discount / 100) * $product_detail->price)) }}</h3>
                            </div>
                            <div>
                                <h3 class="sale-price qty-sale-price" id="order-price">Rs {{ number_format($product_detail->price) }}</h3>
                            </div>
                        </div>
                        <h4 class="price-desc">Price per product, Includes VAT</h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 qty-btn-div d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-secondary btn-qty qtyminus" aria-hidden="true">−</button>
                        <input type="number" name="qty" id="qty" min="1" max="{{ $product_detail->stock }}" step="1" value="1"class="form-control text-center qty-input mx-2" style="width: 36px;">
                        <button class="btn btn-outline-secondary btn-qty qtyplus" aria-hidden="true">+</button>
                    </div>
                </div>
            </div>
            <!-- Button Section -->
            <div class="p-4 col-6 text-center">
                <div class="row justify-content-end">
                    <div class="col-6">
                        <div class="col-12">
                            <span class="btn btn-primary">Add to cart</span>        
                        </div>
                    </div>
                </div>
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
