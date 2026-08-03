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
                         @if($user->hasRole('dermatologist'))
                            @if($user->dermatologist && $user->dermatologist->profile_image)
                                <img src="{{ asset('storage/' . $user->dermatologist->profile_image) }}" alt="Dermatologist Profile" class="rounded-circle" >
                            @else
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Default Avatar" class="rounded-circle" >
                            @endif
                       @endif
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
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
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

                        {{-- Dermatologist fields (create when missing, edit when present) --}}
                        @if($user->hasRole('dermatologist'))
                            @php $derm = $user->dermatologist; @endphp

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="text-muted fw-semibold mb-0">Dermatologist Details</h6>
                                @if($derm)
                                    @php
                                        $statusBadge = ['pending' => 'bg-label-warning', 'approved' => 'bg-label-success', 'rejected' => 'bg-label-danger'][$derm->status] ?? 'bg-label-secondary';
                                    @endphp
                                    <span class="badge {{ $statusBadge }}">{{ ucfirst($derm->status) }}</span>
                                @else
                                    <span class="badge bg-label-secondary">Not submitted</span>
                                @endif
                            </div>

                            @unless($derm)
                                <div class="alert alert-info">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Complete the fields below to create your professional profile. After an admin approves it,
                                    you'll appear in the public dermatologist directory.
                                </div>
                            @endunless

                            @php
                                $experienceOptions   = ['0-1' => 'Less than 1 year', '1-3' => '1 – 3 years', '3-5' => '3 – 5 years', '5-10' => '5 – 10 years', '10-15' => '10 – 15 years', '15+' => '15+ years'];
                                $specializationList  = ['General Dermatology', 'Cosmetic Dermatology', 'Pediatric Dermatology', 'Dermatopathology', 'Dermatologic Surgery', 'Trichology', 'Aesthetic Medicine'];
                                $cityList            = ['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Sialkot', 'Gujranwala', 'Hyderabad', 'Bahawalpur'];
                                $allDays             = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $selectedDays        = old('availability_days', (array) optional($derm)->availability_days);
                                $curExperience       = old('experience_year', optional($derm)->experience_year);
                                $curSpecialization   = old('specialization', optional($derm)->specialization);
                                $curCity             = old('city', optional($derm)->city);
                            @endphp

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Qualification <span class="text-danger">*</span></label>
                                    <input type="text" name="qualification" class="form-control" placeholder="MBBS, FCPS (Dermatology)"
                                           value="{{ old('qualification', optional($derm)->qualification) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Years of Experience <span class="text-danger">*</span></label>
                                    <select name="experience_year" class="form-select">
                                        <option value="">Select experience</option>
                                        @foreach($experienceOptions as $val => $label)
                                            <option value="{{ $val }}" {{ $curExperience === $val ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                        @if($curExperience && ! array_key_exists($curExperience, $experienceOptions))
                                            {{-- keep a legacy/free-text value selectable --}}
                                            <option value="{{ $curExperience }}" selected>{{ $curExperience }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Specialization <span class="text-danger">*</span></label>
                                    <select name="specialization" class="form-select">
                                        <option value="">Select specialization</option>
                                        @foreach($specializationList as $spec)
                                            <option value="{{ $spec }}" {{ $curSpecialization === $spec ? 'selected' : '' }}>{{ $spec }}</option>
                                        @endforeach
                                        @if($curSpecialization && ! in_array($curSpecialization, $specializationList))
                                            <option value="{{ $curSpecialization }}" selected>{{ $curSpecialization }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="+92 300 1234567"
                                           value="{{ old('phone_number', optional($derm)->phone_number) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Clinic Address <span class="text-danger">*</span></label>
                                    <input type="text" name="clinic_address" class="form-control" placeholder="123 Main Boulevard, Gulberg"
                                           value="{{ old('clinic_address', optional($derm)->clinic_address) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <select name="city" class="form-select">
                                        <option value="">Select your city</option>
                                        @foreach($cityList as $city)
                                            <option value="{{ $city }}" {{ $curCity === $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                        @if($curCity && ! in_array($curCity, $cityList))
                                            <option value="{{ $curCity }}" selected>{{ $curCity }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label d-block">Availability Days <span class="text-danger">*</span></label>
                                    @foreach($allDays as $day)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="availability_days[]"
                                                   id="day_{{ $day }}" value="{{ $day }}"
                                                   {{ in_array($day, (array) $selectedDays) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Profile Photo {{ $derm ? '' : '(optional)' }}</label>
                                    <input type="file" name="profile_image" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                    <small class="text-muted">PNG or JPG, max 2MB.</small>
                                </div>
                                @if($derm && $derm->profile_image)
                                    <div class="col-md-6">
                                        <label class="form-label d-block">Current Photo</label>
                                        <img src="{{ asset('storage/' . $derm->profile_image) }}" alt="profile" class="rounded" style="width:64px;height:64px;object-fit:cover;">
                                    </div>
                                @endif
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
