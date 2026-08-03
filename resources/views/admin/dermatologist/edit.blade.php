 
@extends('admin.include.main')
@section('content')
<div class="container mt-5">
    <h2>Edit Dermatologist Status</h2>
    <hr>

 
    <form action="{{ route('dermatologist.update', $dermatologist->id) }}" method="POST">
        @csrf
        @method('POST')

         

        <div class="mb-3">
            <label class="form-label">Current Status</label>
            <select name="status" class="form-control">

                <option value="pending" {{ $dermatologist->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $dermatologist->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $dermatologist->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Consultation Fee (Rs)</label>
            <input type="number" name="consultation_fee" min="0" class="form-control"
                   value="{{ old('consultation_fee', $dermatologist->consultation_fee) }}" placeholder="e.g. 1500">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dermatologist.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection