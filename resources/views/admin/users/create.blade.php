@extends('admin.include.main')
@section('content')

<div class="container p-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Roles</label>
                    <div class="border p-3 rounded">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input role-checkbox" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" data-role-name="{{ $role->name }}" {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ===== PATIENT PROFILE FIELDS (shown only when the "patient" role is selected) ===== --}}
                <div id="patientFields" class="border rounded p-3 mb-3" style="display:none;">
                    <h6 class="text-primary mb-3">Patient details</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                            @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" min="1" max="120" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}">
                            @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select</option>
                                @foreach(['Male', 'Female', 'Other', 'Prefer not to say'] as $g)
                                    <option value="{{ $g }}" {{ old('gender') == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="skin_type" class="form-label">Skin Type</label>
                            <select name="skin_type" id="skin_type" class="form-select @error('skin_type') is-invalid @enderror">
                                <option value="">Select (optional)</option>
                                @foreach(['Normal', 'Oily', 'Dry', 'Combination', 'Sensitive', 'Not sure'] as $st)
                                    <option value="{{ $st }}" {{ old('skin_type') == $st ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            </select>
                            @error('skin_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-1">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- ===== DERMATOLOGIST PROFILE FIELDS (shown only when the "dermatologist" role is selected) ===== --}}
                <div id="dermatologistFields" class="border rounded p-3 mb-3" style="display:none;">
                    <h6 class="text-primary mb-3">Dermatologist details</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input type="text" name="qualification" id="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}" placeholder="e.g. MBBS, FCPS (Dermatology)">
                            @error('qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="experience_year" class="form-label">Experience</label>
                            <select name="experience_year" id="experience_year" class="form-select @error('experience_year') is-invalid @enderror">
                                <option value="" disabled {{ old('experience_year') ? '' : 'selected' }}>Select experience</option>
                                @foreach(['0-1' => 'Less than 1 year', '1-3' => '1 – 3 years', '3-5' => '3 – 5 years', '5-10' => '5 – 10 years', '10-15' => '10 – 15 years', '15+' => '15+ years'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('experience_year') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('experience_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="specialization" class="form-label">Specialization</label>
                            <select name="specialization" id="specialization" class="form-select @error('specialization') is-invalid @enderror">
                                <option value="" disabled {{ old('specialization') ? '' : 'selected' }}>Select specialization</option>
                                @foreach(['General Dermatology', 'Cosmetic Dermatology', 'Pediatric Dermatology', 'Dermatopathology', 'Dermatologic Surgery', 'Trichology', 'Aesthetic Medicine'] as $spec)
                                    <option value="{{ $spec }}" {{ old('specialization') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                                @endforeach
                            </select>
                            @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="derma_phone_number" class="form-label">Phone Number</label>
                            <input type="text" name="derma_phone_number" id="derma_phone_number" class="form-control @error('derma_phone_number') is-invalid @enderror" value="{{ old('derma_phone_number') }}">
                            @error('derma_phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" class="form-select @error('city') is-invalid @enderror">
                                <option value="" disabled {{ old('city') ? '' : 'selected' }}>Select city</option>
                                @foreach(['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Sialkot', 'Gujranwala', 'Hyderabad', 'Bahawalpur'] as $c)
                                    <option value="{{ $c }}" {{ old('city') == $c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="approved" {{ old('status', 'approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="clinic_address" class="form-label">Clinic Address</label>
                            <textarea name="clinic_address" id="clinic_address" rows="2" class="form-control @error('clinic_address') is-invalid @enderror">{{ old('clinic_address') }}</textarea>
                            @error('clinic_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Availability Days</label>
                            @php $selectedDays = old('availability_days', []); @endphp
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="availability_days[]" value="{{ $day }}" id="udays_{{ $day }}" {{ in_array($day, (array) $selectedDays) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="udays_{{ $day }}">{{ $day }}</label>
                                </div>
                            @endforeach
                            @error('availability_days')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/png,image/jpg,image/jpeg">
                            @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        var checkboxes        = document.querySelectorAll('.role-checkbox');
        var patientFields     = document.getElementById('patientFields');
        var dermatologistFields = document.getElementById('dermatologistFields');

        function isRoleChecked(name) {
            return Array.from(checkboxes).some(function (cb) {
                return cb.checked && cb.dataset.roleName === name;
            });
        }

        function toggleSections() {
            patientFields.style.display       = isRoleChecked('patient') ? 'block' : 'none';
            dermatologistFields.style.display = isRoleChecked('dermatologist') ? 'block' : 'none';
        }

        checkboxes.forEach(function (cb) {
            cb.addEventListener('change', toggleSections);
        });

        // Run once on load so old() input keeps the right sections visible.
        toggleSections();
    })();
</script>

@endsection
