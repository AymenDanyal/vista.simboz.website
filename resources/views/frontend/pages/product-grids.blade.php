@extends('frontend.layouts.master')

@section('title', 'Vizu || PRODUCT PAGE')

@section('main-content')
    <div id="wrapper">

        <!-- W1 start here -->
        <div class="w1">

            <!-- mt search popup start here -->
            <div class="mt-search-popup">
                <div class="mt-holder">
                    <a href="#" class="search-close"><span></span><span></span></a>
                    <div class="mt-frame">
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
                <section class="mt-contact-banner style4" style="background-image: url('{{$categories->photo}}')">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h1 id="banner-title">{{$categories->title}}</h1>
                                <!-- Breadcrumbs of the Page -->
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled breadcrumbs-list">
                                        <li><a href="/">Home <i class="fa fa-angle-right"></i></a></li>
                                        <li>{{$categories->title}}</li>
                                    </ul>
                                </nav><!-- Breadcrumbs of the Page end -->
                            </div>
                        </div>
                    </div>
                </section><!-- Mt Contact Banner of the Page end -->
                <div class="container">
                    <div class="row">
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
                                        <label for="check-7">
                                            <input id="check-7" type="checkbox">
                                            <span class="fake-input"></span>
                                            <span class="fake-label">Italfloor</span>
                                        </label>
                                        <span class="num">3</span>
                                    </li>
                                </ul><!-- nice-form end here -->

                            </section>
                            
                        </aside><!-- sidebar of the Page end here -->
                        <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                            <!-- mt shoplist header start here -->
                            <header class="mt-shoplist-header">
                                <!-- btn-box start here -->
                                <div class="btn-box">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#" class="drop-link">
                                                Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="drop">
                                                <ul class="list-unstyled">
                                                    <li><a href="#">ASC</a></li>
                                                    <li><a href="#">DSC</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-inline-item"><a class="mt-viewswitcher" href="#"><i
                                                    class="fa fa-th-large" aria-hidden="true"></i></a></li>
                                        <li class="list-inline-item"><a class="mt-viewswitcher" href="#"><i
                                                    class="fa fa-th-list" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div><!-- btn-box end here -->
                                <!-- mt-textbox start here -->
                                <div class="mt-textbox">
                                    <p>Showing <strong>1–9</strong> of <strong>65</strong> results</p>
                                    <p>View
                                        <a href="#">9</a>
                                        /
                                        <a href="#">18</a>
                                        / <a href="#">27</a>
                                        / <a href="#">All</a>
                                    </p>
                                </div><!-- mt-textbox end here -->
                            </header><!-- mt shoplist header end here -->
                            <!-- mt productlisthold start here -->
                            <ul class="mt-productlisthold list-inline row">

                            </ul><!-- mt productlisthold end here -->
                            <!-- mt pagination start here -->
                            <nav class="mt-pagination">
                                <ul class="list-inline">

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
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        menu,
        nav,
        section,
        summary {
            display: block;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            // Variable declarations
            var products = {!! json_encode($products) !!};
            var categoriesData = {!! json_encode($categories) !!};
            console.log(categoriesData.id);
            // Create category elements
            createCategoryElement();
            // Create products elements
            createProductsGrid(products,categoriesData.id);


            // Function to create category inside bar
            function createCategoryElement() {
                var $ul = $('.shop-widget .nice-form');
                // $.each(categoriesData, function(index, category) {
                //     var isChecked = category.checked ? 'checked="checked"' : '';
                //     var $li = $(`
                //     <li>
                //         <label for="check-${index + 1}">
                //             <input id="check-${index + 1}" type="checkbox" ${isChecked}>
                //             <span class="fake-input"></span>
                //             <span class="fake-label">${category.title}</span>
                //         </label>
                //         <span class="num">${category.count}</span>
                //     </li>
                // `);
                //     $ul.append($li);
                // });
                $('ul.breadcrumbs-list').children().last().remove();
                $('ul.breadcrumbs-list').append('<li>'+categoriesData.title+'</li>');
            }
            function getProducts(categoryId,search1,page) {

                $.ajax({
                    type: 'POST',
                    url: '/product/search',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        
                        page: page,
                        categoryId: categoryId,
                    
                     },
                    success: function (response) {
                        // Handle success response
                        $('.mt-productlisthold').empty();
                        createProductsGrid(response,categoryId);
                    
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        // You can show an error message to the user
                    }
            });
                
            }
            // Function to create products
            function createProductsGrid(values,categoryId) {
                //create products
                console.log(values);
                var $ul = $('.mt-productlisthold ');
                $.each(values.data, function(index, value) {
                    // Check if product.photo exists
                    if (value.photo) {
                        var $li = $(`
                        <div class="list-inline-item col-lg-4 col-sm-6 m-0">
                            <div class="mt-product1 large">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="/product_detail">
                                                <img src="${value.photo}" alt="image description loading="lazy">
                                            </a>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-handbag"></i>
                                                        <span>Add to Cart</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icomoon icon-heart-empty"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="icomoon icon-exchange"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt">
                                    <strong class="title"><a href="/product_detail">${value.title}</a></strong>
                                    <span class="price">Rs <span>${value.price}</span></span>
                                </div>
                            </div>
                        </div>
                    `);
                        $ul.append($li);
                    } else {
                        console.error(`Product at index ${index} is missing photo`);
                    }
                });
                //create pagination
                var $paginationUl = $('.mt-pagination .list-inline');
                $('.mt-pagination .list-inline').empty();
                for (var i = 1; i <= values.last_page; i++) {
                    var $li = $(`
                        <li class="list-inline-item ${i === values.current_page ? 'active' : ''}">
                            <span class="page-button" data-page="${i}" data-category="${categoryId}">${i}</span>
                        </li>
                    `);
                    $paginationUl.append($li);
                }
                // Update product count information
                $('.mt-textbox p strong').eq(0).text(`${values.from}–${values.to}`);
                $('.mt-textbox p strong').eq(1).text(values.total);
            }

            $(document).on('click', '.page-button', function() {
                var page = $(this).data('page');
                var category=$(this).data('category');
                var search=null;
                getProducts(category,search,page)
            });

        });

    </script>
@endpush
