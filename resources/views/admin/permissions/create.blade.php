@extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create Permission</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Permission Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Permission</button>
            </form>
        </div>
    </div>
</div>

@endsection