@extends('frontend.layouts.master')

@section('title', 'E-SHOP || PRODUCT PAGE')

@section('main-content')
    <div id="wrapper" bis_skin_checked="1">
       
        <!-- W1 start here -->
        <div class="w1" bis_skin_checked="1"> 
            
            <!-- mt search popup start here -->
            <div class="mt-search-popup" bis_skin_checked="1">
                <div class="mt-holder" bis_skin_checked="1">
                    <a href="#" class="search-close"><span></span><span></span></a>
                    <div class="mt-frame" bis_skin_checked="1">
                        <form action="#">
                            <fieldset>
                                <input type="text" placeholder="Search...">
                                <span class="icon-microphone"></span>
                                <button class="icon-magnifier" type="submit"></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- mt search popup end here -->
            <!-- mt main start here -->
            <main id="mt-main">
                <!-- Mt Contact Banner of the Page -->
                <section class="mt-contact-banner style4" style="background-image: url(https://htmlbeans.com/html/schon/images/img11.jpg);">
                    <div class="container" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-xs-12 text-center" bis_skin_checked="1">
                                <h1>CHAIRS</h1>
                                <!-- Breadcrumbs of the Page -->
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Home <i class="fa fa-angle-right"></i></a></li>
                                        <li><a href="#">Products <i class="fa fa-angle-right"></i></a></li>
                                        <li>Chairs</li>
                                    </ul>
                                </nav><!-- Breadcrumbs of the Page end -->
                            </div>
                        </div>
                    </div>
                </section><!-- Mt Contact Banner of the Page end -->
                <div class="container" bis_skin_checked="1">
                    <div class="row" bis_skin_checked="1">
                        <!-- sidebar of the Page start here -->
                        <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                            <!-- shop-widget filter-widget of the Page start here -->
                            <section class="shop-widget filter-widget bg-grey">
                                <h2>FILTER</h2>
                                <span class="sub-title">Filter by Brands</span>
                                <!-- nice-form start here -->
                                <ul class="list-unstyled nice-form">
                                    <li>
                                        <label for="check-1">
                                            <input id="check-1" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Casali</span>
                                        </label>
                                        <span class="num">2</span>
                                    </li>
                                    <li>
                                        <label for="check-2">
                                            <input id="check-2" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Decar</span>
                                        </label>
                                        <span class="num">12</span>
                                    </li>
                                    <li>
                                        <label for="check-3">
                                            <input id="check-3" checked="checked" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Fantini</span>
                                        </label>
                                        <span class="num">4</span>
                                    </li>
                                    <li>
                                        <label for="check-4">
                                            <input id="check-4" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Flamentstyle</span>
                                        </label>
                                        <span class="num">4</span>
                                    </li>
                                    <li>
                                        <label for="check-5">
                                            <input id="check-5" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Heerenhuis</span>
                                        </label>
                                        <span class="num">6</span>
                                    </li>
                                    <li>
                                        <label for="check-6">
                                            <input id="check-6" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Hoffmann</span>
                                        </label>
                                        <span class="num">10</span>
                                    </li>
                                    <li>
                                        <label for="check-7">
                                            <input id="check-7" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Italfloor</span>
                                        </label>
                                        <span class="num">3</span>
                                    </li>
                                </ul><!-- nice-form end here -->
                                <span class="sub-title">Filter by Price</span>
                                <div class="price-range" bis_skin_checked="1">
                                    <div class="range-slider" bis_skin_checked="1">
                                        <span class="dot"></span>
                                        <span class="dot dot2"></span>
                                    </div>
                                    <span class="price">Price &nbsp; $ 10 &nbsp; - &nbsp; $ 599</span>
                                    <a href="#" class="filter-btn">Filter</a>
                                </div>
                            </section><!-- shop-widget filter-widget of the Page end here -->
                            <!-- shop-widget of the Page start here -->
                            <section class="shop-widget">
                                <h2>CATEGORIES</h2>
                                <!-- category list start here -->
                                <ul class="list-unstyled category-list">
                                    <li>
                                        <a href="#">
                                            <span class="name">CHAIRS</span>
                                            <span class="num">12</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">SOFAS</span>
                                            <span class="num">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">ARMCHAIRS</span>
                                            <span class="num">9</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">BEDROOM</span>
                                            <span class="num">2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">LIGHTING</span>
                                            <span class="num">17</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">KITCHEN</span>
                                            <span class="num">10</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="name">ACCESSORIES</span>
                                            <span class="num">23</span>
                                        </a>
                                    </li>
                                </ul><!-- category list end here -->
                            </section><!-- shop-widget of the Page end here -->
                            <!-- shop-widget of the Page start here -->
                            <section class="shop-widget">
                                <h2>HOT SALE</h2>
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20" bis_skin_checked="1">
                                    <div class="img" bis_skin_checked="1">
                                        <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img14.jpg"
                                                alt="image description"></a>
                                    </div>
                                    <div class="text" bis_skin_checked="1">
                                        <div class="frame" bis_skin_checked="1">
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
                                <div class="mt-product4 mt-paddingbottom20" bis_skin_checked="1">
                                    <div class="img" bis_skin_checked="1">
                                        <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img15.jpg"
                                                alt="image description"></a>
                                    </div>
                                    <div class="text" bis_skin_checked="1">
                                        <div class="frame" bis_skin_checked="1">
                                            <strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
                                        </div>
                                        <del class="off">$75,00</del>
                                        <span class="price">$55,00</span>
                                    </div>
                                </div><!-- mt product4 end here -->
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20" bis_skin_checked="1">
                                    <div class="img" bis_skin_checked="1">
                                        <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img16.jpg"
                                                alt="image description"></a>
                                    </div>
                                    <div class="text" bis_skin_checked="1">
                                        <div class="frame" bis_skin_checked="1">
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
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20" bis_skin_checked="1">
                                    <div class="img" bis_skin_checked="1">
                                        <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img20.jpg"
                                                alt="image description"></a>
                                    </div>
                                    <div class="text" bis_skin_checked="1">
                                        <div class="frame" bis_skin_checked="1">
                                            <strong><a href="product-detail.html">Marvelous Wooden Chair</a></strong>
                                        </div>
                                        <del class="off">$75,00</del>
                                        <span class="price">$55,00</span>
                                    </div>
                                </div><!-- mt product4 end here -->
                            </section><!-- shop-widget of the Page end here -->
                        </aside><!-- sidebar of the Page end here -->
                        <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;"
                            bis_skin_checked="1">
                            <!-- mt shoplist header start here -->
                            <header class="mt-shoplist-header">
                                <!-- btn-box start here -->
                                <div class="btn-box" bis_skin_checked="1">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#" class="drop-link">
                                                Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="drop" bis_skin_checked="1">
                                                <ul class="list-unstyled">
                                                    <li><a href="#">ASC</a></li>
                                                    <li><a href="#">DSC</a></li>
                                                    <li><a href="#">Price</a></li>
                                                    <li><a href="#">Relevance</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-large"
                                                    aria-hidden="true"></i></a></li>
                                        <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-list"
                                                    aria-hidden="true"></i></a></li>
                                    </ul>
                                </div><!-- btn-box end here -->
                                <!-- mt-textbox start here -->
                                <div class="mt-textbox" bis_skin_checked="1">
                                    <p>Showing <strong>1–9</strong> of <strong>65</strong> results</p>
                                    <p>View <a href="#">9</a> / <a href="#">18</a> / <a href="#">27</a>
                                        / <a href="#">All</a></p>
                                </div><!-- mt-textbox end here -->
                            </header><!-- mt shoplist header end here -->
                            <!-- mt productlisthold start here -->
                            <ul class="mt-productlisthold list-inline">
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img22.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img23.jpg"
                                                            alt="image description"></a>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Marvelous Modern 3
                                                    Seater</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img24.jpg"
                                                            alt="image description"></a>
                                                    <span class="caption">
                                                        <span class="off">15% Off</span>
                                                    </span>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Chair with
                                                    armrests</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img67.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Pouf Chair</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img68.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Jalis Counter
                                                    stool</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>269,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img24.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img69.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Lucky Chair</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img70.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Cut Chair with 4 Spoke
                                                    Base</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>269,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                                <li>
                                    <!-- mt product1 large start here -->
                                    <div class="mt-product1 large" bis_skin_checked="1">
                                        <div class="box" bis_skin_checked="1">
                                            <div class="b1" bis_skin_checked="1">
                                                <div class="b2" bis_skin_checked="1">
                                                    <a href="product-detail.html"><img src="https://htmlbeans.com/html/schon/images/products/img71.jpg"
                                                            alt="image description"></a>
                                                    <ul class="mt-stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <ul class="links">
                                                        <li><a href="#"><i class="icon-handbag"></i><span>Add to
                                                                    Cart</span></a></li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt" bis_skin_checked="1">
                                            <strong class="title"><a href="product-detail.html">Yard SeChair</a></strong>
                                            <span class="price"><i class="fa fa-eur"></i> <span>139,00</span></span>
                                        </div>
                                    </div><!-- mt product1 center end here -->
                                </li>
                            </ul><!-- mt productlisthold end here -->
                            <!-- mt pagination start here -->
                            <nav class="mt-pagination">
                                <ul class="list-inline">
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ul>
                            </nav><!-- mt pagination end here -->
                        </div>
                    </div>
                </div>
            </main><!-- mt main end here -->
           
        </div><!-- W1 end here -->
        <span id="back-top" class="fa fa-arrow-up"></span>
    </div>
@endsection
@push('styles')
<style>
    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
    display: block;
}
</style>
@endpush
@push('scripts')
@endpush
