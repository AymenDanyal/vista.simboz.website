@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Filter</h5>
    <div class="card-body">
        @foreach ($groupedParameters as $key => $parameters)
        <form method="POST" action="{{ route('filter.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Filter Name</label>
                <input id="inputTitle" type="text" name="filter_name" placeholder="Enter title"
                    value="{{ $parameters['filter_name'] }}" class="form-control">
                <input class="d-none" name="filter_id" value="{{ $parameters['filter_id'] }}">
                @error('filter_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="filterCategory" class="col-form-label">Filter Category</label>
                <select id="filterCategory" name="filter_cat" class="form-control">
                    <option value='null'>-- Select Category --</option>
                    @foreach($categories as $id => $category)
                    <option value="{{ $id }}" @if(in_array($category, $parameters['categories'])) selected @endif>
                        {{ $category }}
                    </option>
                    @endforeach
                </select>
                @error('filter_cat')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group" id="dynamic-fields">
                <label for="filterParameter" class="col-form-label">Filter Parameter</label><br>
                <div class=" row">
                    <input class="d-none"  name="parameters[0]" value="empty">
                    @foreach($parameters['parameters'] as $parameter)
                    <div class="col-3 paramDiv">
                        <input class="form-control mt-2 param" type="text" name="parameters[{{ $parameter->param_id }}]"
                            value="{{ $parameter->param_value }}" placeholder="Enter parameter">
                        <i class="fa-solid fa-xmark delete" data-id="{{ $parameter->param_id }}"
                            style="position: absolute;top: 20px;right: 21px;"></i>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="button" class="btn btn-primary mt-3 mb-3 addParam">Add More Parameter</button>

            <div class="form-group">
                <label for="filterCat" class="col-form-label">Parameter Price</label>
                <input id="filterCat" type="text" name="param_price" placeholder="Enter title"
                    value="{{ $parameter->param_id }}" class="form-control">
               
                @error('param_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
        @endforeach
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        var counter = $('#dynamic-fields input').length + 1;

        $('.addParam').on('click', function() {
            var container = $('#dynamic-fields');
            var input = $('<input>')
                .attr('type', 'text')
                .attr('name', 'parameters[new_' + counter + ']')
                .attr('placeholder', 'Enter parameter ' + counter)
                .addClass('form-control mt-2');
            container.append(input);
            counter++;
        });
        
        $('.delete').on('click', function() {
            var id = $(this).data('id');
            var element = $(this);
            $.ajax({
                type: 'POST',
                url: '{{ route('filter.deleteParam') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    paramId: id,                    
                    },
                    success: function(response) {
                    if (response.success) {
                        element.closest('.paramDiv').remove();
                    } else {
                        alert(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                    alert('An error occurred while deleting the parameter');
                }
                });     
            
        });
       
    });
</script>
@endsection