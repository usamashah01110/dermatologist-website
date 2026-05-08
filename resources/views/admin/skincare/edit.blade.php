@extends('admin.include.main')
@section('content')
<div class="container p-4">
   <div class="card">
      <div class="card-header">
         <h5 class="mb-0">Edit Skincare Article</h5>
      </div>
      <div class="card-body">
         <form action="{{ route('skincare.update', $skincare->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
               <label class="form-label" for="title">Title</label>
               <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $skincare->title) }}" placeholder="Enter article title">
               @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
               <label class="form-label" for="content">Content</label>
               <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="6" placeholder="Enter article content">{{ old('content', $skincare->content) }}</textarea>
               @error('content')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
               <label class="form-label" for="image_path">Image</label>
               <input class="form-control @error('image_path') is-invalid @enderror" type="file" id="image_path" name="image_path">
               @if($skincare->image_path)
               <div class="mt-2">
                  <img src="{{ asset($skincare->image_path) }}" alt="Current Image" style="max-width: 200px; height: auto;" />
               </div>
               @endif
               @error('image_path')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
         </form>
      </div>
   </div>
</div>
@endsection
