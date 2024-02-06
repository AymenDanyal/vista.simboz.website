<div class="reloadCart">

    <header class="header shop">
        <div class="middle-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            @php
                                $settings = DB::table('settings')->get();
                            @endphp
                            <a href="{{ route('home') }}"><img
                                    src="@foreach ($settings as $data) {{ $data->logo }} @endforeach"
                                    alt="logo"></a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                            <!-- Search Form -->
                            <div class="search-top">
                                <form class="search-form">
                                    <input type="text" placeholder="Search here..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <select>
                                    <option>All Category</option>
                                    @foreach (Helper::getAllCategory() as $cat)
                                        <option>{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                                <form method="POST" action="{{ route('product.search') }}">
                                    @csrf
                                    <input name="search" placeholder="Search Products Here....." type="search">
                                    <button class="btnn" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 ">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar shopping">
                                @php
                                    $total_prod = 0;
                                    $total_amount = 0;
                                @endphp
                                @if (session('wishlist'))
                                    @foreach (session('wishlist') as $wishlist_items)
                                        @php
                                            $total_prod += $wishlist_items['quantity'];
                                            $total_amount += $wishlist_items['amount'];
                                        @endphp
                                    @endforeach
                                @endif
                                <a href="{{ route('wishlist') }}" class="single-icon"><i class="fa fa-heart-o"></i>
                                    <span class="total-count">{{ Helper::wishlistCount() }}</span></a>
                                <!-- Shopping Item -->
                                @auth
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{ count(Helper::getAllProductFromWishlist()) }} Items</span>
                                            <a href="{{ route('wishlist') }}">View Wishlist</a>
                                        </div>
                                        <ul class="shopping-list">
                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach (Helper::getAllProductFromWishlist() as $data)
                                                @php
                                                    $photo = explode(',', $data->product['photo']);
                                                @endphp
                                                <li>
                                                    <a href="{{ route('wishlist-delete', $data->id) }}" class="remove"
                                                        title="Remove this item"><i class="fa fa-remove"></i></a>
                                                    <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                            alt="{{ $photo[0] }}"></a>
                                                    <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                            target="_blank">{{ $data->product['title'] }}</a></h4>
                                                    <p class="quantity">{{ $data->quantity }} x - <span
                                                            class="amount">${{ number_format($data->price, 2) }}</span></p>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span
                                                    class="total-amount">${{ number_format(Helper::totalWishlistPrice(), 2) }}</span>
                                            </div>
                                            <a href="{{ route('cart') }}" class="btn animate">Cart</a>
                                        </div>
                                    </div>
                                @endauth
                                <!--/ End Shopping Item -->
                            </div>

                            <div class="reloadCart sinlge-bar shopping">
                                <a href="{{ route('cart') }}" class="single-icon"><i class="ti-bag"></i> <span
                                        class="total-count">{{ Helper::cartCount() }}</span></a>
                                <!-- Shopping Item -->
                                @auth
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{ count(Helper::getAllProductFromCart()) }} Items</span>
                                            <a href="{{ route('cart') }}">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach (Helper::getAllProductFromCart() as $data)
                                                @php
                                                    $photo = explode(',', $data->product['photo']);
                                                @endphp
                                                <li>
                                                    <a href="{{ route('cart-delete', $data->id) }}" class="remove"
                                                        title="Remove this item"><i class="fa fa-remove"></i></a>
                                                    <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                            alt="{{ $photo[0] }}"></a>
                                                    <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                            target="_blank">{{ $data->product['title'] }}</a></h4>
                                                    <p class="quantity">{{ $data->quantity }} x - <span
                                                            class="amount">${{ number_format($data->price, 2) }}</span>
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span
                                                    class="total-amount">${{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                            </div>
                                            <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                @endauth
                                <!--/ End Shopping Item -->
                            </div>


                            <div class="sinlge-bar shopping ">
                                @if (Auth::check())

                                    <a href="#" id="" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        @if (Auth()->user()->photo != '')
                                            <img class="img-profile rounded-circle" src="{{ Auth()->user()->photo }}">
                                        @else
                                            <img class="img-profile rounded-circle"
                                                src="{{ asset('backend/img/avatar.png') }}">
                                        @endif
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span>

                                    </a>
                                @else
                                    <i class="ti-power-off yellow" style="font-size: 1.5em ;"></i>

                                    <a class="yellow" href="{{ route('login.form') }}">Login /</a>
                                    <a class="yellow" href="{{ route('register.form') }}">Register</a>

                                @endif
                                <!-- Dropdown - User Information -->
                                @if (Auth::check())
                                @if (Auth()->user()->role == 'admin')
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('admin') }}">
                                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Dashboard
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin-profile') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('change.password.form') }}">
                                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Change Password
                                        </a>
                                        <a class="dropdown-item" href="{{ route('settings') }}">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                @endif
                                @if (Auth()->user()->role == 'user')
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('user-profile') }}"> 
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.change.password.form') }}">
                                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Change Password
                                        </a>
                                    
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                @endif
                                @endif


                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <div class="header-inner">
            <div id="addProduct2" class="alert alert-success alert-dismissable fade show text-center"
                style="display: none">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                <p>Product Added To Cart</p>
            </div>
            <div id="addWishList2" class="alert alert-success alert-dismissable fade show text-center"
                style="display: none">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                <p>Product Added To Wishlist</p>
            </div>
            <div id="removeWishList2" class="alert alert-success alert-dismissable fade show text-center"
                style="display: none">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                <p>Product Remove From Wishlist</p>
            </div>
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="menu-area">
                                <!-- Main Menu -->

                                <nav class="navbar navbar-expand-lg">

                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <li class="{{ Request::path() == 'home' ? 'active' : '' }}"><a
                                                        href="{{ route('home') }}">Home</a></li>
                                                <li class="{{ Request::path() == 'about-us' ? 'active' : '' }}">
                                                    <a href="{{ route('about-us') }}">About Us</a>
                                                </li>
                                                <li class="@if (Request::path() == 'product-grids' || Request::path() == 'product-lists') active @endif"><a
                                                        href="{{ route('product-grids') }}">Products</a><span
                                                        class="new">New</span></li>
                                                {{ Helper::getHeaderCategory() }}
                                                <li class="{{ Request::path() == 'blog' ? 'active' : '' }}"><a
                                                        href="{{ route('blog') }}">Blog</a></li>

                                                <li class="{{ Request::path() == 'contact' ? 'active' : '' }}">
                                                    <a href="{{ route('contact') }}">Contact Us</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </nav>
                                <!--/ End Main Menu -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
</div>
