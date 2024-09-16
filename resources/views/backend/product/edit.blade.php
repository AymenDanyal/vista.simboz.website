@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
        <form method="post" id="productForm" action="{{ route('product.update', $productDetails['product']['id']) }}">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                    value="{{$productDetails['product']['title']}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="summary"
                    name="summary">{{$productDetails['product']['summary']}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control" id="description"
                    name="description">{{$productDetails['product']['description']}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_featured">Is Featured</label><br>
                <input type="checkbox" name='is_featured' id='is_featured' value='{{$productDetails['product']['is_featured']}}' {{(($productDetails['product']['is_featured']) ? 'checked' : '' )}}> Yes
            </div>

            <div class="form-group">
                <label for="cat_id">Category <span class="text-danger">*</span></label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">--Select any category--</option>

                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" @if($productDetails['category'][0]['id']==$category['id'])
                        selected @endif>
                        {{ $category['title'] }}
                    </option>
                    @endforeach

                </select>
                @error('cat_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="categoriesContainer">

                <div class="form-group">

                    <label for="filterCategory" class="col-form-label">Product Filters (not loading new filters added)</label>
                    <select id="filterCategory" name="filter_cat" class="form-control mt-2">
                        <option value="null">-- Select Filters --</option>

                        @foreach ($productDetails['filter_applied'] as $filter)
                        <option class="d-none" data-filter_id="{{ $filter['filter_id'] }}"
                            id="option{{ $filter['filter_id'] }}" value="{{ $filter['filter_name'] }}"
                            label="{{$filter['filter_name']}}"></option>
                        @endforeach
                    </select>
                </div>
                <div class="filterContainer row p-2">
                    @foreach ($productDetails['filter_applied'] as $filter)
                    <div class="mainDiv col-12">
                        <div class="filterValue">{{ $filter['filter_name'] }}</div>
                        <div class="closeDiv" id="{{ $filter['filter_id'] }}">
                            <i class="fa-solid fa-x closeIconDiv"></i>
                        </div>
                        @foreach ($filter['parameters'] as $parameter)
                        <div class="paramContainer row">
                            <li class="form-control col-4 mt-2 paramDiv" data-filter-id="{{  $filter['filter_id'] }}">
                                <input type="hidden" value="{{ $parameter['param_value'] }}" name="parameters[]"
                                    data-param-id="{{ $parameter['param_id'] }}"
                                    id="option{{ $parameter['param_id'] }}">
                                <p class="paramValue">{{ $parameter['param_value'] }}</p>
                                <div class="closeParam" data-id="{{ $parameter['param_id'] }}">
                                    <i class="fa-solid fa-x closeIcon"></i>
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </div>

                    @endforeach
                    @error('parameters')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            @php
            $sub_cat_info=DB::table('categories')->select('title')->where('id',$productDetails['product']['child_cat_id'])->get();
            // dd($sub_cat_info);
            @endphp
            {{-- {{$product->child_cat_id}} --}}
            <div class="form-group {{(($productDetails['product']['child_cat_id'])? '' : 'd-none')}}"
                id="child_cat_div">
                <label for="child_cat_id">Sub Category</label>
                <select name="child_cat_id" id="child_cat_id" class="form-control">
                    <option value="">--Select any sub category--</option>

                </select>
            </div>

            
            
            <div id="price-ranges">
                @foreach ($priceRange as $key => $value)
                    <div id='pr-{{$key}}' data-pr="{{$key}}" class="form-group d-flex testing">
                        <div class="pr-2">
                            <label for="price" class="col-form-label">Price (RS) <span class="text-danger">*</span></label>
                            <input id="price_0" type="number" name="prices[{{$key}}]" placeholder="Enter price" class="form-control" value="{{ $value->price }}">    
                        </div>
                        <div class="pr-2">
                            <label for="min-range" class="col-form-label">Min range <span class="text-danger">*</span></label>
                        <input id="min-range_0" type="number" name="min_ranges[{{$key}}]" placeholder="Enter min range" class="form-control" value="{{ $value->min_range }}">
                        </div>
                        <div>
                            <label for="max-range" class="col-form-label">Max range <span class="text-danger">*</span></label>
                            <input id="max-range_0" type="number" name="max_ranges[{{$key}}]" placeholder="Enter max range" class="form-control" value="{{ $value->max_range }}">    
                        </div>
                        @error('prices')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                @endforeach
            </div>
            
          
            <button type="button" id="add-price-range" class="btn btn-secondary">Add Price Range</button>

            <div class="form-group">
                <label for="discount" class="col-form-label">Discount(%)</label>
                <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
                    value="{{$productDetails['product']['discount']}}" class="form-control">
                @error('discount')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                    <option value="">--Select any size--</option>

                    @php
                    $data=explode(',',$productDetails['product']['size']);
                    // dd($data);
                    @endphp
                    <option value="S" @if( in_array( "S" ,$data ) ) selected @endif>Small</option>
                    <option value="M" @if( in_array( "M" ,$data ) ) selected @endif>Medium</option>
                    <option value="L" @if( in_array( "L" ,$data ) ) selected @endif>Large</option>
                    <option value="XL" @if( in_array( "XL" ,$data ) ) selected @endif>Extra Large</option>

                </select>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" class="form-control">
                    <option value="">--Select Brand--</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}" {{(($productDetails['product']['brand_id']==$brand->id)?
                        'selected':'')}}>{{$brand->title}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="condition">Condition</label>
                <select name="condition" class="form-control">
                    <option value="">--Select Condition--</option>
                    <option value="default" {{(($productDetails['product']['condition']=='default' )? 'selected' :'')}}>
                        Default</option>
                    <option value="new" {{(($productDetails['product']['condition']=='new' )? 'selected' :'')}}>New
                    </option>
                    <option value="hot" {{(($productDetails['product']['condition']=='hot' )? 'selected' :'')}}>Hot
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Quantity <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                    value="{{$productDetails['product']['stock']}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a data-input="thumbnail1" data-preview="holder1" class="btn btn-primary text-white lfm">
                            <i class="fas fa-image"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail1" class="form-control" type="text" name="photo"
                        value="{{$productDetails['product']['photo']}}">
                </div>
                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Template <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white lfm">
                            <i class="fas fa-image"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail2" class="form-control" type="text" name="front"
                        value="{{$productDetails['template'][0]['front_psd_url']}}">
                </div>
                <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                @error('front')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="template_height">Template Height <span class="text-danger">*</span></label>
                <input id="template_height" type="number" name="template_height" min="0" placeholder="Height in Inches"
                    value="{{ old('template_height', isset($productDetails['template'][0]['template_height']) ? $productDetails['template'][0]['template_height'] : '') }}"
                    class="form-control">
                @error('template_height')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="template_width">Template Width <span class="text-danger">*</span></label>
                <input id="template_width" type="number" name="template_width" min="0" placeholder="Width in Inches"
                    value="{{ old('template_width', isset($productDetails['template'][0]['template_width']) ? $productDetails['template'][0]['template_width'] : '') }}"
                    class="form-control">
                @error('template_width')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" {{(($productDetails['product']['status']=='active' )? 'selected' : '' )}}>
                        Active</option>
                    <option value="inactive" {{(($productDetails['product']['status']=='inactive' )? 'selected' : ''
                        )}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <div class="btn btn-success submit" type="submit">Update</button>
                </div>
        </form>
    </div>
</div>

@endsection

@push('styles')

<style>
    .selected {
        background-color: #8d8d8d;
        color: white;
    }

    .paramValue {
        white-space: nowrap;
        /* Prevent text from wrapping to the next line */
        overflow: hidden;
        /* Hide overflowed text */
        text-overflow: ellipsis;
        /* Show ellipsis (...) for overflowed text */
    }

    .closeIcon {
        position: absolute;
        top: 13px;
        right: 8px;
        font-size: 13px;
    }

    .mainDiv {
        border: 1px solid #D1D3E2;
        border-radius: 5px;
        padding: 19px;
        margin-top: 5px;
    }

    .closeDiv {
        position: relative;
        font-size: 13px;
    }

    .closeIconDiv {
        position: absolute;
        right: -1px;
        top: -18px;
    }

    .filterValue {
        font-weight: 600;
    }
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('.lfm').filemanager('image');
        $('#cat_id').change(function(){
            var cat_id=$(this).val();
            if(cat_id !=null){
                // Ajax call
                $.ajax({
                url:"/admin/category/"+cat_id+"/child",
                data:{
                    _token:"{{csrf_token()}}",
                    id:cat_id
                },
                type:"POST",
                success:function(response){
                    if(typeof(response) !='object'){
                    response=$.parseJSON(response)
                    }
                    // console.log(response);
                    var html_option="<option value=''>----Select sub category----</option>"
                    if(response.status){
                    var data=response.data;
                    // alert(data);
                    if(response.data){
                        $('#child_cat_div').removeClass('d-none');
                        $.each(data,function(id,title){
                        html_option +="<option value='"+id+"'>"+title+"</option>"
                        });
                    }
                    else{
                    }
                    }
                    else{
                    $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
                });
            }
            else{
            }
        });
        var filters =  @json($filters);
        $(document).on('change', '#filterCategory', function() {
            var selectedValue = $(this).val();

            // Get the selected filter_id
            var selectedFilterId = $('#filterCategory option:selected').attr('data-filter_id');
            
            if (selectedValue !== "null" && selectedFilterId) {
                // Remove the selected option
                $('#filterCategory option:selected').addClass('d-none');

                var mainDiv = $('<div>').addClass('mainDiv col-12');

                // Create the display div
                var displayDiv = $('<div>').addClass('filterValue').text(selectedValue);
                mainDiv.append(displayDiv);

                // Create the close div
                var close = $('<div>').addClass('closeDiv').attr('id', selectedFilterId)
                                    .html("<i class='fa-solid fa-x closeIconDiv'></i>");
                mainDiv.append(close);

                // Find the selected filter object from the filters array
                var selectedFilter = filters[selectedFilterId];

                if (selectedFilter && selectedFilter.parameters) {
                    var paramContainer = $('<div>').addClass('paramContainer row');

                    // Loop through the parameters of the selected filter and create list items
                    selectedFilter.parameters.forEach(function(parameter) {
                        var paramDiv = $('<li>').addClass('form-control col-4 mt-2 paramDiv')
                                                .attr('data-filter-id', parameter.filter_id);

                        var paramP = $('<p>').addClass('paramValue').text(parameter.param_value);

                        var input = $('<input>').attr({
                            type: 'hidden',
                            value: parameter.param_id,
                            name: 'parameters[]',
                            'data-param-id': parameter.param_id,
                            id: parameter.param_id
                        });

                        var paramClose = $('<div>').addClass('closeParam')
                                                .html("<i class='fa-solid fa-x closeIcon'></i>")
                                                .attr('data-id', parameter.param_id);

                        paramDiv.append(input, paramP, paramClose);
                        paramContainer.append(paramDiv);
                    });

                    mainDiv.append(paramContainer);
                    $('.filterContainer').append(mainDiv); // Append to filterContainer using jQuery
                } else {
                    console.log('Selected filter or parameters not found.');
                }
            }
        });
        $(document).on('click', '.closeParam', function() {

            var id = $(this).data('id');
            $(this).parent().toggleClass('selected');
            $(this).children().toggleClass('fa-x fa-plus');
        });
        $(document).on('click', '.closeDiv', function() {
            var id = $(this).attr('id');
            $(this).parent('div').remove();
            console.log('option'+id);
            $('#option' + id).removeClass('d-none');
        
        });
        $(document).on('change', '#cat_id', function() {
                var categoryId = $(this).val();
                var category=@json($categories);
                var categoryData = category[categoryId];
                //console.log(categoryData);
                var filtersHtml = '';
                $('.categoriesContainer').empty();
                if(categoryData)
                {
                    Object.keys(categoryData.filters).forEach(function(filterId) {
                        var filter = categoryData.filters[filterId];
                        var parametersHtml = '';
                        
                        filter.parameters.forEach(function(param) {
                            parametersHtml += param.param_value + ', ';
                        });
                        
                        // Remove trailing comma
                        if (parametersHtml.length > 0) {
                            parametersHtml = parametersHtml.slice(0, -2);
                        }
                    
                        filtersHtml += `
                            <option data-filter_id="${filter.filter_id}" id="option${filter.filter_id}" value="${filter.filter_name}">
                                ${filter.filter_name}
                            </option>
                        `;
                    });
                    
                    // Append HTML to the DOM
                    var element = `
                        <div class="form-group">
                            <label for="filterCategory" class="col-form-label">Product Filters</label>
                            <select id="filterCategory" name="filter_cat" class="form-control mt-2">
                                <option value="null">-- Select Filters --</option>
                                ${filtersHtml}
                            </select>
                            <div class="filterContainer row p-2">
                                <!-- Container for filtered content -->
                            </div>
                            @error('filter_cat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    `;
                    
                    // Append element to the document body or a specific container
                    
                    $('.categoriesContainer').append(element);
                }
        });
        $(document).on('click', '.submit', function() {
            var formData = $('#productForm').serializeArray();
            var filteredFormData = formData.filter(function(field) {
                return field.name !== 'parameters[]';
            });

    

            // Select all <li> elements with class 'paramDiv' and without class 'selected'
            var elements = $('li.paramDiv:not(.selected)');

            var groupedParams = {};

            // Iterate through each matched <li> element
            elements.each(function() {
                var filterId = $(this).data('filter-id');
                var paramId = $(this).find('input[type="hidden"]').data('param-id');

                if (!groupedParams[filterId]) {
                    groupedParams[filterId] = [];
                }
                groupedParams[filterId].push(paramId);
            });

            // Output the grouped parameters (for demonstration purposes)
           // console.log(groupedParams);

            // Clear existing 'parameters[]' fields in the form
            $('input[name="parameters[]"]').remove();

            // Insert the grouped parameters into the form as hidden inputs
            $.each(groupedParams, function(filterId, paramIds) {
                paramIds.forEach(function(paramId) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'parameters[' + filterId + '][]',
                        value: paramId
                    }).appendTo('#productForm');
                });
            });

            // Submit the form
            $('#productForm').submit();
        });
        
        var i = 1;
        $('#add-price-range').click(function() {
            $('#price-ranges').append(`
                <div class="form-group d-flex">
                    <div>
                        <label for="price_${i}" class="col-form-label">Price (RS) <span class="text-danger">*</span></label>
                        <input id="price_${i}" type="number" name="prices[${i}]" placeholder="Enter price" class="form-control">    
                    </div>
                    <div>
                        <label for="min-range_${i}" class="col-form-label">Min range <span class="text-danger">*</span></label>
                        <input id="min-range_${i}" type="number" name="min_ranges[${i}]" placeholder="Enter min range" class="form-control">
                    </div>
                    <div>
                        <label for="max-range_${i}" class="col-form-label">Max range <span class="text-danger">*</span></label>
                        <input id="max-range_${i}" type="number" name="max_ranges[${i}]" placeholder="Enter max range" class="form-control">    
                    </div>
                </div>
            `);
            i++;
        });
        $(document).on('click', '.remove-price-range', function() {
            $(this).closest('.form-group').remove();
        });
    </script>
    @endpush