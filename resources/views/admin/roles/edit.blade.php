@extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="border p-3 rounded">
                        @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('permissions')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Role</button>
            </form>
        </div>
    </div>
</div>

@endsection