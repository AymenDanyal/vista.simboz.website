<header id="mt-header">
    <!-- mt bottom bar start here -->
    <div class="mt-bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <!-- mt logo start here -->
                    <div class="mt-logo">
                        <a href="/">
                            <img src="https://htmlbeans.com/html/schon/images/mt-logo.png" alt="schon">
                        </a>
                    </div>

                    <div class="site-header-search-container">
                        <div class="search-context-inner-wrapper">
                            <div class="search-application search-results-analytics-container">
                                <div role="group">
                                    <search>
                                        <div class="site-header-search-form">
                                            <div class="search-input">
                                                <input type="search" value="" required="" aria-required="true"
                                                    aria-autocomplete="list" placeholder="Search" autocomplete="off"
                                                    class="swan-polyfill-empty search-bar-input site-header-search swan-input">
                                                <div class="search-box">
                                                    <ul class="search-results d-none">

                                                        <span>See all results</span>
                                                    </ul>


                                                </div>
                                                <button type="submit" aria-label="Search"
                                                    class="search-input-submit swan-button swan-button-skin-secondary">
                                                    <img src="https://swan.prod.merch.vpsvc.com/v2/icons/search.3594f845fd4e26d76fd4cf3b291a9e7e.svg"
                                                        alt=""
                                                        class="search-submit-icon swan-icon swan-icon-skin-standard swan-icon-type-search"
                                                        style="width: 58%;">
                                                </button>
                                            </div>
                                        </div>

                                    </search>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mt icon list start here -->
                    <ul class="mt-icon-list">
                        <li class="hidden-lg hidden-md">
                            <a href="#" class="bar-opener mobile-toggle">
                                <span class="bar"></span>
                                <span class="bar small"></span>
                                <span class="bar"></span>
                            </a>
                        </li>

                        <li class="drop">
                            <a href="{{ route('wishlist') }}" class="icon-heart cart-opener">
                                <span style="margin-bottom: -3px;" class="num">{{ Helper::wishlistCount() }}</span>
                            </a>
                            <!-- mt drop start here -->

                            <div class="mt-drop">
                                <!-- mt drop sub start here -->
                                <div class="mt-drop-sub">
                                    <!-- mt side widget start here -->
                                    <div class="mt-side-widget">
                                        <!-- cart row start here -->
                                        @auth
                                            @foreach (Helper::getAllProductFromWishlist() as $data)
                                                @php
                                                    $photo = explode(',', $data->product['photo']);
                                                @endphp
                                                <div class="cart-row">
                                                    <a href="#" class="img"><img src="{{ $photo[0] }}"
                                                            alt="{{ $photo[0] }}" class="img-responsive"></a>
                                                    <div class="mt-h">
                                                        <span class="mt-h-title"><a
                                                                href="#">{{ $data->product['title'] }}</a></span>
                                                        <span class="price"><i class="fa fa-eur" aria-hidden="true"></i>
                                                            599,00</span>
                                                    </div>
                                                    <a href="#" class="close fa fa-times"></a>
                                                </div><!-- cart row end here -->

                            <li>
                                <a href="{{ route('wishlist-delete', $data->id) }}" class="remove"
                                    title="Remove this item"><i class="fa fa-remove"></i>
                                </a>
                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                        alt="{{ $photo[0] }}"></a>
                                <h4>
                                    <a
                                        href="{{ route('product-detail', $data->product['slug']) }}"target="_blank">{{ $data->product['title'] }}</a>
                                </h4>
                                <p class="quantity">{{ $data->quantity }} x -
                                    <span class="amount">${{ number_format($data->price, 2) }}</span>
                                </p>
                            </li>
                            @endforeach

                        @endauth

                        <!-- cart row total start here -->
                        <div class="cart-row-total">
                            <span class="mt-total">Add them all</span>
                            <span class="mt-total-txt">
                                <a href="{{ route('cart') }}" class="btn-type2">CART</a>
                            </span>
                        </div>
                        <!-- cart row total end here -->
                </div><!-- mt side widget end here -->
            </div>
            <!-- mt drop sub end here -->
        </div><!-- mt drop end here -->

        <span class="mt-mdropover"></span>
        </li>
        <li class="drop">
            <a href="{{ route('cart') }}" class="cart-opener">
                <span class="icon-handbag"></span>
                <span class="num">{{ Helper::cartCount() }}</span>
            </a>
            <!-- mt drop start here -->
            <div class="mt-drop">
                <!-- mt drop sub start here -->
                <div class="mt-drop-sub">
                    <!-- mt side widget start here -->
                    <div class="mt-side-widget">
                        <!-- cart row start here -->
                        <div class="cart-row">
                            <a href="#" class="img">
                                <img src="https://htmlbeans.com/html/schon/images/products/img36.jpg"
                                    alt="image"class="img-responsive">
                            </a>
                            <div class="mt-h">
                                <span class="mt-h-title">
                                    <a href="#">Marvelous Modern 3 Seater</a>
                                </span>
                                <span class="price">
                                    <i class="fa fa-eur" aria-hidden="true"></i>599,00
                                </span>
                                <span class="mt-h-title">
                                    Qty: 1
                                </span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                        </div><!-- cart row end here -->
                        <!-- cart row start here -->
                        <div class="cart-row">
                            <a href="#" class="img">
                                <img src="https://htmlbeans.com/html/schon/images/products/img37.jpg" alt="image"
                                    class="img-responsive">
                            </a>
                            <div class="mt-h">
                                <span class="mt-h-title"><a href="#">
                                        Marvelous Modern 3 Seater</a>
                                </span>
                                <span class="price">
                                    <i class="fa fa-eur" aria-hidden="true"></i>599,00
                                </span>
                                <span class="mt-h-title">Qty: 1

                                </span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                        </div><!-- cart row end here -->
                        <!-- cart row start here -->
                        <div class="cart-row">
                            <a href="#" class="img">
                                <img src="https://htmlbeans.com/html/schon/images/products/img38.jpg"
                                    alt="image"class="img-responsive">
                            </a>
                            <div class="mt-h">
                                <span class="mt-h-title">
                                    <a href="#">Marvelous Modern 3 Seater</a>
                                </span>
                                <span class="price">
                                    <i class="fa fa-eur" aria-hidden="true"></i>599,00
                                </span>
                                <span class="mt-h-title">Qty: 1</span>
                            </div>
                            <a href="#" class="close fa fa-times"></a>
                        </div><!-- cart row end here -->
                        <!-- cart row total start here -->
                        <div class="cart-row-total">
                            <span class="mt-total">Sub Total</span>
                            <span class="mt-total-txt">
                                <i class="fa fa-eur" aria-hidden="true"></i>799,00
                            </span>
                        </div>
                        <!-- cart row total end here -->
                        <div class="cart-btn-row">
                            <a href="{{ route('cart') }}" class="btn-type2">VIEW CART</a>
                            <a href="{{ route('checkout') }}" class="btn-type3">CHECKOUT</a>
                        </div>
                    </div><!-- mt side widget end here -->
                </div>
                <!-- mt drop sub end here -->
            </div><!-- mt drop end here -->
            <span class="mt-mdropover"></span>
        </li>
        <li>
            <a href="#" class="bar-opener side-opener">
                <span class="bar"></span>
                <span class="bar small"></span>
                <span class="bar"></span>
            </a>
        </li>
        </ul><!-- mt icon list end here -->
        <!-- navigation start here -->

        <!-- mt icon list end here -->
    </div>
    </div>
    </div>

    </div>
    <!-- mt bottom bar end here -->
    <span class="mt-side-over"></span>

    <div class="container-fluid">
        {{ Helper::getHeaderCategory() }}
    </div>

