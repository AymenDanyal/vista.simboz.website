@extends('frontend.layouts.master')
@section('title', 'E-SHOP || HOME PAGE')
@section('main-content')
    <!-- Slider Area -->

    <div class="mt-main-slider">
        <!-- slider banner-slider start here -->
        <div class="slider banner-slider">
            @if (count($banners) > 0)
                @foreach ($banners as $key => $banner)
                    <div class="holder text-center" style="background-image: url({{ $banner->photo }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text centerize">
                                        <strong class="title">{{ $banner->title }}</strong>
                                        <h1>LIGHTING</h1>
                                        <h2>PENDANT LAMPS</h2>
                                        <div class="txt">
                                            <p>{!! html_entity_decode($banner->description) !!}</p>
                                        </div>
                                        <a href="{{ route('product-grids') }}" class="shop">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif

        </div>

    </div>



    <!--/ End Slider Area -->

    <!-- Start Small Banner  -->
    <section class="small-banner section">
        <div class="container-fluid">
            <div class="row">
                @php
                    $category_lists = DB::table('categories')->where('status', 'active')->limit(3)->get();
                @endphp
                @if ($category_lists)
                    @foreach ($category_lists as $cat)
                        @if ($cat->is_parent == 1)
                            <!-- Single Banner  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-banner">
                                    @if ($cat->photo)
                                        <img src="{{ $cat->photo }}" alt="{{ $cat->photo }}">
                                    @else
                                        <img src="https://via.placeholder.com/600x370" alt="#">
                                    @endif
                                    <div class="content">
                                        <h3>{{ $cat->title }}</h3>
                                        <a href="{{ route('product-cat', $cat->slug) }}">Discover Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- /End Single Banner  -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- End Small Banner -->


    <!-- Start Product Area -->
    <!-- mt producttabs start here -->
    <div class="mt-producttabs wow fadeInUp" data-wow-delay="0.4s">
        <!-- producttabs start here -->
        @php
            $categories = DB::table('categories')->where('status', 'active')->where('is_parent', 1)->get();
            // dd($categories);
        @endphp

        <ul class="producttabs" >
            @foreach ($categories as $key => $cat)
                <li>
                    <a href="#{{ $cat->id }}" class="">{{ $cat->title }}</a>
                </li>
            @endforeach
        </ul>
        <!-- producttabs end here -->
        
        <div class="tab-content text-center">
            @php
                $product_lists = DB::table('products')->where('status', 'active')->orderBy('id', 'DESC')->get();
                $product_groups = $product_lists->groupBy('cat_id');
                $slides_needed = count($product_groups);
                $products_per_slide = 2;
            @endphp
        
            @foreach ($product_groups as $cat_id => $products)
                <div id="{{ $cat_id }}">
                    <!-- tabs slider start here -->
                    <div class="tabs-slider">
                        <!-- slide start here -->
                        <div class="slide">
                            @foreach ($products->chunk($products_per_slide) as $chunk)
                                <div class="mt-product1 mt-paddingbottom20">
                                    <div class="box">
                                        <div class="b1">
                                            <div class="b2">
                                                @foreach ($chunk as $product)
                                                    <a href="{{ route('product-detail', $product->slug) }}">
                                                        <img src="{{ $product->photo }}" alt="image description">
                                                    </a>
                                                    <span class="caption">
                                                        @if ($product->stock <= 0)
                                                            <span class="out-of-stock">Sale out</span>
                                                        @elseif($product->condition == 'new')
                                                            <span class="new">New</span>
                                                        @elseif($product->condition == 'hot') 
                                                            <span class="hot">Hot</span>
                                                        @else
                                                            <span class="price-dec">{{ $product->discount }}% Off</span>
                                                        @endif
                                                    </span>
                                                    <ul class="links">
                                                        <li>
                                                            <a class="cart" data-slug="{{ $product->slug }}">
                                                                <i class="icon-handbag"></i>
                                                                <span id="test">Add to Cart</span>
                                                            </a>
                                                        </li>
                                                        <li><a data-slug="{{ $product->slug }}" class="addWhishlist" href="#"><i
                                                                    class="icomoon icon-heart-empty"></i></a></li>
                                                        <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- mt product1 center end here -->
                            @endforeach
                        </div>
                        <!-- slide end here -->
                    </div>
                    <!-- tabs slider end here -->
                </div>
            @endforeach
        </div>
        
        
    </div>
    <!-- mt producttabs end here -->





    <!-- End Product Area -->
    @php
        $featured = DB::table('products')->where('is_featured', 1)->where('status', 'active')->orderBy('id', 'DESC')->limit(1)->get();
    @endphp
    <!-- Start Midium Banner  -->
    {{-- <section class="midium-banner">
        <div class="container">
            <div class="row">
                @if ($featured)
                    @foreach ($featured as $data)
                        <!-- Single Banner  -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-banner">
                                @php
                                    $photo = explode(',', $data->photo);
                                @endphp
                                <img src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                <div class="content">
                                    <p>{{ $data->cat_info['title'] }}</p>
                                    <h3>{{ $data->title }} <br>Up to<span> {{ $data->discount }}%</span></h3>
                                    <a href="{{ route('product-detail', $data->slug) }}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- /End Single Banner  -->
                    @endforeach
                @endif
            </div>
        </div>
    </section> --}}
    <!-- End Midium Banner -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Hot Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach ($product_lists as $product)
                            @if ($product->condition == 'hot')
                                <!-- Start Single Product -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('product-detail', $product->slug) }}">
                                            @php
                                                $photo = explode(',', $product->photo);
                                                // dd($photo);
                                            @endphp
                                            <img class="default-img" src="{{ $photo[0] }}"
                                                alt="{{ $photo[0] }}">
                                            <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                                            {{-- <span class="out-of-stock">Hot</span> --}}
                                        </a>
                                        <div class="button-head">
                                            <div class="product-action">
                                                <a data-toggle="modal" data-target="#{{ $product->id }}"
                                                    title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick
                                                        Shop</span></a>
                                                <span data-slug="{{ $product->slug }}" class="addWhishlist"><i
                                                        class="ti-heart"></i></span>
                                            </div>
                                            <div class="product-action-2">
                                                <a href="{{ route('add-to-cart', $product->slug) }}">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a
                                                href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                        </h3>
                                        <div class="product-price">
                                            <span class="old">${{ number_format($product->price, 2) }}</span>
                                            @php
                                                $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                            @endphp
                                            <span>${{ number_format($after_discount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Product -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->



    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>From Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($posts)
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Blog  -->
                            <div class="shop-single-blog">
                                <img src="{{ $post->photo }}" alt="{{ $post->photo }}">
                                <div class="content">
                                    <p class="date">{{ $post->created_at->format('d M , Y. D') }}</p>
                                    <a href="{{ route('blog.detail', $post->slug) }}"
                                        class="title">{{ $post->title }}</a>
                                    <a href="{{ route('blog.detail', $post->slug) }}" class="more-btn">Continue
                                        Reading</a>
                                </div>
                            </div>
                            <!-- End Single Blog  -->
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- End Shop Blog  -->


    @include('frontend.layouts.newsletter')

    <!-- Modal -->
    @if ($product_lists)
        @foreach ($product_lists as $key => $product)
            <div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            @php
                                                $photo = explode(',', $product->photo);
                                                // dd($photo);
                                            @endphp
                                            @foreach ($photo as $data)
                                                <div class="single-slider">
                                                    <img src="{{ $data }}" alt="{{ $data }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{ $product->title }}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    {{-- <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="fa fa-star"></i> --}}
                                                    @php
                                                        $rate = DB::table('product_reviews')
                                                            ->where('product_id', $product->id)
                                                            ->avg('rate');
                                                        $rate_count = DB::table('product_reviews')
                                                            ->where('product_id', $product->id)
                                                            ->count();
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($rate >= $i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{ $rate_count }} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if ($product->stock > 0)
                                                    <span><i class="fa fa-check-circle-o"></i> {{ $product->stock }} in
                                                        stock</span>
                                                @else
                                                    <span><i class="fa fa-times-circle-o text-danger"></i>
                                                        {{ $product->stock }} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <h3><small><del
                                                    class="text-muted">${{ number_format($product->price, 2) }}</del></small>
                                            ${{ number_format($after_discount, 2) }} </h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if ($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            @php
                                                                $sizes = explode(',', $product->size);
                                                                // dd($sizes);
                                                            @endphp
                                                            @foreach ($sizes as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">Color</h5>
                                                        <select>
                                                            <option selected="selected">orange</option>
                                                            <option>purple</option>
                                                            <option>black</option>
                                                            <option>pink</option>
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endif

                                        <div class="quantity">
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{ $product->slug }}">
                                                <input type="text" name="quant[1]" class="input-number"
                                                    data-min="1" data-max="1000" value="1">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>
                                        <div class="add-to-cart">
                                            <button data-slug="{{ $product->slug }}" class='cart btn' type="submit"
                                                class="btn">
                                                Add to cart
                                            </button>

                                            <span data-slug="{{ $product->slug }}" class="addWhishlist"><i
                                                    class="ti-heart"></i></span>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- Modal end -->
@endsection

@push('styles')
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
            background: #000000;
            color: black;
        }

        #Gslider .carousel-inner {
            height: 550px;
        }

        #Gslider .carousel-inner img {
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        /*==================================================================
                                        [ Isotope ]*/
        $(document).ready(function() {
            var $topeContainer = $('.isotope-grid');
            var $filter = $('.filter-tope-group');

            // filter items on button click
            $filter.each(function() {
                $filter.on('click', 'button', function() {
                    var filterValue = $(this).attr('data-filter');
                    $topeContainer.isotope({
                        filter: filterValue
                    });
                });

            });

            // init Isotope
            $(window).on('load', function() {
                var $grid = $topeContainer.each(function() {
                    $(this).isotope({
                        itemSelector: '.isotope-item',
                        layoutMode: 'fitRows',
                        percentPosition: true,
                        animationEngine: 'best-available',
                        masonry: {
                            columnWidth: '.isotope-item'
                        }
                    });
                });
            });

            var isotopeButton = $('.filter-tope-group button');

            $(isotopeButton).each(function() {
                $(this).on('click', function() {
                    for (var i = 0; i < isotopeButton.length; i++) {
                        $(isotopeButton[i]).removeClass('how-active1');
                    }

                    $(this).addClass('how-active1');
                });
            });

            function cancelFullScreen(el) {
                var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el
                    .exitFullscreen;
                if (requestMethod) { // cancel full screen.
                    requestMethod.call(el);
                } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                    var wscript = new ActiveXObject("WScript.Shell");
                    if (wscript !== null) {
                        wscript.SendKeys("{F11}");
                    }
                }
            }

            function requestFullScreen(el) {
                // Supports most browsers and their versions.
                var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen ||
                    el
                    .msRequestFullscreen;

                if (requestMethod) { // Native full screen.
                    requestMethod.call(el);
                } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                    var wscript = new ActiveXObject("WScript.Shell");
                    if (wscript !== null) {
                        wscript.SendKeys("{F11}");
                    }
                }
                return false
            }

            $('.cart').click(function() {
                var quantity = $('#quantity').val();
                var slug = $(this).data('slug');
                // alert(quantity);
                $.ajax({
                    url: "{{ route('add-to-cart') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: 1,
                        slug: slug
                    },

                    success: function(response) {
                        if (response.success) {
                            $('.reloadCart').html(response.reloadCart);
                            $('#addProduct2').show();
                            setTimeout(function() {
                                $('#addProduct2').fadeOut();
                            }, 3000);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 401) {
                            // If unauthenticated, redirect to the login page
                            window.location.href = "{{ route('login.form') }}";
                        } else {
                            // Handle other errors
                            console.error(error);
                        }
                    }

                })

            });
            $('.addWhishlist').click(function() {
                var slug = $(this).data('slug');
                // alert(quantity);
                $.ajax({
                    url: "{{ route('add-to-wishlist') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        slug: slug
                    },

                    success: function(response) {
                        if (response.success) {
                            $('.reloadCart').html(response.reloadCart);
                            if (response.message.includes('added')) {
                                $('#addWishList2').show();
                                setTimeout(function() {
                                    $('#addWishList2').fadeOut();
                                }, 3000);
                            } else {
                                $('#removeWishList2').show();
                                setTimeout(function() {
                                    $('#removeWishList2').fadeOut();
                                }, 3000);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 401) {
                            // If unauthenticated, redirect to the login page
                            window.location.href = "{{ route('login.form') }}";
                        } else {
                            // Handle other errors
                            console.error(error);
                        }





                    }
                })

            });
        });
    </script>
@endpush
