@extends('admin.include.main')
@section('content')
<div class="container p-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Dermatologist</h5>
            <a href="{{ route('dermatologist.index') }}" class="btn btn-secondary btn-sm">
                <i class="icon-base bx bx-arrow-back me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('dermatologist.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h6 class="text-primary mb-3">Account details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <h6 class="text-primary mb-3 mt-2">Professional details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qualification" class="form-label">Qualification <span class="text-danger">*</span></label>
                        <input type="text" name="qualification" id="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}" placeholder="e.g. MBBS, FCPS (Dermatology)" required>
                        @error('qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="experience_year" class="form-label">Experience <span class="text-danger">*</span></label>
                        <select name="experience_year" id="experience_year" class="form-select @error('experience_year') is-invalid @enderror" required>
                            <option value="" disabled {{ old('experience_year') ? '' : 'selected' }}>Select experience</option>
                            @foreach(['0-1' => 'Less than 1 year', '1-3' => '1 – 3 years', '3-5' => '3 – 5 years', '5-10' => '5 – 10 years', '10-15' => '10 – 15 years', '15+' => '15+ years'] as $val => $label)
                                <option value="{{ $val }}" {{ old('experience_year') == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('experience_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="specialization" class="form-label">Specialization <span class="text-danger">*</span></label>
                        <select name="specialization" id="specialization" class="form-select @error('specialization') is-invalid @enderror" required>
                            <option value="" disabled {{ old('specialization') ? '' : 'selected' }}>Select specialization</option>
                            @foreach(['General Dermatology', 'Cosmetic Dermatology', 'Pediatric Dermatology', 'Dermatopathology', 'Dermatologic Surgery', 'Trichology', 'Aesthetic Medicine'] as $spec)
                                <option value="{{ $spec }}" {{ old('specialization') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                            @endforeach
                        </select>
                        @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required>
                        @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <select name="city" id="city" class="form-select @error('city') is-invalid @enderror" required>
                            <option value="" disabled {{ old('city') ? '' : 'selected' }}>Select city</option>
                            @foreach(['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Sialkot', 'Gujranwala', 'Hyderabad', 'Bahawalpur'] as $c)
                                <option value="{{ $c }}" {{ old('city') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="consultation_fee" class="form-label">Consultation Fee (Rs)</label>
                        <input type="number" name="consultation_fee" id="consultation_fee" min="0"
                               class="form-control @error('consultation_fee') is-invalid @enderror"
                               value="{{ old('consultation_fee') }}" placeholder="e.g. 1500">
                        @error('consultation_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="approved" {{ old('status', 'approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="clinic_address" class="form-label">Clinic Address <span class="text-danger">*</span></label>
                        <textarea name="clinic_address" id="clinic_address" rows="2" class="form-control @error('clinic_address') is-invalid @enderror" required>{{ old('clinic_address') }}</textarea>
                        @error('clinic_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Availability Days <span class="text-danger">*</span></label>
                        @php $selectedDays = old('availability_days', []); @endphp
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="availability_days[]" value="{{ $day }}" id="day_{{ $day }}" {{ in_array($day, (array) $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                            </div>
                        @endforeach
                        @error('availability_days')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="profile_image" class="form-label">Profile Image <span class="text-danger">*</span></label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/png,image/jpg,image/jpeg" required>
                        @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Dermatologist</button>
            </form>
        </div>
    </div>
</div>
@endsection
