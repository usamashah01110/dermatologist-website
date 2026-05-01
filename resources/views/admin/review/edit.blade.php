@extends('admin.include.main')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row mb-6 gy-6">
                <div class="col-xl">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Edit Patient Review</h5>
                    </div>
                    <div class="card-body">                      
                    <form action="{{ route('review.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                          <label class="form-label">Patient Name</label>
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Patient Name" value="{{ $review->name }}" />
                          @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-6">
                          <label class="form-label">Location</label>
                          <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter City/Location" value="{{ $review->location }}" />
                          @error('location')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label">Review Text</label>
                          <textarea name="review_text" class="form-control @error('review_text') is-invalid @enderror" rows="3" placeholder="Enter Patient Review">{{ $review->review_text }}</textarea>
                          @error('review_text')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label">Patient Image</label>
                          @if($review->image_path)
                            <div class="mb-3">
                              <img src="{{ asset('storage/' . $review->image_path) }}" alt="Patient Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;" />
                            </div>
                          @endif
                          <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" />
                          @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Update Review</button>
                        <a href="{{ route('review.index') }}" class="btn btn-secondary">Cancel</a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection