@extends('admin.include.main')
@section('content')
<div class="container p-4">
   <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
         <h5 class="mb-0">Skincare Articles</h5>
         <a href="{{ route('skincare.create') }}" class="btn btn-primary btn-lg">Create  Skincare Article</a>
      </div>
      <div class="table-responsive text-nowrap">
         <table class="table">
            <thead class="table-dark">
               <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Image</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody class="table-border-bottom-0">
               @forelse($skincares as $article)
               <tr>
                  <td>{{ $article->id }}</td>
                  <td>{{ $article->title }}</td>
                  <td>{{ Str::limit($article->content, 60) }}</td>
                  <td>
                     @if($article->image_path)
                     <img src="{{ asset($article->image_path) }}" alt="Article Image" class="rounded-circle" style="width: 50px; height: 50px;">
                     @else
                     <span class="badge bg-secondary">No image</span>
                     @endif
                  </td>
                  <td>
                     <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                           <a class="dropdown-item" href="{{ route('skincare.edit', $article->id) }}">
                           <i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                           <a href="{{ route('skincare.delete', $article->id) }}" class="dropdown-item" onclick="return confirm('Are you sure?')">
                           <i class="icon-base bx bx-trash me-1"></i> Delete</a>
                        </div>
                     </div>
                  </td>
               </tr>
               @empty
               <tr>
                  <td colspan="5" class="text-center">No skincare articles found.</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection
