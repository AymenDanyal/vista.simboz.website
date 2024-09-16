@extends('frontend.layouts.master')

@section('title', 'Vizu || PRODUCT GRID')

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
                        <div class="col-xs-12 text-center ">
                            <h1 id="banner-title">{{$categories->title}}</h1>
                            <div class="button-holder wow fadeInLeft" data-wow-delay="0.4s"
                                style="visibility: hidden;animation-delay: 0.4s;animation-name: fadeInLeft;">
                                <span class="banner-button"><a href="#productsGrid" id="browse-button">Browse
                                        Designs</a></span>
                                <span class="banner-button" id="uplaod-button">Uplaod Design</span>
                                <span class="banner-button" id="reorder-button">Reorder</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- Mt Contact Banner of the Page end -->
            <div class="container-fluid">
                <div class="row">
                    <!-- sidebar of the Page start here -->
                    <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                        <!-- shop-widget filter-widget of the Page start here -->
                        <section class="shop-widget filter-widget bg-grey">
                            <h2>FILTER</h2>
                            <div class="sub-filter">
                                @foreach ($filterArray as $filter )
                                <div class="filterName">
                                    <p>{{$filter['filter_name']}}</p>
                                </div>
           
                                @foreach ($filter['parameters'] as $key => $filterParam)
                                @if($filter['filter_name'] == "Color")
                                <ul>
                                    <li class="d-flex justify-content-between align-items-center color">
                                        
                                        <label for="{{ $filterParam }}" class="mr-2" style="background-color:{{ $filterParam }};"><p>{{$filterParam}}</p></label>
                                        <input data-param-id="{{$key}}" data-filter-id="{{$filter['filter_id']}}"
                                            class="filterPara color" type="checkbox">
                                    </li>
                                </ul>
                                @else
                                <ul>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <p>{{$filterParam}}</p>
                                        <input data-param-id="{{$key}}" data-filter-id="{{$filter['filter_id']}}"
                                            class="filterPara" type="checkbox">
                                    </li>
                                </ul>
                                @endif
                                @endforeach
                                @endforeach
                            </div>


                        </section>

                    </aside><!-- sidebar of the Page end here -->
                    <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s"
                        style="visibility: hidden;animation-delay: 0.4s;animation-name: fadeInRight;margin-left: 338px;"
                        id="productsGrid">
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
                            <!-- Breadcrumbs of the Page -->
                            <div class="product-grid">
                                <nav class="breadcrumbs">
                                    <ul class="list-unstyled breadcrumbs-list">
                                        <li><a href="/">Home <i class="fa fa-angle-right"></i></a></li>
                                        <li>{{$categories->title}}</li>
                                    </ul>
                                </nav><!-- Breadcrumbs of the Page end -->
                            </div>
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

