@extends('frontend.layouts.master')



@section('main-content')

<section class="category-grid ">
    <div class="container-fluid">
         
         <div >
            <h3 style="background-image: url('{{ asset('/photos/1/Banners/euroserieslarge.jpeg') }}'); padding:6%;margin-bottom: 30px;height: 31vh;" class="text-center product-title d-none d-lg-block"></h3>
        </div>
        <div class="row">
           <div class="text-center col-12">
                <h3 style="background-image: url('{{ asset('/photos/1/Banners/euroseriessmall.jpeg') }}'); background-size: cover; background-position: center center; padding: 19%; height: auto; width: 100%;" class="product-title d-none d-flex d-lg-none"></h3> 
            </div>
            
            
            <!--small screen-->
            <div class="mb-3 d-lg-none col-12 pt-3">
                
                <div class="row">
                    <div class="col-8">
                        <input type="text" class="search-box" placeholder="Search">
                    </div>
                    <div class="col-2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="submit-button">Submit</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="filter small">
                            
                            <span><img src="{{ asset('/photos/1/Logos/filter.png') }}" style="height: 75%;"></span>
                       
                        </div>
                    </div>
                </div>
                

            </div>
            
            <div class="col-sm-3 side-bar collapsed-sidebar">
               <div class="row"> 
              <!-- large screen-->
                <div class="mb-3 d-flex col-12 search2">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="search-box" placeholder="Search">
                            </div>
                            <div class="col-2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="submit-button">Submit</button>
                                </div>
                            </div>
                            
                        </div>
                </div>
                
                        
                       <div class="col-11">
                        <span id="menu-button"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#e5e7eb" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></span> 
                        <ul class="sidebar-nav sidebar-nav-col nav-pills nav-stacked" id="menu">
                            
                            @foreach($categories as $parentCategory)
                            <li>
                                <div class="row parent" data-parent-id="{{$parentCategory->id}}" data-title="{{$parentCategory->title}}" >
                                        <div class="col-10 " >
                                            <!-- Text on the left -->
                                            <span class="pl-4">{{ $parentCategory->title }}</span>
                                        </div>
                                        <div class="parent col-2 d-flex justify-content-end align-items-center" data-parent-id="{{$parentCategory->id}}" data-title="{{$parentCategory->title}}">
                                            <!-- Sign (plus symbol) on the right -->
                                            
                                        </div>
                                    </div>
                                <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                                    @foreach($parentCategory->child_cat as $childCategory)
                                    <li class="category" data-id="{{ $childCategory->id }}" data-title="{{ $childCategory->title }}" data-parent-title="{{$parentCategory->title}}" data-parent-id="{{$parentCategory->id}}" > 
                                        <span data-child-id="{{ $childCategory->id }}" data-parent-id="{{$parentCategory->id}}" data-title="{{$parentCategory->title}}" class="pl-5 child">{{ $childCategory->title }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                     
               </div> 
            </div> 
                <div class="col-sm-12 col-lg-9" id="grid-container">
                    
                    
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <span class="breadcrumb-item" id="products"><a >Products</a></span>
                    </nav>
                    <div class="filter large">
                        
                        <span><img src="{{ asset('/photos/1/Logos/filter.png') }}"></span>
                        Filter
                    </div>
                   <div class="selection-container d-none row p-2 ml-2">
                        @foreach($categories as $parentCategory)
                        
                            <label class="selection-label">
                                <input type="checkbox" class="selection-boxes" data-is-parent="{{$parentCategory->is_parent}}" data-title="{{$parentCategory->title}}" data-id="{{$parentCategory->id}}">
                                <span style="white-space: nowrap;">{{$parentCategory->title}}</span>
                            </label>     
                     
                        @endforeach
                        
                    </div>
                    
                    <div class="selection-container d-none row p-2 ml-2">
                         @foreach($categories as $parentCategory)
                            @if($parentCategory->has_child_categories)
                            <div class="selection-sub-menu" id="{{$parentCategory->id}}" id="{{$parentCategory->title}}" style="display:none;">
                                @foreach($parentCategory->child_cat as $childCategory)
                                    
                                        <label class="selection-label">
                                            <input type="checkbox" class="sub-menu-boxes" data-title="{{$childCategory->title}}" data-parent-title="{{$parentCategory->title}}" data-id="{{ $childCategory->id }}">
                                            <span style="white-space: nowrap;">{{ $childCategory->title }}</span>
                                        </label>
        
                                @endforeach
                            </div>
                            @endif
                        @endforeach
                        

                    </div>


                    <div class="image-container row">
                         
                    </div>
                    <div id="spinner-container" class="container" style="display: none;">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <!--<div class="col-12 d-flex justify-content-between align-items-center" style="padding-right: 4%;">
                        <a class="page-link previous-button" href="#" tabindex="-1">Previous</a>
                        <a class="page-link next-button" href="#">Next</a>
                    </div>-->
                </div>

        </div>
    </div>
</section>

<div class='container'>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> 
                <div class="modal-body p-0">
                   
                    <div class="row">
                        <div id="modal-img" class="col-lg-6">
                            <img src="https://i.imgur.com/UCqKKB4.jpg" class="img-fluid" loading="lazy" alt="Image" style="width:100%; height:100%;" />
                        </div>
                        <div class="col-lg-6  col-sm-12 p-3" style="color: black;">
                            <div>
                                <div class="text-center">
                                   
                                </div>
                               
                               
                                
                                <div class="col-12 contact-form W-100 ">
              
                                    
                                    <form id="contactForm" method="POST" action="{{ route('queryForm') }}">
                                        @csrf
                                          <h2 class="contact-title">Get A Query</h2>
                                          <div class="row">
                                              <div class="col">
                                                    <div class="form-group row">
                                                        <span class="col-3 ml-2 text-center">
                                                            <h5  style="font-family: inherit;font-size:large;font-weight: 700;">Product:</h5>
                                                            </span> 
                                                        <span class="col-8">
                                                            <h5  id="model-sub-cat-title" style="font-family: inherit;font-size:large;font-weight: 700;"></h5>
                                                        </span>
                                                    </div>
                                                </div>
                                          </div>
                                        
                                            
                                             <div class="col">
                                                <div class="form-group">
                                                        <input type="text" class="form-control shadow-sm" placeholder="Full Name" id="name" name="name" maxlength="255">
                                                        <div class="invalid-feedback" id="nameError"></div> <!-- Error message container for name -->
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control shadow-sm" placeholder="Email" id="email" name="email" maxlength="255">
                                                        <div class="invalid-feedback" id="emailError"></div> <!-- Error message container for email -->
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control shadow-sm" placeholder="Company/ Shop Name" id="company" name="company" maxlength="255">
                                                        <div class="invalid-feedback" id="companyError"></div> <!-- Error message container for company -->
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control shadow-sm" placeholder="Phone No " id="mobile" name="mobile" maxlength="20">
                                                        <div class="invalid-feedback" id="mobileError"></div> <!-- Error message container for mobile -->
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <textarea class="form-control shadow-sm" id="message" placeholder="Message" name="message" maxlength="1000"></textarea>
                                                    <div class="invalid-feedback" id="messageError"></div> <!-- Error message container for message -->
                                                </div>
                                                                        
                                                    
                                        <div id="successMessage" class="alert alert-success" style="display: none;">
                                            Email successfully sent.
                                        </div>
                                        <div class="">
                                            <button id="send_button" type="submit" class="">Submit</button>
                                        </div>
                                       
                                      
                                    </form>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
// Function to create category elements
    function createCategoryElement() {
    var imageContainer = document.querySelector('.image-container');

    // Get categories data sent from controller
    var categoriesData = {!! json_encode($categories) !!};

    // Loop through categories data and create elements
    categoriesData.forEach(function(category) {
        // Create <a> element
        var a = document.createElement('a');
        a.classList.add('image-grid-item', 'sub-cat');

        // Create <img> element
        var img = document.createElement('img');
        img.classList.add('img-thumbnail', 'img-fluid', 'mb-3', 'rounded-0');
        img.src = category.photo;
        img.setAttribute('data-photo', category.photo);
        img.setAttribute('loading', 'lazy');
        img.setAttribute('alt', '');
        img.setAttribute('data-title', category.title);
        img.setAttribute('data-id', category.id);
        a.appendChild(img);

        // Create nested <div> elements
        var div1 = document.createElement('div');
        div1.setAttribute('bis_skin_checked', '1');

        var div2 = document.createElement('div');
        div2.classList.add('grid-sub-cat-title');
        div2.setAttribute('bis_skin_checked', '1');
        div2.textContent = category.title;

        div1.appendChild(div2);
        a.appendChild(div1);

        // Create and append the img-description div
        var imgDescriptionDiv = document.createElement('div');
        
        imgDescriptionDiv.setAttribute('data-category-id', category.id);
        imgDescriptionDiv.setAttribute('data-title', category.title);
        imgDescriptionDiv.classList.add('img-description','row');

      

        // Create span for category title
        var categoryTitleSpan = document.createElement('span');
        categoryTitleSpan.classList.add('title','col-12');
        categoryTitleSpan.textContent = category.title;
        imgDescriptionDiv.appendChild(categoryTitleSpan);

        // Create span for category description
        var categoryDescriptionSpan = document.createElement('span');
        categoryDescriptionSpan.textContent = category.summary;
        categoryDescriptionSpan.classList.add('summary','col-12');
        imgDescriptionDiv.appendChild(categoryDescriptionSpan);
            
          // Create button
        var button = document.createElement('button');
        button.textContent = 'Products >>';
        button.classList.add('product-button');
        button.setAttribute('data-button', 'button');
        imgDescriptionDiv.appendChild(button);
        
        imageContainer.appendChild(a);
        imageContainer.appendChild(imgDescriptionDiv);
    });
}



$(document).ready(function() {
    
    $('#contactForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission
        
        // Validate each field
        var name = $('#name').val();
        var email = $('#email').val();
        var company = $('#company').val();
        var mobile = $('#mobile').val();
        var message = $('#message').val();
        
        var isValid = true; // Flag to track overall form validity
        
        // Validate name length
        if (name.trim() === '' || name.length > 50) {
            isValid = false;
            $('#name').addClass('is-invalid');
            $('#nameError').text("Please enter a name (up to 50 characters)");
        } else {
            $('#name').removeClass('is-invalid');
            $('#nameError').text("");
        }
        
        // Validate email
        if (email.trim() === '' || !isValidEmail(email)) {
            isValid = false;
            $('#email').addClass('is-invalid');
            $('#emailError').text("Please enter a valid email address");
        } else {
            $('#email').removeClass('is-invalid');
            $('#emailError').text("");
        }
        
        // Validate company
        if (company.trim() === '') {
            isValid = false;
            $('#company').addClass('is-invalid');
            $('#companyError').text("Please enter a company name");
        } else {
            $('#company').removeClass('is-invalid');
            $('#companyError').text("");
        }
        
        // Validate mobile number length and type
        if (mobile.trim() === '' || !isValidMobile(mobile)) {
            isValid = false;
            $('#mobile').addClass('is-invalid');
            $('#mobileError').text("Please enter a valid mobile number");
        } else {
            $('#mobile').removeClass('is-invalid');
            $('#mobileError').text("");
        }
        
        // Validate message
        if (message.trim() === '') {
            isValid = false;
            $('#message').addClass('is-invalid');
            $('#messageError').text("Please enter a message");
        } else {
            $('#message').removeClass('is-invalid');
            $('#messageError').text("");
        }
        
        if (!isValid) {
            // If any field is invalid, don't submit the form
            return;
        }
        
        // If all fields are valid, serialize form data and send AJAX request
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                // Handle success response
                console.log(response);
                $('#successMessage').fadeIn(); // Show success message
                setTimeout(function(){
                    $('#successMessage').fadeOut(); // Hide success message after 5 seconds
                }, 5000);
                
                // Clear all input fields
                $('#contactForm')[0].reset();
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                // You can show an error message to the user
            }
        });
    });

    // Function to validate email format
    function isValidEmail(email) {
        // Regular expression for email validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    
    // Function to validate mobile number length and type
    function isValidMobile(mobile) {
        // Regular expression for mobile number validation (up to 12 digits)
        var mobilePattern = /^\d{1,12}$/;
        return mobilePattern.test(mobile);
    }


    


    // Toggle sidebar collapse
    $('#menu-button').click(function(){
            $('.side-bar').toggleClass('collapsed-sidebar');
            $('.sidebar-nav').toggleClass('sidebar-nav-col');
            $('.input-group').toggleClass('input-group-col');
        });
    
    
    $(document).on('click', '.products-img', function(event) {
        event.preventDefault();
    
        var id = $(this).data('id');
        var subCategory = $(this).data('sub-category');
        var sno = $(this).data('sno'); 
        var imageUrl = $(this).data('photo');
    
        // Update modal content with the fetched data
        $('#modal-img img').attr('src', imageUrl);
        $('#model-sub-cat-title').text(subCategory +' '+sno);
        $('#product-no').text(sno);
    
        // Set the href attribute for the #product-url element
        $('#product-url').attr('href', 'images/' + id);
    
        // Show the modal
        $('#exampleModal').modal('show');
    });

    // Activate carousel
    const slider = document.querySelector(".slider");
    
    function activate(e) {
      const items = document.querySelectorAll(".item");
      e.target.matches(".next") && slider.append(items[0]);
      e.target.matches(".prev") && slider.prepend(items[items.length - 1]);
    }

   document.addEventListener("click", activate, false);
    // Initialize menu
   initMenu();
   // Create category elements
   createCategoryElement();
   
   // Variable declarations
   var child_id = null;
   var parentId = null;
   var cat_id=null;
   var page=1;
   var totalPages=1;
   var search = null;
   var tempParent=null;
   var tempChild=null;

       
    // Function to show spinner
    function showSpinner() {
        $('#spinner-container').show();
    }

    // Function to hide spinner
    function hideSpinner() {
        $('#spinner-container').hide();
    }

    // AJAX function to fetch products
    function fetchProducts(search) {
         $('.image-container').empty();
        showSpinner(); // Show spinner before AJAX call
        var allPhotos = [];
        var ids = [];
        var cat_ids = [];
        var allPhotoThumb = [];
        var category = [];
        var subCategory = [];
        var sno = [];
        
        tempParent=parentId;
        
        
        tempChild=child_id;
        $.ajax({
            url: '/product/search',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                search: search,
                child_id:child_id,
                parentId:parentId,
                page: page,
              
            },
            success: function(data) {
                hideSpinner(); // Hide spinner after AJAX call
                totalPages = data.totalPages;
                search = null;
                var productgrid = data.productgrid;
                
                $('.image-container').empty();
                data.products.data.forEach(function(product) {
                    if (product.photo) {
                        allPhotos.push(product.photo);
                        ids.push(product.id);
                        cat_ids.push(product.child_cat_id);
                        allPhotoThumb.push(product.photo);
                        
                        var words = product.title.split(' ');
                        category.push(words[0] + ' ' + words[1]);
                        var subCat = words.slice(2, -1).join(' ');
                        subCategory.push(subCat);
                        sno.push(words[words.length - 1]);
                    }
                });
                // Create and append <a> elements with images and titles
               for (var i = 0; i < allPhotos.length; i++) {
                   
                    var imgClass = '';
                    if (tempParent === null) {
                             var a = $('<a>').addClass('image-grid-item');
                            imgClass = 'products-img';
                        
                        
                    } else {
                            if(productgrid!=null){
                                 var a = $('<a>').addClass('image-grid-item');
                                imgClass = 'products-img';    
                            }else{
                                 var a = $('<a>').addClass('image-grid-item sub-cat-grid');
                                imgClass = 'img-sub-cat-thumbnail';
                            }
                            
                            
                    }
                    
                    var img = $('<img>').addClass(imgClass + ' img-fluid mb-3  rounded-0')
                        .attr('src', "{{ asset('') }}" + allPhotoThumb[i]) // Concatenate asset function with the image URL
                        .attr('data-photo', allPhotos[i])
                        .attr('loading', 'lazy')
                        .attr('alt', '')
                        .attr('data-category', category[i])
                        .attr('data-sub-category', subCategory[i])
                        .attr('data-id', ids[i])
                        .attr('data-child_id', cat_ids[i])
                        .attr('data-sno', sno[i]);
                    
                    a.append(img);
                
                    // Append the sub-category and sno together
                    var textDiv = $('<div>');
                    var subCategoryDiv = $('<div>').addClass('grid-sub-cat-title').text(subCategory[i] + ' ' + sno[i]); // Concatenating subCategory[i] and sno[i]
                    textDiv.append(subCategoryDiv).append('<br>');
                    a.append(textDiv);
                    $('.image-container').append(a);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching products:', error); // Handle error if any
                hideSpinner(); // Hide spinner in case of error
            }
            
        });
    }
   

    function initMenu() {
    $('#menu ul').hide(); // Hide all submenus initially

    $(document).on('click', '#menu li, .span.sign', function(e) {
        
        
        var submenu = $(this).find('ul');
        var sign = $(this).find('.sign');
        
       
            submenu.slideToggle('normal', function() {
                if (submenu.length) {
                    sign.text(submenu.is(':visible') ? '-' : '+');
                }
            });
            return false; // Prevent default anchor behavior
    
    });

    // Add sign to parent .row.parent if it contains a <ul>
    $('.parent').each(function() {
        var ul = $(this).next('ul');
        var liCount = ul.find('li').length;
        if (liCount >= 1) {
            $(this).find('.col-2').append('<span class="sign">+</span>');
        }
    });
}
    
    // Event listener for search box change
   $('.search-box').change(function() {
        child_id = null;
     
        var search = $(this).val(); // Capture the input value
        fetchProducts(search);
    });
    
    // Event listener for checkbox change
    $('.category').click(function() {
        $('.breadcrumb li').remove();
        $('.breadcrumb-item.active').removeClass('active');
        
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item sub-cat-bread')
                                  .text($(this).data('parent-title'))
                                  .data('parent-id', $(this).data('parent-id'));
        $('.breadcrumb').append(newBreadcrumbItem);
        
         newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text( $(this).data('title'));
        $('.breadcrumb').append(newBreadcrumbItem);
        
        $('.side-bar').toggleClass('collapsed-sidebar');
        $('.sidebar-nav').toggleClass('sidebar-nav-col');
        $('.input-group').toggleClass('input-group-col');
        
        child_id = $(this).data('id');
        var search = $(this).data('');
        page = 1;
        fetchProducts(search);
        child_id = null;
    });
    // Event listener for image thumbnail click
    
     $('.image-container').on('click', '.img-thumbnail', function() {
       
        $('.breadcrumb li:last-child').remove();
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active sub-cat-bread')
                                  .text($(this).data('title'))
                                  .attr('data-id', $(this).data('id'));
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
        
        parentId=$(this).data('id');
        page = 1;
        fetchProducts();
        parentId=null;
         
     });
     
     // Event listener for sub-category image thumbnail click
    $(document).on('click', '.img-sub-cat-thumbnail', function() {
        
        
        title= $(this).data('sub-category')+" "+$(this).data('sno');
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text(title);
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
        
        
        child_id = $(this).data('child_id');
        page = 1;
        fetchProducts(search);
        child_id=null;
    });

    // Event listener for parent category click
     $('.parent').click(function() {
         
        $('.breadcrumb li').remove(); 
         parentId = $(this).data('parent-id');
         title = $(this).data('title');
       
         var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text(title);
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
        
        page=1;
        fetchProducts();
        parentId=null;
        
    });
    
    // Event listener for next button click
    $('.next-button').click(function() {
        if(totalPages>page){
            child_id=tempChild;
            page++;
            fetchProducts(search);
            child_id=null;
        }
    });
    // Event listener for products breadcrumb click
    $('.previous-button').click(function() {
        if(page>1){
            child_id=tempChild;
            page--;
            fetchProducts(search);
        }
        
    });


    // Event listener for products breadcrumb click
    $('#products').click(function(){
        $('.breadcrumb li').remove();
         $('.image-container').empty();
         $('.breadcrumb li:last-child').remove();
            createCategoryElement();
    }); 
   $(document).on('click', '.sub-cat-bread', function() {
        // Check if the clicked element has both classes "active" and "sub-cat-bread"
        if ($(this).hasClass('active') && $(this).hasClass('sub-cat-bread')) {
            return; // If it has both classes, do nothing
        }
        console.log("fdf");
        $('.breadcrumb li:last-child').remove();
        parentId = $(this).data('id');
        page = 1;
        fetchProducts();
        parentId = null;
    });
    
    // Event listener for filter button click
    $('.filter').click(function(){
        $('.selection-container').toggleClass('d-none');
    });
    
    // Event listener for selection boxes click
     $('.selection-boxes').click(function(){
         if ($(this).prop('checked')) {
            $('.sub-menu-boxes').not(this).prop('checked', false);
            $('.selection-boxes').not(this).prop('checked', false);
            var id = $(this).data('id');
            var title = $(this).data('title');
            
            $('.selection-sub-menu').each(function() {
                if ($(this).css('display') !== 'none') {
                    $(this).css('display', 'none');
                }
            });
            $('#' + id).toggle();
            
            
            $('.breadcrumb li').remove();
            var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text(title);
            $('.breadcrumb-item.active').removeClass('active');
            $('.breadcrumb').append(newBreadcrumbItem);
            page=1;
            fetchProducts(title);
            
         }
         else{
             $('.selection-sub-menu').each(function() {
                if ($(this).css('display') !== 'none') {
                    $(this).css('display', 'none');
                }
            });
         }
    });
    
    // Event listener for sub-menu boxes click
    $('.sub-menu-boxes').click(function(){
        $('.sub-menu-boxes').not(this).prop('checked', false);
        
         $('.breadcrumb li').remove();
        $('.breadcrumb-item.active').removeClass('active');
        
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item sub-cat-bread')
                                  .text($(this).data('parent-title'))
                                  .data('parent-id', $(this).data('parent-id'));
        $('.breadcrumb').append(newBreadcrumbItem);
        
         newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text( $(this).data('title'));
        $('.breadcrumb').append(newBreadcrumbItem);
        
        if ($(this).prop('checked')) {
        // Checkbox is checked
        var title = $(this).data('title');
        
        $('.breadcrumb li:last-child').remove();
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text(title);
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
        
        child_id = $(this).data('id');
        fetchProducts(title);
        child_id = null;
    } else {
        // Checkbox is unchecked
        // Add your code for handling the unchecked state here
    }
    });
    
    $(document).on('click', '.img-description', function() {
         var title = $(this).data('title');
         parentId = $(this).data('category-id');
        
         $('.breadcrumb li:last-child').remove();
        var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active').text(title);
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
       
        fetchProducts();
    });
    
    //on page load check the url and get the products 
    var pro_cat_id = {!! json_encode($cat_id) !!};
     var pro_title = {!! json_encode($title) !!};
        if (pro_cat_id !== '0') {
        
        $('.breadcrumb li').remove(); 
         var newBreadcrumbItem = $('<li>').addClass('breadcrumb-item active sub-cat-bread').text(pro_title);
        $('.breadcrumb-item.active').removeClass('active');
        $('.breadcrumb').append(newBreadcrumbItem);
            parentId = pro_cat_id;
            page=1;
            fetchProducts();
            parentId=null;
        }
        
        
        
        history.pushState(null, 'xyz', 'https://bestboard.com.pk/product-grids/0/0');
});

