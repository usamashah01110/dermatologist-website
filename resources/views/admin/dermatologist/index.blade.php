@extends('admin.include.main')
@section('content')
<div class="container p-4">

    {{-- Flash messages (approval result, incl. whether the email went out) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

   <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Dermatologist</h5>
                    <a href="{{ route('dermatologist.create') }}" class="btn btn-primary">
                        <i class="icon-base bx bx-plus me-1"></i> Create Dermatologist
                    </a>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>qualification</th>
                        <th>experience_year</th>
                        <th>specialization</th>
                        <th>phone_number</th>
                        <th>clinic_address</th>
                        <th>city</th>
                        <th>availability_days</th>
                        <th>status</th>
                        <th>profile_image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @forelse($doctors as $doctor)
                      <tr>
                        <td>{{$doctor->id }}</td>
                        <td>{{$doctor->user->name }}</td>
                       <td>{{$doctor->user->email }}</td>
                        <td>{{$doctor->user->password}}</td>
                         <td>{{$doctor->qualification }}</td>
                          <td>{{$doctor->experience_year }}</td>
                           <td>{{ $doctor->specialization}}</td>
                            <td>{{ $doctor->phone_number }}</td>
                             <td>{{ $doctor->clinic_address }}</td>
                              <td>{{ $doctor->city }}</td>
                               <td>{{ is_array($doctor->availability_days) ? 
                                implode(',',
                                 $doctor->availability_days):
                                $doctor->availability_days}}</td>
                                <td>{{ $doctor->status }}</td>
                        <td>
                          <img src="{{ asset('storage/' .$doctor->profile_image) }}" alt="Dermatologist-Image" class="rounded-circle" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('dermatologist.edit', $doctor->id) }}"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                              <form action="{{ route('dermatologist.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i class="icon-base bx bx-trash me-1"></i> Delete</button>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center">No  Dermatologist found.</td>
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