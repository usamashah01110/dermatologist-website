@extends('admin.include.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account /</span> My Profile
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        {{-- Summary card --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <img src="{{ $user->avatar ?? asset('assets/img/avatars/1.png') }}" alt="avatar" class="rounded-circle">
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-2">{{ $user->email }}</p>
                    @foreach($user->roles as $role)
                        <span class="badge bg-label-primary">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Edit form --}}
        <div class="col-md-8 mb-4">
            <div class="card">
                <h5 class="card-header">Edit Profile</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <h6 class="text-muted fw-semibold mb-3">Account</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">New Password <small class="text-muted">(leave blank to keep)</small></label>
                                <input type="password" name="password" class="form-control" autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Dermatologist fields --}}
                        @if($user->hasRole('dermatologist') && $user->dermatologist)
                            <h6 class="text-muted fw-semibold mb-3">Dermatologist Details</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->dermatologist->phone_number) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Qualification</label>
                                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $user->dermatologist->qualification) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Specialization</label>
                                    <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $user->dermatologist->specialization) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Experience</label>
                                    <input type="text" name="experience_year" class="form-control" value="{{ old('experience_year', $user->dermatologist->experience_year) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Clinic Address</label>
                                    <input type="text" name="clinic_address" class="form-control" value="{{ old('clinic_address', $user->dermatologist->clinic_address) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city', $user->dermatologist->city) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Working Days</label>
                                    <div>
                                        @foreach((array) $user->dermatologist->availability_days as $day)
                                            <span class="badge bg-label-success">{{ $day }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Patient fields --}}
                        @if($user->hasRole('patient') && $user->patient)
                            <h6 class="text-muted fw-semibold mb-3">Patient Details</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->patient->phone_number) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control" value="{{ old('age', $user->patient->age) }}" min="1" max="120">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        @foreach(['Male', 'Female', 'Other', 'Prefer not to say'] as $g)
                                            <option value="{{ $g }}" {{ old('gender', $user->patient->gender) === $g ? 'selected' : '' }}>{{ $g }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Skin Type</label>
                                    <select name="skin_type" class="form-select">
                                        <option value="">Select</option>
                                        @foreach(['Normal', 'Oily', 'Dry', 'Combination', 'Sensitive', 'Not sure'] as $s)
                                            <option value="{{ $s }}" {{ old('skin_type', $user->patient->skin_type) === $s ? 'selected' : '' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="2">{{ old('address', $user->patient->address) }}</textarea>
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
