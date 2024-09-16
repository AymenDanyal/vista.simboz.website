@extends('backend.layouts.master')

@section('main-content')



<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
        <form method="post" id="productForm" action="{{route('product.store')}}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            {{csrf_field()}}
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}"
                    class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="is_featured">Is Featured</label><br>
                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
            </div>
            {{-- {{$categories}} --}}

            <div class="form-group">
                <label for="cat_id">Category <span class="text-danger">*</span></label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">--Select any category--</option>
                    @foreach($categoryGroup as $key=>$category)
                    <option value='{{$key}}'>{{$category['title']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="categoriesContainer"></div>
            <div class="form-group d-none" id="child_cat_div">
                <label for="child_cat_id">Sub Category</label>
                <select name="child_cat_id" id="child_cat_id" class="form-control">
                    <option value="">--Select any category--</option>
                    {{-- @foreach($parent_cats as $key=>$parent_cat)
                    <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                    @endforeach --}}
                </select>
            </div>

            <div id="price-ranges">
                <div class="form-group d-flex ">
                    <div>
                        <label for="price" class="col-form-label">Price (RS) <span class="text-danger">*</span></label>
                        <input id="price_0" type="number" name="prices[0]" placeholder="Enter price" class="form-control">    
                    </div>
                    <div>
                        <label for="min-range" class="col-form-label">Min range <span class="text-danger">*</span></label>
                <input id="min-range_0" type="number" name="min_ranges[0]" placeholder="Enter min range" class="form-control">
                    </div>
                    <div>
                        <label for="max-range" class="col-form-label">Max range <span class="text-danger">*</span></label>
                        <input id="max-range_0" type="number" name="max_ranges[0]" placeholder="Enter max range" class="form-control">    
                    </div>
                    @error('prices')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            
            <button type="button" id="add-price-range" class="btn btn-secondary">Add Price Range</button>
            
            <div class="form-group">
                <label for="discount" class="col-form-label">Discount(%)</label>
                <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
                    value="{{old('discount')}}" class="form-control">
                @error('discount')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                    <option value="">--Select any size--</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">Extra Large (XL)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="brand_id">Brand</label>
                {{-- {{$brands}} --}}

                <select name="brand_id" class="form-control">
                    <option value="">--Select Brand--</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="condition">Condition</label>
                <select name="condition" class="form-control">
                    <option value="">--Select Condition--</option>
                    <option value="default">Default</option>
                    <option value="new">New</option>
                    <option value="hot">Hot</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Quantity <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                    value="{{old('stock')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ old('photo') }}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputTemplate" class="col-form-label">Template <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="tempButton" data-input="template" data-preview="temp" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="template" class="form-control" type="text" name="template" value="{{ old('template') }}">
                </div>
                <div id="temp" style="margin-top:15px;max-height:100px;"></div>
                @error('template')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Template Height <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="template_height" min="0" placeholder="Height in Inches"
                    value="{{old('template_height')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock">Template Width <span class="text-danger">*</span></label>
                <input id="quantity" type="number" name="template_width" min="0" placeholder="Width in Inches"
                    value="{{old('template_height')}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <div class="btn btn-success submit">Submit</div>
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
< <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js">
    </script>

    <script>
        $('#lfm').filemanager();
        $('#tempButton').filemanager('image');
        $('#cat_id').change(function(){
        var cat_id=$(this).val();
        // alert(cat_id);
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
        $(document).on('change','#filterCategory',function() {
            var selectedValue = $(this).val();
            // Get the selected value
            var selectedFilterId = $('#filterCategory option:selected').attr('data-filter_id');
            if (selectedValue !== "null") 
            {
                    // Remove the selected option
                    $('#filterCategory option:selected').addClass('d-none');
                    var mainDiv = document.createElement('div');
                    mainDiv.className = 'mainDiv col-12';

                    // Create the display div
                    var displayDiv = document.createElement('div');
                    displayDiv.className = 'filterValue';
                    displayDiv.textContent = selectedValue;
                    mainDiv.appendChild(displayDiv);

                    // Create the close div
                    var close = document.createElement('div');
                    close.className = 'closeDiv';
                    close.setAttribute('id', selectedFilterId);
                    close.innerHTML = "<i class='fa-solid fa-x closeIconDiv'></i>";
                    mainDiv.appendChild(close);

            
                    // Find the selected filter object from the filters array
                    var selectedFilter = filters.find(function(filter) {
                        return filter.filter_id == selectedFilterId;
                    });

                    var paramContainer = document.createElement('div');
                    paramContainer.className = 'paramContainer row';
                    // Loop through the parameters of the selected filter and create list items
                    selectedFilter.parameters.forEach(function(parameter) {

                        var paramDiv = document.createElement('li');
                        paramDiv.className = 'form-control col-4 mt-2 paramDiv';
                        paramDiv.setAttribute('data-filter-id', parameter.filter_id);

                        var paramP = document.createElement('p');
                        paramP.className = 'paramValue';
                        paramP.textContent = parameter.param_value;

                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.value = parameter.param_id;
                        input.name = 'parameters[]';
                        input.setAttribute('data-param-id', parameter.param_id);
                        input.setAttribute('id', parameter.param_id);

                        var paramClose = document.createElement('div');
                        paramClose.className = 'closeParam';
                        paramClose.innerHTML = "<i class='fa-solid fa-x closeIcon'></i>";
                        paramClose.setAttribute('data-id', parameter.param_id);

                        paramDiv.appendChild(input);
                        paramDiv.appendChild(paramP);
                        paramDiv.appendChild(paramClose);
                        paramContainer.appendChild(paramDiv);
                        
                        });
                        mainDiv.appendChild(paramContainer);
                        // Append the main container div to the filter container
                        $('.filterContainer').append(mainDiv);
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
            $('#option' + id).removeClass('d-none');
        
        });
        $(document).on('change', '#cat_id', function() {
                var categoryId = $(this).val();
                var category=@json($categoryGroup);
                var categoryData = category[categoryId];
                var filtersHtml = '';
                $('.categoriesContainer').empty();
                if(categoryData.filters.length!=0)
                {
                    Object.keys(categoryData.filters).forEach(function(filterId) {
                        var filter = categoryData.filters[filterId];
                        var parametersHtml = '';
                        
                        filter.parameters.forEach(function(param) {
                            parametersHtml += param + ', ';
                        });
                        
                        // Remove trailing comma
                        if (parametersHtml.length > 0) {
                            parametersHtml = parametersHtml.slice(0, -2);
                        }
                        
                        filtersHtml += `
                            <option data-filter_id="${filterId}" id="option${filterId}" value="${filter.filter_name}">
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

            // Output the filtered serialized data (for demonstration purposes)
            console.log(filteredFormData);

            // Accessing individual field values (if needed)
            filteredFormData.forEach(function(field) {
                console.log(field.name + ': ' + field.value);
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
            console.log(groupedParams);

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