</script>
@endpush


@push('styles')
<style>
    .collapse {
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.5s ease, visibility 0s linear 0.5s; /* Delay visibility change */
}

.collapse.show {
  opacity: 1;
  visibility: visible;
  transition-delay: 0s; /* Remove delay for visibility */
}
    .page-link{
        color:black !important;
    }
    .filter.large{
        display:block;
    }
    
    .filter.small{
        display: none;
        color: black;
        padding: 11%;
        background-color: #FAFAFA;
        border: 1px solid #9f9b9b;
        border-radius: 7px;
        margin-top: 4px;
        height: 34px;
    
    }
    .child{
        cursor:pointer;
    }
    .parent{
        cursor:pointer;
    }
    .selected{
        text-decoration-line: underline;
        text-decoration-thickness: 2px;
        text-underline-offset: 7px;
        color: black !important;
    }
    .category-grid .modal,
    .category-grid .fade,
    .category-grid .show {
        background-color: lightpink;
        padding-left: 15px;
        padding-right: 15px;
        background-color: rgba(0, 0, 0, 0.8); /* Adjusted to use rgba for transparency */
    }

    h2{
    
    	font-weight: bold;
    	margin-bottom: 15px;
    	color: #000;
    }
    .modal-content {
    	border: none;
        background: transparent;
        padding: 0 19px;
    }
    .close {
        position: relative;
        top: 48px;
        left: 13px;
        z-index: 1;
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
        color: black;
    }
    .modal-header {
        border: none;
    }
    
    .modal-header .close {
        padding: 0rem 2rem !important;
        margin: -1rem -1rem -1rem auto;
    }
    
    .modal-body {
        border: none;
        background-color: white;
        padding-bottom: 5px
    }
    .close.focus,
    .close:focus {
        outline: 0;
        box-shadow: none !important;
    }
    .modal-dialog {
       max-width: 928px;;
    }
    
    .img-fluid {
        padding: 0%;
    }
      
    .image-boxes {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        overflow: hidden;
    }
    #photo-title{
        color:#373737 !important;
        padding-left: 4%;
    }
    .room-btn{
        background-color: black;
        color: white;
        padding: 6%;
        border-radius: 29px;
        border: none;
    }
    .mt-mb{
        margin-top:43px;
        margin-bottom:40px;
    }
    .title-text{
        color: #373737;
        font-weight: 600;
        padding: 2%;
        font-family: inherit;
    }
    
    .title-head{
        color: #373737;
        font-weight: 900;
        font-size: 50px;
        padding: 2%;
    }
    
    .title-para{
        color: #373737;
        font-size: large;
        padding: 2%;
    }
    
    .title-list{
        color:#373737;
        padding: 3%;
    }
    
    .img-fluid {
        max-width: 100%;
        height: auto;
        padding: 5%;
        padding-bottom:1%;
        border-radius:2px;
    }

    .application {
        color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .section-container-fluid {
        width: 100%;
        max-width: 95%;
        margin: 3% auto;
        margin-top:0px;
    }

    .box-image {
        display: flex;
        column-gap: 20px;
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        justify-content: start;
        align-items: center;
        padding:2%;
    }

    .box-image .img-items {
        flex-shrink: 0;
        width: auto;
        margin-left: 2%;
    }

    .box-image .img-items img {
        width: 154px;
        max-height: 149px;
        transition: transform 0.5s;
    }


    .section-row {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        max-width: 75%;
        margin-left: 14%;
    }

    .section-menu {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        background-color: rgb(204, 204, 204);
        border-radius: 10px;
    }

    .button-container-fluid {
        display: flex;
        justify-content: space-between;
    }

    .button {
        border: none;
        background: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        outline: none;
    }

    .logo-image {
        width: 50px;
        height: auto;
    }

    .image-container-fluid {
        position: relative;
        flex: 1;
    }

    .image-container-fluid img {
        max-width: 100%;
        height: auto;
    }

    .product-details {
        flex: 1;
        padding: 0 20px;
        margin-top: 0;
        color: rgb(139, 111, 78);
        text-transform: uppercase;
        max-width: calc(30% - 20px);
    }

    .product-details h2 {
        margin-top: 0;
    }

    .buy-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .nav-button {
        width: 100%;
        padding: 1%;
    }

    .image-boxes {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        overflow: hidden;
    }

    .product-details {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .image-box {
        max-width: 100%;
        text-align: center;
        padding:2%;
    }

    .centered-image {
        width: 100%;
        height: auto;
    }

    .image-box img {
        max-width: 100%;
        max-height: 100%;
    }

    .image-box p {
        margin-top: 5px;
        font-size: 14px;
    }

    .slider-nav {
        display: flex;
        margin-top: 10px;
        border-bottom: 1px solid rgb(136, 136, 136);
        text-transform: uppercase;
        flex-wrap: nowrap;
        overflow: auto;
    }

    .nav-item {
        padding: 2px 25px;
        color: #535458;
        cursor: pointer;
        margin: 13px;
        height: 22px;
        font-size: large;
        font-weight: bold;
        white-space: nowrap;
    }

    .contact-form{
    }
    .contact-title{
        padding: 2%;
        font-weight: 600;
        
    }
    .contact-no{}
    .contact-mail{}
    #send_button{
        background-color:#373737;
        color:  white;
        padding-left: 2%;
        border-radius: 22px;
        padding-right: 2%;
        width:100px;
    }
    .mt-mb {
            margin-top:120px;
            margin-bottom:40px;
        }
    
    form {
        padding: 4%;
        height: 100%;
        width: 100%;
        color: #373737;
    }
    textarea.form-control {
        height: 183px;
    }
    ::placeholder {
        color: #373737 !important; /* Change placeholder color as needed */
    }
        
    .form-control {
        display: block;
        width: 100%;
        font-size: 1rem;
        line-height: 1.5;
        color: #373737;
        background-color: inherit;
        background-clip: padding-box;
        border-bottom: 1px solid #8e97a1;
        border-radius: 0;
        border-top: none;
        border-left: none;
        border-top: none;
        border-right: none;
        padding-left: 4%;
        height:60px;
    }

    .title{
        font-size: larger;
        padding: 5%;
        font-weight: 600;
        height: min-content;
        /* text-decoration: underline 1px; */
        color: #141414;
    }
    .summary{
        padding: 0;
        margin-left: 8px;
        font-size: small;
        font-weight: 600;
        color: #908989;
        margin-top: -18px;
    }
    .product-button{
        width: 114px;
        height: 34px;
        border-radius: 21px;
        background-color: #353232;
        color: #fafafa;
    }
    .image-grid-item .grid-sub-cat-title {
        position: absolute ;
        bottom: 6px ;
        left: 0 ;
        width: 100% ;
        font-size: 75% ;
        font-weight: 800 ;
        background-color: rgba(0, 0, 0, .5);
        color: #fcf6f6 ;
        padding: 0.5rem ;
        box-sizing: border-box ;
        transition: bottom 0.3s ease ; 
    }
    .img-description{
        color:black;
        font-family:inherit;
        display:none;
    }
    .filter{
        color:black;
    }
    .filter.large{
        float: right; 
        width: 25px; 
        height: 22px; 
        margin-top: -57px;
        margin-right: 28px;
        color: black;
    }
    .breadcrumb{
        cursor:pointer;
    }
    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        color: #6c757d;
        content: ">";
        margin-left: 6px;
        margin-right: 6px;
        font-weight: 600;
    }
    .selection-container{
        display:flex;
    }
    .spinner-container{
        height:100vh;
    }
    .selection-sub-menu{
        background-color: rgb(250, 250, 250);
        padding: 2%;
        margin-bottom: 1px;
    }
     .selection-label {
        color: #353535;
        display: inline-flex; /* Use inline-flex to keep checkbox and label on the same line */
        align-items: center; /* Center items vertically */
        font-weight:600;
        margin-right: 14px;
    }

    .selection-boxes {
        margin-right: 5px; /* Add a small margin between checkbox and label */
    }
    
    .sub-menu-boxes {
        margin-right: 5px; /* Add a small margin between checkbox and label */
    }
        
    #menu-button{
       position: absolute;
        top:0px;
        right: -18px;
        background-color: #034694;
        border-radius: 50%;
        padding: 7px;
        display:none;
        
    }
     .input-group-col{
                display:none !important;
            }
    .side-bar {
        max-width: 400px;
        transition: max-width 0.5s ease; /* Transition effect */
    }
    
    
    .breadcrumb{
        background-color:#fafafa;
        color:black;
    }
    .modal-dialog {
       max-width: 928px;;
    }
    .product-title{
        color: #ffffff;
        font-family: inherit;
        font-weight: 700;
        font-size: xxx-large;
        text-transform: uppercase;
        padding-left: 3%;
    }


    .image-grid-item {
        position: relative;
        margin: 1rem;
        box-shadow: 0 20px 30px rgba(0, 0, 0, .1);
        text-align: center;
        height: 56vh;
        overflow: hidden;
        width: 22%;
    }
    #submit-button{
        background-color: #FAFAFA;
        color: black;
        border-radius: 10px;
        font: inherit;
        font-size: small;
        margin-top: 6px;
        /* width: 73px; */
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        margin-left: -11px;
      
    }
    
    #visualize-button{
        background-color: #FAFAFA;
        color: black;
        padding: 3%;
        height: 100%;
        width: 85px;
        font-family: inherit;
        border-radius: 10px;
        font: inherit;
        font-size: small;
        font-weight: 700;
    }
    .sign{
        cursor:pointer
    }
    .spinner-border{
        color:black;
    }
    .container {
        display: flex;
        justify-content: center;
        margin-top: 200px;
        background: transparent;
    }
    .trigger{
    	background-color: green;
        color: #fff;
    }
    .category-grid .modal,
    .category-grid .fade,
    .category-grid .show {
        background-color: lightpink;
        padding-left: 15px;
        padding-right: 15px;
        background-color: rgb(0, 0, 0, 0.8);
    }
    h2{
    
    	font-weight: bold;
    	margin-bottom: 15px;
    	color: #000;
    }
    .modal-content {
    	border: none;
        background: transparent;
        padding: 0 19px;
    }
    .close {
        position: relative;
        top: 48px;
        left: 13px;
        z-index: 1;
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
        color: black;
    }
    .modal-header {
        border: none;
    }
    
    .modal-header .close {
        padding: 0rem 2rem !important;
        margin: -1rem -1rem -1rem auto;
    }
    
    .modal-body {
        border: none;
        background-color: white;
        padding-bottom: 5px
    }
    .close.focus,
    .close:focus {
        outline: 0;
        box-shadow: none !important;
    }
    .filter-button{
        width: 85%;
        background: transparent;
        font-family: inherit;
        font-weight: 500;
        padding: 2%;
        border: 1px solid black;
        margin: 2%;
        border-radius: 5px;
        margin-left: 42px;
    }
    .search-box{
        width: 91%;
        background: transparent;
        font-family: inherit;
        font-weight: 500;
        padding: 4%;
        border: 1px solid black;
        margin-top: 3%;
        border-radius: 5px;
        margin-left: 26px;
        height: 32px;
    }
   
    .category-grid {
        margin-top: 58px;
        margin-bottom: -177px;
    }
    .side-bar ul { 
        color:black;
         list-style-type: none;
         padding:0;
        
    }
    .side-bar li { 
        background-color: #fafafa;
        padding: 4%;
        padding-left: 0px;
        border-radius: 2px;
        /* margin: 14px; */
        margin-left: 0px;
        font-family: inherit;
        font-weight: 700;
    }
    

    .image-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Maintain aspect ratio and cover the container */
        border-radius: 0.25rem;
        transition: transform 1s ease;
        /* Transition for zoom effect */
        object-fit: fill;
    }


    .image-grid-item .grid-cat-title {
        position: absolute;
        bottom: 108px;
        left: 0;
        width: 100%;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 0.5rem;
        box-sizing: border-box;
        transition: bottom 0.3s ease;
    }

 
    .image-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Maintain aspect ratio and cover the container */
        border-radius: 0.25rem;
        transition: transform 1s ease;
        /* Transition for zoom effect */
        object-fit: fill;
    }
       
    
    .image-grid-item .product-sno {
        position: absolute;
        bottom: 12px;
        left: 0;
        width: 100%;
        font-size: 20px;
        font-weight: 900;
        /* background-color: rgba(0, 0, 0, 0.5); */
        color: white;
        padding: 0.5rem;
        box-sizing: border-box;
        transition: bottom 0.3s ease;
    }

    
    .image-container {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: left;
        padding: 2% 0%;
    }

    .image-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Maintain aspect ratio and cover the container */
        border-radius: 0.25rem;
        transition: transform 1s ease;
        /* Transition for zoom effect */
        object-fit: fill;
    }
  
    .breadcrumb-item+.breadcrumb-item {
        padding-left: 0rem;
    }
    .image-grid-item.sub-cat-grid{
        height: auto;
        width: 22%;
    }
    .image-grid-item.sub-cat{
        height: 25vh;
        width: 17%;
    }

        @media (max-width:599px)
        {   
             .image-grid-item.sub-cat-grid{
                height: auto !important;
                
        
            }
            .filter.large{
                display: none;
            }
            
            .filter.small{
                display:flex;
            }
            .img-description{
                display: flex;
                width: 42%;
                padding: 3%;
                margin-top: 6px;
            }
            
            .image-grid-item.sub-cat{
                width:57%;
                height:20vh;
            }
            
            #menu-button{
               position: absolute;
                top: 0px;
                right: -18px;
                background-color: #034694;
                border-radius: 50%;
                padding: 7px;
                display: block;
                 
            }
            .collapsed-sidebar {
                max-width: 0;/* Collapse sidebar */
                transition: max-width 1s ease;
            }
            .sidebar-nav-col{
                display:none;
            }
            .search2{
                display:none !important;
            }
           
            .input-group-col{
                display:flex !important;
            }
            .side-bar {
                position: fixed;
                top: 276px;
                left: -14px;
                z-index: 1030;
                height: 100%;
                overflow-y: auto;
                overflow: visible;
            }
            /*.sidebar-nav{
                display:none;
            }*/
            .product-title {
                font-size: x-large;
            }
            #modal-img{
                height:63vh;
                
            }
              .image-grid-item {
                position: relative;
                margin: 1rem;
                box-shadow: 0 20px 30px rgba(0, 0, 0, .1);
                text-align: center;
                height: 40vh;
                overflow: hidden;
                width: 40%;
            }
            .modal-dialog {
                max-width: 65rem;
            }
        
            .details {
                padding: 60px 0 40px 50px;
            }
        
            .text-muted a{
            	color: #c0bfbf;
            	font-weight: bold;
            	text-decoration: underline;
            }
            small.para{
            	font-weight: bold;
            	font-size: 14px;
            	color: #63686c;
            }
        
            }
     
        @media (min-width: 577px) and (max-width: 988px)
            {    
                .image-grid-item.sub-cat-grid{
                    height: auto !important;
            
                }
                .filter.large{
                        display: none;
                    }
                    
                    .filter.small{
                        display:none;
                    }
                .img-description{
                    display: flex;
                    width: 42%;
                    padding: 3%;
                    margin-top: 6px;
                }
                .image-grid-item.sub-cat{
                    width:57%;
                    height:20vh;
                }
               
                .search2{
                    display:none !important;
                }
                #menu-button{
                   position: absolute;
                    top: 0px;
                    right: -18px;
                    background-color: #034694;
                    border-radius: 50%;
                    padding: 7px;
                    display: block;
                     
                }
                 .collapsed-sidebar {
                    max-width: 0;/* Collapse sidebar */
                    transition: max-width 1s ease;
                }
                .sidebar-nav-col{
                    display:none;
                }
               
                .input-group-col{
                    display:flex !important;
                }
                 .side-bar {
                    position: fixed;
                    top: 276px;
                    left: -14px;
                    z-index: 1030;
                    height: 100%;
                    overflow-y: auto;
                    overflow: visible;
                }
                
                .product-title {
                    font-size: x-large;
                }
                .image-grid-item {
                position: relative;
                margin: 1rem;
                box-shadow: 0 20px 30px rgba(0, 0, 0, .1);
                text-align: center;
                height: 40vh;
                overflow: hidden;
                width: 40%; 
                /*flex-basis: calc(50% - 2rem);*/
                }
                .modal-dialog {
                    max-width: 65rem;
                }
            
                .details {
                    padding: 60px 0 40px 50px;
                }
        
                .text-muted a{
                	color: #c0bfbf;
                	font-weight: bold;
                	text-decoration: underline;
                }
                small.para{
                	font-weight: bold;
                	font-size: 14px;
                	color: #63686c;
                }
            }
            
        @media (max-width: 576px) 
            {
                .image-grid-item.sub-cat-grid{
                    height: auto !important;
            
                }
                .filter.large{
                        display: none;
                    }
                    
                    .filter.small{
                        display:flex;
                    }
                .img-description{
                    display: flex;
                    width: 42%;
                    padding: 3%;
                    margin-top: 6px;
                }
                .image-grid-item.sub-cat{
                    width:57%;
                    height:20vh;
                }
               
                .search2{
                    display:none !important;
                }
                #menu-button{
                   position: absolute;
                    top: 0px;
                    right: -18px;
                    background-color: #034694;
                    border-radius: 50%;
                    padding: 7px;
                    display: block;
                     
                }
                 .collapsed-sidebar {
                    max-width: 0;/* Collapse sidebar */
                    transition: max-width 1s ease;
                }
                .sidebar-nav-col{
                    display:none;
                }
               
                .input-group-col{
                    display:flex !important;
                }
                 .side-bar {
                    position: fixed;
                    top: 276px;
                    left: -14px;
                    z-index: 1030;
                    height: 100%;
                    overflow-y: auto;
                    overflow: visible;
                }
                
                .product-title {
                    font-size: x-large;
                }
                .image-grid-item {
                position: relative;
                margin: 1rem;
                box-shadow: 0 20px 30px rgba(0, 0, 0, .1);
                text-align: center;
                height: 40vh;
                overflow: hidden;
                width: 40% !important; 
                /*flex-basis: calc(50% - 2rem);*/
                }
                .modal-dialog {
                    max-width: 65rem;
                }
            
                .details {
                    padding: 60px 0 40px 50px;
                }
        
                .text-muted a{
                	color: #c0bfbf;
                	font-weight: bold;
                	text-decoration: underline;
                }
                small.para{
                	font-weight: bold;
                	font-size: 14px;
                	color: #63686c;
                }
                
            }
   
    
</style>
@endpush
