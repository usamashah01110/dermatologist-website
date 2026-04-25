@extends('admin.include.main')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Layout -->
              <div class="row mb-6 gy-6">
                <div class="col-xl">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Create Disease</h5>
                    </div>
                    <div class="card-body">
                      @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Validation Errors!</strong>
                          <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      @endif
                      <form action="{{ route('disease.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                          <label class="form-label" for="basic-default-fullname">Name</label>
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="basic-default-fullname" placeholder="Enter Name Of Disease" value="{{ old('name') }}" />
                          @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-6">
                          <label class="form-label" for="basic-default-company">Description</label>
                          <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="basic-default-company" placeholder="Enter Disease Description" value="{{ old('description') }}" />
                          @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label" for="basic-default-company">Tag</label>
                          <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" id="basic-default-company" placeholder="Enter Disease Tag" value="{{ old('tag') }}" />
                          @error('tag')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                        </div>
                     
                        <div class="mb-6">
                          <label class="form-label" for="basic-default-company">Upload Image</label>
                          <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror" id="basic-default-company" />
                          @error('image_path')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Send</button>
                      </form>
                    </div>
                  </div>
                </div>
         
              </div>
            </div>
@endsection