</header>
<!-- mt side menu start here -->
<div class="mt-side-menu" bis_skin_checked="1">
    <!-- mt holder start here -->
    <div class="mt-holder" bis_skin_checked="1">
        <a href="#" class="side-close"><span></span><span></span></a>
        <strong class="mt-side-title">MY ACCOUNT</strong>
        <!-- mt side widget start here -->
        <div class="mt-side-widget" bis_skin_checked="1">
            <header>
                <span class="mt-side-subtitle">SIGN IN</span>
                <p>Welcome back! Sign in to Your Account</p>
            </header>
            <form action="#">
                <fieldset>
                    <input type="text" placeholder="Username or email address" class="input">
                    <input type="password" placeholder="Password" class="input">
                    <div class="box" bis_skin_checked="1">
                        <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                        <a href="#" class="help">Help?</a>
                    </div>
                    <button type="submit" class="btn-type1">Login</button>
                </fieldset>
            </form>
        </div>
        <!-- mt side widget end here -->
        <div class="or-divider" bis_skin_checked="1"><span class="txt">or</span></div>
        <!-- mt side widget start here -->
        <div class="mt-side-widget" bis_skin_checked="1">
            <header>
                <span class="mt-side-subtitle">CREATE NEW ACCOUNT</span>
                <p>Create your very own account</p>
            </header>
            <form action="#">
                <fieldset>
                    <input type="text" placeholder="Username or email address" class="input">
                    <button type="submit" class="btn-type1">Register</button>
                </fieldset>
            </form>
        </div>
        <!-- mt side widget end here -->
    </div>
    <!-- mt holder end here -->
</div>
<!-- mt side menu end here -->



<style>
    .search-results {
        background-color: #F4F4F4;
        padding: 10px;
        margin: 13px 0px;
        width: 100%;
        border-radius: 10px;
        position: absolute;
        top: 46px;
        left: 0px;
        z-index: 60;
        border: 1px solid #a1a1a1;
    }

    .search-results img {
        width: 100px;
        height: auto;
        margin-right: 10px;
        border-radius: 10px;
    }

    .search-results span {
        font: 14px/20px "Montserrat", sans-serif;
    }

    .search-results span:hover {
        color: #ff6060;
    }

    .results {
        list-style: none;
        border-radius: 10px;
        margin: 12px 0px;
        background-color: #fff;
    }
</style>
