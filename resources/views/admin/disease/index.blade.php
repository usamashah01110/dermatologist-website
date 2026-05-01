@extends('admin.include.main')
@section('content')
<div class="container p-4">
   <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Disease</h5>
                    <a href="{{ route('disease.create') }}" class="btn btn-primary btn-lg">Create Disease</a>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Desciption</th>
                        <th>Tag</th>
                        <th>Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @forelse($diseases as $disease)
                      <tr>
                        <td>{{ $disease->id }}</td>
                        <td>{{ $disease->name }}</td>
                        <td>{{ Str::limit($disease->description, 50) }}</td>
                        <td>{{ $disease->tag }}</td>
                        <td>
                          <img src="{{ asset($disease->image_path) }}" alt="Disease Image" class="rounded-circle" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('disease.edit', $disease->id ) }}"
                                ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a href="{{ route('disease.delete', $disease->id ) }}" type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center">No diseases found.</td>
                      </tr>
                      @endforelse
                   
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                 
                </div>
              </div>
</div>
@endsection