<!-- Modal -->
{{-- <div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100 img-fluid modal-img"
                            src="https://htmlbeans.com/html/schon/images/products/img22.jpg">
                        <div class="modal-text text-center">
                            <h5 class="modal-title">Modal title</h5>

                        </div>
                    </div>
                    <div class="col-md-6 p-5">
                        <form action="" method="POST" class="row g-3">
                            @csrf

                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                            <label for="quantity">Size</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                            <label for="quantity">Material</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                        </form>

                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <span class="modal-button"><a class="order-link" href="/" style="color: white;">Order
                                    Now</a></span>
                            <span class="modal-button">
                                <a class="visualize-link" data-auth={{auth()->check() ? 1 : 0 }} style="color:
                                    white;">Visualize</a></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="uploadDesignModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col p-5">
                        <form action="" method="POST" class="row g-3">
                            @csrf

                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                            <label for="quantity">Size</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                            <label for="quantity">Material</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1">

                        </form>

                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <span class="modal-button"><a class="order-link" href="/" style="color: white;">Order
                                    Now</a></span>
                            <span class="modal-button"><a class="visualize-link" href="/"
                                    style="color: white;">Visualize</a></span>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('styles')
<style>

    .color label {
        border-radius: 8px;
        cursor: pointer;
        content: '';
        width: auto;
        height: auto;
        padding:5px;
        display: inline-block;
        border: 2px solid #c1c1c1;  
    }





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

    .filterName {
        font-family: inherit;
        font-size: 16px;
        font-weight: 600;
        color: #454545;
    }

    .filterPara {
        margin: -17px;
    }

    .banner-button {
        background-color: #fff;
        border: 1px solid #a1a1a1;
        border-radius: 50px;
        padding: 5px 17px;
        margin: 30px;
        font-weight: 500;
        color: #000;
        margin-top: 70px;
    }

    .banner-button:hover {
        color: #ff6060;
        border-color: #ff6060 !important;
    }

    #browse-button:hover {
        color: #ff6060;
    }

    .button-holder {
        position: absolute;
        left: 438px;
        top: 210px;
    }

    #sidebar {
        visibility: visible;
        animation-delay: 0.4s;
        animation-name: fadeInLeft;
        position: fixed;
        top: 220px;
        left: 28px;
        width: 323px;
    }

    .add-button {
        cursor: pointer;
    }

    .modal-title {
        font-family: inherit !important;
        font-size: 29px !important;
        font-weight: 600 !important;
        color: #757575 !important;
    }

    .modal-button {
        padding: 8px 26px;
        background-color: #757575;
        color: white;
        border-radius: 4px;
        margin: 8px 11px;
        cursor: pointer;
        font-size: 19px;
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
      
        // Variable declarations
        var categoryId ={!! json_encode($cat_id) !!};
        var productId ={!! json_encode($product_id) !!};
        var products = {!! json_encode($products) !!};
        var categoriesData = {!! json_encode($categories) !!};
        // Create products elements
        createProductsGrid(products,categoriesData.id);

        function getProducts(categoryId,search1,page,filterId,paramId) {
            $.ajax({
                type: 'POST',
                url: '/product/search',
                data: {
                    "_token": "{{ csrf_token() }}",
                    
                    page: page,
                    categoryId: categoryId,
                    filterId: filterId,
                    paramId: paramId,
                    productId: productId,
                
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
        
        function createProductsGrid(values,categoryId) {
            //create products
            var $ul = $('.mt-productlisthold ');
            $.each(values.data, function(index, value) {
                // Check if product.photo exists
                if (value.photo) {
                    var $li = $(`
                    <div class="list-inline-item col-lg-3 col-sm-6 m-0">
                        <div class="mt-product1 large">
                            <div class="box">
                                <div class="b1">
                                    <div class="b2">
                                        <div>
                                            <img src="${value.photo}" alt="image description loading="lazy" style="width:300px;height:250px">
                                        </div>
                                        <ul class="mt-stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <ul class="links">
                                            <li>
                                                <a href="/product-detail/${value.id}" target="_blank">
                                                    <div class="productImage add-button" data-id="${value.id}" data-photo ="${value.photo}" data-title ="${value.title}">
                                                       
                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                    View More
                                                    </div>
                                                </a>

                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="txt">
                                <strong class="title">${value.title}</strong>
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
            var filterId=null;
            var paramId=null;
            getProducts(category,search,page,filterId,paramId)
        });
        
        $(document).on('click', '.productImage', function() {
            var photo = $(this).data('photo');
            var title = $(this).data('title');
            var visualizerLink = '/editor-vue/'+$(this).data('id');
            
            $('.modal-img').attr('src', photo);
            $('.visualize-link').attr('data-link', visualizerLink);
            $('.modal-title').text(title);
            //$('#productDetailModal').modal('show');
        });
        $(document).on('click', '#uplaod-button', function() {
            var photo = $(this).data('photo');
            var title = $(this).data('title');
            var visualizerLink = '/editor-vue/'+$(this).data('id');
            
            $('.modal-img').attr('src', photo);
            $('.visualize-link').attr('data-link', visualizerLink);
            $('.modal-title').text(title);
            $('#uploadDesignModal').modal('show');
        });
        $(document).on('click', '.visualize-link', function() {
            var auth = $(this).data('auth');
            var link = $(this).data('link');
            if(auth==1){
                console.log(link);
                window.location.href = link;
            }else{
                $(".btn-close").click();
                $("body").toggleClass("side-col-active");
                $(".side-opener").toggleClass("active");
                $(".mt-side-over").toggleClass("active");
                return false;
                
            }
            
        });

        $(document).on('click', '.filterPara', function() {
            // Initialize an array to store selected filter IDs
            var filterIds=[];
            var paramId = [];
            
            // Iterate through all checkboxes with the class 'filterPara' that are checked
            $('.filterPara:checked').each(function() {
                paramId.push($(this).data('param-id'));
                filterIds.push($(this).data('filter-id'));
            });
            // Example values for other parameters
            
            var search1 = null;
            var page = null;
            
            // Call the getProducts function with the collected filter IDs
            getProducts(categoryId, search1, page, filterIds,paramId);
        });

        //observer for side bar so that it dont touch footer 
        var sidebar = $('#sidebar');
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    sidebar.css('position', 'absolute');
                } else {
                    sidebar.css('position', 'fixed');
                }
            });
        }, { threshold: [0] });
        observer.observe(document.getElementById('mt-footer'));
        // Observe end






    });

</script>
@endpush