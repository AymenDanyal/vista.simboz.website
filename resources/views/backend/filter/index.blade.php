@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Filter Lists</h6>
    <a href="{{route('filter.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
      data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Filter</a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      @if($filters)
      <table class="table table-bordered" id="post-filter-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Category</th>
            <th>Filter</th>
            <th>Filter parameter</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>


          @foreach($groupedParameters as $filterName => $details)
          <tr>
            @if(!empty($details['categories']))
            <td>
              @foreach($details['categories'] as $category)
              {{ $category }}
              @endforeach
            </td>
            @else
            <td>No categories Selected.</td>
            @endif
            <td>{{ $details['filter_name'] }}</td>

            @if(!empty($details['parameters']))
            <td>
              @foreach($details['parameters'] as $parameter)
              <li>{{ $parameter->param_value }}</li>
              @endforeach
            </td>
            @else
            <td>No parameters available.</td>
            @endif
            <td>
              <a href="{{route('filter.edit',$details['filter_id'])}}" class="btn btn-primary btn-sm float-left mr-1"
                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                data-placement="bottom"><i class="fas fa-edit"></i></a>
              <form method="POST" action="{{ route('filter.destroy', [$details['filter_id']]) }}">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $details['filter_id'] }}">
                <button class="btn btn-danger btn-sm dltBtn" style="height:30px; width:30px;border-radius:50%"
                  data-toggle="tooltip" data-placement="bottom" title=" ">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach






          {{-- <tr>
            @foreach ($groupedParameters as $groupName => $parameters)
            <td>{{ $groupName }}</td>
            <td>
              @foreach ($parameters as $parameter)
              {{ $parameter->param_value}} .
              <!-- Adjust according to your actual column names -->
              @endforeach

              @endforeach
            </td>

            <td>
              <a href="{{route('filter.edit',$data->filter_id)}}" class="btn btn-primary btn-sm float-left mr-1"
                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                data-placement="bottom"><i class="fas fa-edit"></i></a>
              <form method="POST" action="{{ route('filter.destroy', [$data->filter_id]) }}">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $data->filter_id }}">
                <button class="btn btn-danger btn-sm dltBtn" style="height:30px; width:30px;border-radius:50%"
                  data-toggle="tooltip" data-placement="bottom" title="Delete">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>



            </td>
          </tr> --}}

        </tbody>
      </table>
      @else
      <h6 class="text-center">No filter value found !!! Please filter parameter value</h6>
      @endif
    </div>
  </div>

</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

<style>
  div.dataTables_wrapper div.dataTables_paginate {
    display: none;
  }
</style>
@endpush

@push('scripts')

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
  integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
</script>
<script>
  $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
</script>
@endpush