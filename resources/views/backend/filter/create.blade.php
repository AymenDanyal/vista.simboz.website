@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Category Filter</h5>
    <div class="card-body">
      <form method="post" action="{{ route('filter.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="filterName" class="col-form-label">Filter Name</label>
            <input id="filterName" type="text" name="filter_name" placeholder="Enter name" value="{{ old('filter_name') }}" class="form-control">
            @error('filter_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="filterCategory" class="col-form-label">Filter Category</label>
            <select id="filterCategory" name="filter_cat" class="form-control">
                <option value='null'>-- Select Category --</option>
                @foreach($categories as $id => $category)
                <option value="{{ $id }}">{{ $category }}</option>
                @endforeach
            </select>
            @error('filter_cat')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       
        <div class="form-group" id="dynamic-fields">
          <label for="filterParameter" class="col-form-label">Filter Parameter</label>
          <input id="filterParameter" type="text" name="parameters[]" placeholder="Enter parameter 1" class="form-control mt-2">
        </div>
       
        
        <button type="button" class="btn btn-primary mt-3 mb-5"  onclick="addInputField()">Add More Parameter</button>
        
        <div class="form-group mb-3">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
    
    </div>
</div>

@endsection

<script>
   var i =2;
    function addInputField() {
     
        var container = document.getElementById('dynamic-fields');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'parameters[]'; // Use array notation to submit multiple values
        input.placeholder = 'Enter parameter '+(i);
        input.className = 'form-control mt-2'; // Add Bootstrap class for styling
        container.appendChild(input);
        i++;
    }
</script>
