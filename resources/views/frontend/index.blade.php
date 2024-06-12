@extends('frontend.layouts.master')
@section('title', 'Vizu || HOME PAGE')
@section('main-content')




<div class="mt-main-slider" >
   
    <!-- slider banner-slider start here -->
    <div class="slider banner-slider slick-slider" role="toolbar" >
        <!-- holder start here -->
        @foreach($banners as $banner)
        
        <div aria-live="polite" class="slick-list draggable" style="height: 586px;" >
                <div class="slick-track" >
                <div class="holder text-center slick-slide" style="background-image: url(&quot;https://htmlbeans.com/html/schon/images/sliders/img06.jpg&quot;); width: 1863px;" >
                    <div class="container" >
                        <div class="row" >
                            <div class="col-xs-12" >
                                <div class="text" >
                                    <strong class="title">{{$banner->summary}}</strong>
                                    <h1>{{$banner->category}}</h1>
                                    <h2> {{$banner->title}}</h2>
                                    <div class="txt" >
                                        <p>{{$banner->description}}</p>
                                    </div>
                                    <a href="product-detail.html" class="shop" tabindex="-1" >shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        @endforeach
    </div>
    <!-- slider regular end here -->
    
</div>
<main id="mt-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- banner frame start here -->
                <div class="banner-frame">
                    <!-- banner-1 start here -->
                    <div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
                        <img alt="image description" src="https://htmlbeans.com/html/schon/images/banner/img01.jpg">
                        <div class="holder">
                            <h2>MY SMALL WRITING <br>DESK</h2>
                            <div class="txts">
                                <a class="btn-shop" href="product-detail.html">
                                    <span>shop now</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <div class="discount">
                                    <span>-20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- banner-1 end here -->

                    <!-- banner-box first start here -->
                    <div class="banner-box first">
                        <!-- banner-2 start here -->
                        <div class="banner-2 wow fadeInUp" data-wow-delay="0.4s">
                            <img alt="image description" src="https://htmlbeans.com/html/schon/images/banner/img02.jpg">
                            <div class="holder">
                                <h2>MODULAR LOUNGE <br>TEAK</h2>
                                <span class="price">$ 129.00</span>
                            </div>
                        </div>
                        <!-- banner-2 end here -->

                        <!-- banner-3 start here -->
                        <div class="banner-3 right wow fadeInDown" data-wow-delay="0.4s">
                            <img alt="image description" src="https://htmlbeans.com/html/schon/images/banner/img03.jpg">
                            <div class="holder">
                                <h2>Modular technical <br>fabric sofa</h2>
                                <a href="product-detail.html" class="shop">SHOP NOW</a>
                            </div>
                        </div>
                        <!-- banner-3 end here -->
                    </div>
                    <!-- banner-box first end here -->

                    <!-- banner-4 start here -->
                    <div class="banner-4 hidden-sm wow fadeInRight" data-wow-delay="0.4s">
                        <img alt="image description" src="https://htmlbeans.com/html/schon/images/banner/img04.jpg">
                        <div class="holder">
                            <h2>Direct light <br>pendant lamp</h2>
                            <span class="price">$ 129.00</span>
                            <a class="btn-shop add" href="product-detail.html">
                                <span>shop now</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- banner-4 end here -->
                </div>
                <!-- banner frame end here -->
                {{-- <!-- mt producttabs start here -->
                <div class="mt-producttabs wow fadeInUp" data-wow-delay="0.4s">
                    <!-- producttabs start here -->
                    <ul class="producttabs">
                        <li><a href="#tab1" class="active">FEATURED</a></li>
                        <li><a href="#tab2">LATEST</a></li>
                        <li><a href="#tab3">BEST SELLER</a></li>
                    </ul>
                    <!-- producttabs end here -->
                    <div class="tab-content text-center">
                        <div id="tab1">
                            <!-- tabs slider start here -->
                            <div class="tabs-slider">

                                @php
                                    $counter = 0;
                                @endphp

                                @foreach($featured as $feature)
                                    <!-- slide start here -->
                                    <div class="slide">
                                        @if(isset($featured[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $featured[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($featured[$counter]->condition !== 'default')
                                                                <span class="new">{{ $featured[$counter]->condition }}</span>
                                                            @endif
                                                            @if($featured[$counter]->discount > 50)
                                                                <span class="off">{{ $featured[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $featured[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $featured[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                        
                                        @if(isset($featured[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $featured[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($featured[$counter]->condition !== 'default')
                                                                <span class="new">{{ $featured[$counter]->condition }}</span>
                                                            @endif
                                                            @if($featured[$counter]->discount > 50)
                                                                <span class="off">{{ $featured[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $featured[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $featured[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                    </div>
                                    <!-- slide end here -->
                                @endforeach














                                
                            </div>
                            <!-- tabs slider end here -->
                        </div>
                        <div id="tab2">
                            <!-- tabs slider start here -->
                            <div class="tabs-slider">

                                @php
                                    $counter = 0;
                                @endphp

                                @foreach($latests as $latest)
                                    <!-- slide start here -->
                                    <div class="slide">
                                        @if(isset($latests[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $latests[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($latests[$counter]->condition !== 'default')
                                                                <span class="new">{{ $latests[$counter]->condition }}</span>
                                                            @endif
                                                            @if($latests[$counter]->discount > 50)
                                                                <span class="off">{{ $latests[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $latests[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $latests[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                        
                                        @if(isset($latests[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $latests[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($latests[$counter]->condition !== 'default')
                                                                <span class="new">{{ $latests[$counter]->condition }}</span>
                                                            @endif
                                                            @if($latests[$counter]->discount > 50)
                                                                <span class="off">{{ $latests[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $latests[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $latests[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                    </div>
                                    <!-- slide end here -->
                                @endforeach
                                
                            </div>
                            <!-- tabs slider end here -->
                        </div>
                        <div id="tab3">
                            <!-- tabs slider start here -->
                            <div class="tabs-slider">

                                @php
                                    $counter = 0;
                                @endphp

                                @foreach($bestSellers as $bestSeller)
                                    <!-- slide start here -->
                                    <div class="slide">
                                        @if(isset($bestSellers[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $bestSellers[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($bestSellers[$counter]->condition !== 'default')
                                                                <span class="new">{{ $bestSellers[$counter]->condition }}</span>
                                                            @endif
                                                            @if($bestSellers[$counter]->discount > 50)
                                                                <span class="off">{{ $bestSellers[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $bestSellers[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSellers[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                        
                                        @if(isset($bestSellers[$counter]))
                                        <!-- mt product1 center start here -->
                                        <div class="mt-product1 mt-paddingbottom20">
                                            <div class="box">
                                                <div class="b1">
                                                    <div class="b2">
                                                        <a href="product-detail.html"><img src="{{ $bestSellers[$counter]->photo }}" alt="image description"></a>
                                                        <span class="caption">
                                                            @if($bestSellers[$counter]->condition !== 'default')
                                                                <span class="new">{{ $bestSellers[$counter]->condition }}</span>
                                                            @endif
                                                            @if($bestSellers[$counter]->discount > 50)
                                                                <span class="off">{{ $bestSellers[$counter]->discount }}% Off</span>
                                                            @endif
                                                        </span>
                                                        <ul class="mt-stars">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                        <ul class="links">
                                                            <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                            <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="txt">
                                                <strong class="title"><a href="product-detail.html">{{ $bestSellers[$counter]->title }}</a></strong>
                                                <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSellers[$counter]->price }}</span></span>
                                            </div>
                                        </div>
                                        <!-- mt product1 center end here -->
                                        
                                        @php
                                            $counter++;
                                        @endphp
                                        @endif
                                    </div>
                                    <!-- slide end here -->
                                @endforeach                             
                            </div>
                            <!-- tabs slider end here -->
                        </div>
                    </div>
                </div>
                <!-- mt producttabs end here --> --}}
            </div>
        </div>
    </div>
    <!-- mt bestseller start here -->
    <div class="mt-bestseller mt-3 bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 mt-heading text-uppercase">
                    <h2 class="heading">BEST SELLER</h2>
                    <p>EXCEPTEUR SINT OCCAECAT</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="bestseller-slider">
                        @foreach($bestSellers as $bestSeller)
                        <!-- slide start here -->
                        <div class="slide">
                        
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="{{ $bestSeller->photo }}" alt="image description"></a>
                                            <span class="caption">
                                                @if($bestSeller->condition !== 'default')
                                                    <span class="new">{{ $bestSeller->condition }}</span>
                                                @endif
                                                @if($bestSeller->discount > 50)
                                                    <span class="off">{{ $bestSeller->discount }}% Off</span>
                                                @endif
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="product-detail.html">{{ $bestSeller->title }}</a></strong>
                                    <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSeller->price }}</span></span>
                                </div>
                            </div>
                            <!-- mt product1 center end here -->
                            
                           
                            
                        </div>
                        <!-- slide end here -->
                    @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-bestseller bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 mt-heading text-uppercase">
                    <h2 class="heading">BEST SELLER</h2>
                    <p>EXCEPTEUR SINT OCCAECAT</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="bestseller-slider">
                        @foreach($bestSellers as $bestSeller)
                        <!-- slide start here -->
                        <div class="slide">
                        
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="{{ $bestSeller->photo }}" alt="image description"></a>
                                            <span class="caption">
                                                @if($bestSeller->condition !== 'default')
                                                    <span class="new">{{ $bestSeller->condition }}</span>
                                                @endif
                                                @if($bestSeller->discount > 50)
                                                    <span class="off">{{ $bestSeller->discount }}% Off</span>
                                                @endif
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="product-detail.html">{{ $bestSeller->title }}</a></strong>
                                    <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSeller->price }}</span></span>
                                </div>
                            </div>
                            <!-- mt product1 center end here -->
                            
                           
                            
                        </div>
                        <!-- slide end here -->
                    @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder text-center mt-5" style="background-image: url(&quot;https://htmlbeans.com/html/schon/images/sliders/img06.jpg&quot;);width: 1863px;height: 600px;" aria-hidden="true" >
        <div class="container" >
            <div class="row" >
                <div class="col-xs-12">
                    <div class="text">
                        {{-- <strong class="title">lure delectus earum</strong>
                        <h1>lure delectus earum</h1>
                        <h2> Iure delectus earum</h2>
                        <div class="txt" >
                            <p>lure delectus earum</p>
                        </div>
                        <a href="product-detail.html" class="shop" tabindex="0">shop now</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-bestseller mt-3  bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 mt-heading text-uppercase">
                    <h2 class="heading">BEST SELLER</h2>
                    <p>EXCEPTEUR SINT OCCAECAT</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="bestseller-slider">
                        @foreach($bestSellers as $bestSeller)
                        <!-- slide start here -->
                        <div class="slide">
                        
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="{{ $bestSeller->photo }}" alt="image description"></a>
                                            <span class="caption">
                                                @if($bestSeller->condition !== 'default')
                                                    <span class="new">{{ $bestSeller->condition }}</span>
                                                @endif
                                                @if($bestSeller->discount > 50)
                                                    <span class="off">{{ $bestSeller->discount }}% Off</span>
                                                @endif
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="product-detail.html">{{ $bestSeller->title }}</a></strong>
                                    <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSeller->price }}</span></span>
                                </div>
                            </div>
                            <!-- mt product1 center end here -->
                            
                           
                            
                        </div>
                        <!-- slide end here -->
                    @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-bestseller bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 mt-heading text-uppercase">
                    <h2 class="heading">BEST SELLER</h2>
                    <p>EXCEPTEUR SINT OCCAECAT</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="bestseller-slider">
                        @foreach($bestSellers as $bestSeller)
                        <!-- slide start here -->
                        <div class="slide">
                        
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="{{ $bestSeller->photo }}" alt="image description"></a>
                                            <span class="caption">
                                                @if($bestSeller->condition !== 'default')
                                                    <span class="new">{{ $bestSeller->condition }}</span>
                                                @endif
                                                @if($bestSeller->discount > 50)
                                                    <span class="off">{{ $bestSeller->discount }}% Off</span>
                                                @endif
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                <li><a href="#popup1" class="lightbox"><i class="icomoon icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="product-detail.html">{{ $bestSeller->title }}</a></strong>
                                    <span class="price"><i class="fa fa-eur"></i> <span>{{ $bestSeller->price }}</span></span>
                                </div>
                            </div>
                            <!-- mt product1 center end here -->
                            
                           
                            
                        </div>
                        <!-- slide end here -->
                    @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mt bestseller start here -->
    {{-- <div class="mt-smallproducts">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
                    <h3 class="heading">Hot Sale</h3>
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img14.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Egon Wooden Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img15.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img16.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Kurve Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
                    <h3 class="heading">Featured Products</h3>
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img17.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Bombi Chair</a></strong>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$33,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img18.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
                            </div>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img19.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Puff Chair</a></strong>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs wow fadeInRight" data-wow-delay="0.4s">
                    <h3 class="heading">Sale Products</h3>
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img20.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Marvelous Wooden Chair</a></strong>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img21.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img16.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Kurve Chair</a></strong>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInRight" data-wow-delay="0.4s">
                    <h3 class="heading">Top Rated Products</h3>
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img14.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Egon Wooden Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img15.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                    <!-- mt product4 start here -->
                    <div class="mt-product4 mt-paddingbottom20">
                        <div class="img">
                            <a href="product-detail.html"><img alt="image description" src="https://htmlbeans.com/html/schon/images/products/img16.jpg"></a>
                        </div>
                        <div class="text">
                            <div class="frame">
                                <strong><a href="product-detail.html">Kurve Chair</a></strong>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                            </div>
                            <del class="off">$75,00</del>
                            <span class="price">$55,00</span>
                        </div>
                    </div><!-- mt product4 end here -->
                </div>
            </div>
        </div>
    </div><!-- mt bestseller end here --> --}}
</main><!-- mt main end here -->

@endsection

@push('styles')
<style>
   
</style>
@endpush

@push('scripts')
<script>

</script>
@endpush
