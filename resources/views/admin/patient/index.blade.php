@extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permissions</h5>
            <a href="{{ route('permission.create') }}" class="btn btn-primary btn-lg">Create New Permission</a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                          <th>password</th>
                            <th>phone-number</th>
                              <th>Age</th>
                                <th>Gender</th>
                                  <th>Address</th>
                                    <th>Skin-type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach(   $patients as $patient)
                    <tr>
                        <td>{{$patient->id }} </td>
                        <td>{{$patient->user->name }} </td>
                        <td>{{$patient->user->email }} </td>
                        <td>{{$patient->user->password}} </td>
                         <td>{{$patient->phone_number}} </td>
                        <td>{{$patient->age}} </td>
                        <td>{{$patient->gender}} </td>
                        <td>{{$patient->address}} </td>
                        <td>{{$patient->skin_type}} </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
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