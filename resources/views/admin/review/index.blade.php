 @extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Patient Reviews</h5>
            <a href="{{ route('review.create') }}" class="btn btn-primary btn-lg">Create New Review</a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Location</th>
                        <th>Review Text</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->location }}</td>
                        <td>{{ $review->review_text }}</td>
                        <td>
                            @if($review->image_path)
                                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Patient Image" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" />
                            @else
                                <div class="bg-light rounded-circle shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <small class="text-muted">No Image</small>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('review.edit', $review->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                   
            </table>
        </div>
        
        <div class="card-footer">
        </div>
    </div>
</div>

@endsection