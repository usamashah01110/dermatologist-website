@extends('admin.include.main')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row mb-6 gy-6">
                <div class="col-xl">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Create Patient Review</h5>
                    </div>
                    <div class="card-body">                      
                    <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-6">
                          <label class="form-label">Patient Name</label>
                          <input type="text" name="name" class="form-control" placeholder="Enter Patient Name" />
                        </div>

                        <div class="mb-6">
                          <label class="form-label">Location</label>
                          <input type="text" name="location" class="form-control" placeholder="Enter City/Location" />
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label">Review Text</label>
                          <textarea name="review_text" class="form-control" rows="3" placeholder="Enter Patient Review"></textarea>
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label">Upload Patient Image</label>
                          <input type="file" name="image" class="form-control" />
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Save Review</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection