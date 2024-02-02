@extends('backend.layouts.master')

@section('title', 'Review Edit')

@section('main-content')
<div class="card">
    <h5 class="card-header">Review Edit</h5>
    <div class="card-body">
        <div id="update-review-message"></div>
        <form id="update-review-form" action="{{ route('review.update', $review->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Review By:</label>
                <input type="text" disabled class="form-control" value="{{ $review->user_info->name }}">
            </div>
            <div class="form-group">
                <label for="review">Review</label>
                <textarea name="review" id="review" cols="20" rows="10"
                    class="form-control">{{ $review->review }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Status :</label>
                <select name="status" id="status" class="form-control">
                    <option value="">--Select Status--</option>
                    <option value="active" {{ ($review->status == 'active') ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($review->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="button" id="update-review-btn" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,
    .shipping-info {
        background: #ECECEC;
        padding: 20px;
    }

    .order-info h4,
    .shipping-info h4 {
        text-decoration: underline;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('#update-review-btn').click(function () {
            $.ajax({
                url: "{{ route('review.update', $review->id) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PATCH",
                    review: $('#review').val(),
                    status: $('#status').val()
                },
                success: function (response) {
                    if (response.success) {
                        $('#update-review-message').html('<div class="alert alert-success">Review updated successfully.</div>');
                    } else {
                        $('#update-review-message').html('<div class="alert alert-danger">Failed to update review.</div>');
                    }
                }
            });
        });
    });
</script>
@endpush
  