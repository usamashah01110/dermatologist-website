@extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-muted">(leave blank to keep current)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>

                <div class="mb-3">
                    <label class="form-label">Roles</label>
                    <div class="border p-3 rounded">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>

@endsection
