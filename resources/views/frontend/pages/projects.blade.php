@extends('frontend.layouts.master')

@section('title', 'Vizu || MY PROJECTS')
@section('main-content')
<div class="container projects style1 wow fadeInUp"
    style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
    <div class="row mt-5">
        <div class="col-12">
            <header>
                <h1 class="mb-4 fs-2 fw-bold" data-testid="app-title">My Projects</h1>
            </header>
            <div class="row mb-5">
                <div class="col-12 d-flex justify-content-end">
                    <h2 class="fs-5 fw-bold mb-4">{{ $userTemplates->total() }} projects</h2>
                </div>
                <div class="d-flex my-3 align-items-center justify-content-between">
                    <div class="mb-0">
                        <div>
                            <div class="search-input">
                                <input type="search" value="" required="" aria-required="true" aria-autocomplete="list" placeholder="Search" autocomplete="off"class="swan-polyfill-empty site-header-search swan-input product-search">
                               
                                <button type="submit" aria-label="Search"
                                    class="search-input-submit swan-button swan-button-skin-secondary">
                                    <img src="https://swan.prod.merch.vpsvc.com/v2/icons/search.3594f845fd4e26d76fd4cf3b291a9e7e.svg"
                                        alt=""
                                        class="search-submit-icon swan-icon swan-icon-skin-standard swan-icon-type-search"
                                        style="width: 58%;">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        {{-- <nav class="d-flex align-items-center" aria-label="Pagination" role="navigation">
                            <button>
                                <img src="" alt="" style="">
                            </button>
                            <a class="btn btn-secondary" aria-label="Go to page 1" aria-current="false">1</a>
                            <div class="px-2">of 4</div>
                            <button aria-label="Next Page">
                                <img alt="">
                            </button>
                        </nav> --}}

                        <select class="form-select ms-3" id="items-per-page">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                        </select>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="container card-container">
                            @foreach ($userTemplates as $template )
                            <div class="my-{{$template->id }}">
                                <div class="card border p-4">
                                    <div class="row g-0">
                                        <div class="col-md-3 d-flex align-items-center">
                                            <div class="p-2">
                                                <div class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset($template->product->photo) }}"
                                                                class="d-block w-100" alt="Front">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img src="{{ asset($template->product->photo) }}"
                                                                class="d-block w-100" alt="Back">
                                                        </div>
                                                    </div>
                                                    <button class="carousel-control-prev swan-carousel" type="button"
                                                        data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next swan-carousel" type="button"
                                                        data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 d-flex flex-column">
                                            <div class="ms-3">
                                                <div class="mb-4 mt-2">
                                                    <h4 class="font-weight-bold">{{ $template->title }}</h4>
                                                    <p class="text-muted">Product Name: {{ $template->product->title }}
                                                    </p>
                                                    <p class="text-muted">Size: {{ $template->product->size }}</p>
                                                    <p class="text-muted">Created on: {{ $template->product->created_at
                                                        }} </p>
                                                    <p class="text-muted">Last edited on: {{
                                                        $template->product->updated_at }}</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <button type="button" class="btn btn-primary">Add to basket</button>
                                                    <div class="ms-4">
                                                        <span class="text-muted">1 starting at </span>
                                                        <span class="text-decoration-line-through">Rs {{
                                                            $template->product->price-10 }}</span>
                                                        <span class="text-success">Rs {{ $template->product->price
                                                            }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex flex-column p-4 ">
                                            <div class="d-flex align-item-center p-1">
                                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="14.8284" y="3.34473" width="4" height="12"
                                                        transform="rotate(45 14.8284 3.34473)" fill="black"></rect>
                                                    <path
                                                        d="M5.63623 12.5352L8.46466 15.3636L4.92912 16.0707L5.63623 12.5352Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M16.2425 1.92984C17.0236 1.14879 18.2899 1.14879 19.071 1.92984C19.852 2.71089 19.852 3.97722 19.071 4.75827L18.3638 5.46537L15.5354 2.63695L16.2425 1.92984Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M14.3267 18.0789C14.3267 18.7952 13.7436 19.3415 13.0481 19.3415H2.93378C2.21919 19.3415 1.65516 18.7761 1.65516 18.0789V7.902C1.65516 7.20485 2.23829 6.63946 2.93378 6.63946H7.10404L8.73958 5H2.93382C1.31663 5 0.000488281 6.30008 0.000488281 7.90193V18.0788C0.000488281 19.6999 1.31656 21 2.93382 21H13.0672C14.6843 21 16.0005 19.6999 16.0005 18.0788V12.2375L14.365 13.877L14.3642 18.0789L14.3267 18.0789Z"
                                                        fill="black"></path>
                                                </svg>
                                                <a href="/editor-vue/{{$template->product->id }}"
                                                    class="btn btn-link">Edit</a>
                                            </div>
                                            <div class="d-flex align-item-center p-1">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="11" height="11" rx="1" fill="black"
                                                        stroke="black" stroke-width="1.5"></rect>
                                                    <path
                                                        d="M7 15V17C7 17.5523 7.44771 18 8 18H17C17.5523 18 18 17.5523 18 17V8C18 7.44772 17.5523 7 17 7H15"
                                                        stroke="black" stroke-width="1.5"></path>
                                                </svg>
                                                <button class="btn btn-link copy-button"
                                                    data-product-id="{{$template->product->id }}">Copy</button>
                                            </div>
                                            <div class="d-flex align-item-center p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20"
                                                    height="20">
                                                    <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                </svg>
                                                <button class="btn btn-link delete-button"
                                                    data-product-id="{{$template->product->id }}"
                                                    data-template-id="{{$template->id }}">Delete</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
@push('styles')
<style>
    .search-sub {
        height: auto;
        width: 20px;
        position: relative;
        right: 30px;
    }

    .projects h1 {
        font-size: 22px;
        */ line-height: 24px;
        color: #000;
        font-family: "Montserrat", sans-serif;
        margin: 0 0 32px;
    }

    .projects h2 {
        display: block;
        color: #847e7e;
        margin: 0 4px 0 0;
        padding: 12px 20px;
        border-radius: 20px;
        /* border: 1px solid #9a9393; */
        text-transform: capitalize;
        font: 55px / 1 "Source Sans Pro", sans-serif;
    }

    .projects-container {

        background-clip: padding-box;
        color: rgba(0, 0, 0, .9);
        background: #fff;
        border-color: #707070;
        border-style: solid;
        border-width: 1px;
        border-radius: 8px;
        transition: border-color .2s;
        padding: 0 12px;
        align-items: center;
        gap: 8px;

    }

    .swan-carousel {
        position: absolute;
        top: 50%;
        z-index: 1;
        display: block;
        height: 40px;
        width: 40px;
        margin: 0px;
        padding: 0px;
        font-size: 0;
        line-height: 0;
        text-align: center;
        background: rgba(255, 255, 255, 0.7);
        border-width: 1px;
        border-style: solid;
        border-color: #dfdfdf;
        border-radius: 9999px;
        box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.1);
        outline: 0;
        transform: translateY(calc(-50% + 0px - 2px));
        transition: .2s ease all;
        cursor: pointer;

    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(46%);
        width: 18px;
        height: 19px;

    }

    .flex-column p {
        margin-top: 0;
        margin-bottom: 0rem;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
       
        function createGrid(template,product){
                console.log(template, product);
                var $container = $('.card-container');
                var newProject = `
                    <div class="my-${template.id}">
                        <div class="card border p-4">
                            <div class="row g-0">
                                <div class="col-md-3 d-flex align-items-center">
                                    <div class="p-2">
                                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="${product.photo}" class="d-block w-100" alt="Front">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="${product.photo}" class="d-block w-100" alt="Back">
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev swan-carousel" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next swan-carousel" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-column">
                                    <div class="ms-3">
                                        <div class="mb-4 mt-2">
                                            <h4 class="font-weight-bold">${template.title}</h4>
                                            <p class="text-muted">Product Name: ${product.title}</p>
                                            <p class="text-muted">Size: ${product.size}</p>
                                            <p class="text-muted">Created on: ${product.created_at}</p>
                                            <p class="text-muted">Last edited on: ${product.updated_at}</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-primary">Add to basket</button>
                                            <div class="ms-4">
                                                <span class="text-muted">1 starting at </span>
                                                <span class="text-decoration-line-through">Rs ${product.price - 10}</span>
                                                <span class="text-success">Rs ${product.price}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex flex-column justify-content-around p-4">
                                    <div class="d-flex align-item-center">
                                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="14.8284" y="3.34473" width="4" height="12" transform="rotate(45 14.8284 3.34473)" fill="black"></rect>
                                            <path d="M5.63623 12.5352L8.46466 15.3636L4.92912 16.0707L5.63623 12.5352Z" fill="black"></path>
                                            <path d="M16.2425 1.92984C17.0236 1.14879 18.2899 1.14879 19.071 1.92984C19.852 2.71089 19.852 3.97722 19.071 4.75827L18.3638 5.46537L15.5354 2.63695L16.2425 1.92984Z" fill="black"></path>
                                            <path d="M14.3267 18.0789C14.3267 18.7952 13.7436 19.3415 13.0481 19.3415H2.93378C2.21919 19.3415 1.65516 18.7761 1.65516 18.0789V7.902C1.65516 7.20485 2.23829 6.63946 2.93378 6.63946H7.10404L8.73958 5H2.93382C1.31663 5 0.000488281 6.30008 0.000488281 7.90193V18.0788C0.000488281 19.6999 1.31656 21 2.93382 21H13.0672C14.6843 21 16.0005 19.6999 16.0005 18.0788V12.2375L14.365 13.877L14.3642 18.0789L14.3267 18.0789Z" fill="black"></path>
                                        </svg>
                                        <a href="/editor-vue/${product.id}" class="btn btn-link">Edit</a>
                                    </div>
                                    <div class="d-flex align-item-center">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="11" height="11" rx="1" fill="black" stroke="black" stroke-width="1.5"></rect>
                                            <path d="M7 15V17C7 17.5523 7.44771 18 8 18H17C17.5523 18 18 17.5523 18 17V8C18 7.44772 17.5523 7 17 7H15" stroke="black" stroke-width="1.5"></path>
                                        </svg>
                                        <button class="btn btn-link copy-button" data-product-id="${product.id}">Copy</button>
                                    </div>
                                    <div class="d-flex align-item-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                        <button class="btn btn-link delete-button" data-product-id="${product.id}" data-template-id="${template.id}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $container.append(newProject);

        }
        $(document).on('click', '.copy-button', function() {
            var productId =$(this).data('product-id');
           // console.log(productId);
            $.ajax({
              type: 'GET',
              url: `/copyTemp/${productId}`,
              data: {
                  "_token": "{{ csrf_token() }}",
                  },
                  
                success: function (response) {
                    const template = response.userTemplate;
                    const product = template.product;
                    createGrid(template,product);
               
            },
                 
              error: function (xhr, status, error) {
                  console.error(xhr.responseText);
              }
            });        
        });
    
        $(document).on('click', '.delete-button', function() {
            var productId = $(this).data('product-id');
            var templateId = $(this).data('template-id');
            
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/deleteTemp/${productId}`,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Remove the element with the class .my-{templateId}
                            $('.my-' + templateId).remove();
                            console.log('Removed element with class: .my-' + templateId);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                } else {
                    swal("Your data is safe!");
                }
            });
        });

        $('.product-search').on('change', function() {
            var search = $(this).val();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
            url: '/project/search',
            type: 'POST',
            data: {
                search: search,
                _token: csrfToken
            },
            success: function(response) {
                console.log(response); // To inspect the structure
                const templates = response.templates.data; // Accessing the data array

                // Empty the container before adding new elements
                $('.card-container').empty();

                // Iterate over each template in the array
                templates.forEach(template => {
                    let temp = template;
                    let product = temp.product;

                    // Call your function to create elements for each template and product
                    createGrid(temp, product);
                });
            },
                error: function(xhr) {
                    // Handle errors
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>
@endpush