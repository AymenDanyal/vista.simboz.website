
<div id="addProduct"  class="alert alert-success alert-dismissable fade show text-center" style="display: none">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <p >Product Added To Cart</p>
</div>
<div id="addWishlist"  class="alert alert-success alert-dismissable fade show text-center" style="display: none">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <p >Product Added To Wishlsit</p>
</div>


@if(session('error'))
    <div class="alert alert-danger alert-dismissable fade show text-center">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('error')}}
    </div>
@endif