@extends('includes.main')

@section('content')

    <!-- ── HERO ─────────────────────────────────────────── -->
    <section class="auth-hero">
        <div class="container">
            <div class="hero-badge">
                <i class="fas fa-stethoscope"></i>
                For Verified Dermatologists
            </div>
            <h1>Join DermaConnect <em>as a Specialist</em></h1>
            <p>Create your professional profile, manage appointments effortlessly, and connect with patients who need your expertise — all from one trusted platform.</p>
        </div>
    </section>

    <!-- ── REGISTRATION FORM ────────────────────────────── -->
    <section class="auth-section">
        <div class="container">
            <div class="row g-4">

                <!-- ── Sidebar ─────────────────────────────────── -->
                <div class="col-lg-4">
                    <div class="auth-sidebar">
                        <div class="auth-sidebar-card">
                            <h3>Why Join Us?</h3>
                            <p>Build your practice digitally and reach thousands of patients across Pakistan.</p>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-users"></i></div>
                                <div>
                                    <h6>50,000+ Active Patients</h6>
                                    <p>Connect with patients actively searching for trusted dermatological care.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-calendar-check"></i></div>
                                <div>
                                    <h6>Smart Scheduling</h6>
                                    <p>Manage appointments, availability, and patient records in one dashboard.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-shield-halved"></i></div>
                                <div>
                                    <h6>Verified Badge</h6>
                                    <p>Get a verified professional badge that builds patient trust instantly.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-chart-line"></i></div>
                                <div>
                                    <h6>Practice Analytics</h6>
                                    <p>Track consultations, revenue, and patient feedback with real-time insights.</p>
                                </div>
                            </div>

                            <div class="auth-sidebar-footer">
                                Already have an account?<br>
                                <a href="{{ route('login') }}">Sign in to your dashboard <i class="fas fa-arrow-right ms-1" style="font-size:.75rem"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── Form Card ───────────────────────────────── -->
                <div class="col-lg-8">
                    <div class="auth-card">

                        <div class="auth-card-header">
                            <h2>Create Your Professional Account</h2>
                            <p>Fill in your details below. Your application will be reviewed within 24–48 hours.</p>
                        </div>

                        {{-- AJAX response alert --}}
                        <div id="formAlert" class="alert" style="display:none;"></div>

                        <form action="{{ route('store.dermatologist') }}" method="POST" enctype="multipart/form-data" id="dermatologistRegisterForm">
                            @csrf

                            <!-- ── Section 1: Account Information ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <div class="form-section-number">1</div>
                                    <div>
                                        <h5>Account Information</h5>
                                        <small>Your login credentials</small>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="name">Full Name <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="text" id="name" name="name" class="form-control-custom" placeholder="Dr. Fatima Khan" value="{{ old('name') }}" required>
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="email">Email Address <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="email" id="email" name="email" class="form-control-custom" placeholder="dr.name@example.com" value="{{ old('email') }}" required>
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="password">Password <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="password" id="password" name="password" class="form-control-custom" placeholder="Create a strong password" required minlength="8">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="input-helper"><i class="fas fa-info-circle"></i>Minimum 8 characters</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-custom" placeholder="Re-enter password" required minlength="8">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── Section 2: Professional Credentials ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <div class="form-section-number">2</div>
                                    <div>
                                        <h5>Professional Credentials</h5>
                                        <small>Your medical qualifications and expertise</small>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="qualification">Qualification <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="text" id="qualification" name="qualification" class="form-control-custom" placeholder="MBBS, FCPS Dermatology" value="{{ old('qualification') }}" required>
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="experience_year">Years of Experience <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <select id="experience_year" name="experience_year" class="form-control-custom" required>
                                                <option value="" disabled {{ old('experience_year') ? '' : 'selected' }}>Select experience</option>
                                                <option value="0-1" {{ old('experience_year') == '0-1' ? 'selected' : '' }}>Less than 1 year</option>
                                                <option value="1-3" {{ old('experience_year') == '1-3' ? 'selected' : '' }}>1 – 3 years</option>
                                                <option value="3-5" {{ old('experience_year') == '3-5' ? 'selected' : '' }}>3 – 5 years</option>
                                                <option value="5-10" {{ old('experience_year') == '5-10' ? 'selected' : '' }}>5 – 10 years</option>
                                                <option value="10-15" {{ old('experience_year') == '10-15' ? 'selected' : '' }}>10 – 15 years</option>
                                                <option value="15+" {{ old('experience_year') == '15+' ? 'selected' : '' }}>15+ years</option>
                                            </select>
                                            <i class="fas fa-briefcase-medical"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="specialization">Specialization <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <select id="specialization" name="specialization" class="form-control-custom" required>
                                                <option value="" disabled {{ old('specialization') ? '' : 'selected' }}>Select specialization</option>
                                                <option value="General Dermatology" {{ old('specialization') == 'General Dermatology' ? 'selected' : '' }}>General Dermatology</option>
                                                <option value="Cosmetic Dermatology" {{ old('specialization') == 'Cosmetic Dermatology' ? 'selected' : '' }}>Cosmetic Dermatology</option>
                                                <option value="Pediatric Dermatology" {{ old('specialization') == 'Pediatric Dermatology' ? 'selected' : '' }}>Pediatric Dermatology</option>
                                                <option value="Dermatopathology" {{ old('specialization') == 'Dermatopathology' ? 'selected' : '' }}>Dermatopathology</option>
                                                <option value="Dermatologic Surgery" {{ old('specialization') == 'Dermatologic Surgery' ? 'selected' : '' }}>Dermatologic Surgery</option>
                                                <option value="Trichology" {{ old('specialization') == 'Trichology' ? 'selected' : '' }}>Trichology (Hair Disorders)</option>
                                                <option value="Aesthetic Medicine" {{ old('specialization') == 'Aesthetic Medicine' ? 'selected' : '' }}>Aesthetic Medicine</option>
                                            </select>
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="phone_number">Phone Number <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="tel" id="phone_number" name="phone_number" class="form-control-custom" placeholder="+92 300 1234567" value="{{ old('phone_number') }}" required>
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── Section 3: Practice Information ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <div class="form-section-number">3</div>
                                    <div>
                                        <h5>Practice Information</h5>
                                        <small>Where patients can find you</small>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="clinic_address">Clinic Address <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="text" id="clinic_address" name="clinic_address" class="form-control-custom" placeholder="123 Main Boulevard, Gulberg III" value="{{ old('clinic_address') }}" required>
                                            <i class="fas fa-location-dot"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="city">City <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <select id="city" name="city" class="form-control-custom" required>
                                                <option value="" disabled {{ old('city') ? '' : 'selected' }}>Select your city</option>
                                                <option value="Lahore" {{ old('city') == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                                                <option value="Karachi" {{ old('city') == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                                                <option value="Islamabad" {{ old('city') == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                                                <option value="Rawalpindi" {{ old('city') == 'Rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                                                <option value="Faisalabad" {{ old('city') == 'Faisalabad' ? 'selected' : '' }}>Faisalabad</option>
                                                <option value="Multan" {{ old('city') == 'Multan' ? 'selected' : '' }}>Multan</option>
                                                <option value="Peshawar" {{ old('city') == 'Peshawar' ? 'selected' : '' }}>Peshawar</option>
                                                <option value="Quetta" {{ old('city') == 'Quetta' ? 'selected' : '' }}>Quetta</option>
                                                <option value="Sialkot" {{ old('city') == 'Sialkot' ? 'selected' : '' }}>Sialkot</option>
                                                <option value="Gujranwala" {{ old('city') == 'Gujranwala' ? 'selected' : '' }}>Gujranwala</option>
                                                <option value="Hyderabad" {{ old('city') == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                                                <option value="Bahawalpur" {{ old('city') == 'Bahawalpur' ? 'selected' : '' }}>Bahawalpur</option>
                                            </select>
                                            <i class="fas fa-city"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom">Availability Days <span class="required">*</span></label>
                                        <div class="days-selector">
                                            @php
                                                $days = ['Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday'];
                                                $selectedDays = old('availability_days', []);
                                            @endphp
                                            @foreach($days as $short => $full)
                                                <label class="day-chip">
                                                    <input type="checkbox" name="availability_days[]" value="{{ $full }}" {{ in_array($full, (array)$selectedDays) ? 'checked' : '' }}>
                                                    <span>{{ $short }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="input-helper"><i class="fas fa-info-circle"></i>Select all days you'll be available for consultations</div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── Section 4: Profile Photo ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <div class="form-section-number">4</div>
                                    <div>
                                        <h5>Profile Photo</h5>
                                        <small>A professional photo helps build patient trust</small>
                                    </div>
                                </div>

                                <div class="file-upload-wrapper" id="fileUploadWrapper">
                                    <input type="file" id="profile_image" name="profile_image" accept="image/png,image/jpeg,image/jpg" required>
                                    <div class="file-upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                    <div class="file-upload-text">
                                        <strong>Click to upload your profile photo</strong>
                                        <span>PNG or JPG, maximum 2MB. Recommended: 400×400px</span>
                                    </div>
                                </div>
                                <div class="file-preview" id="filePreview">
                                    <img src="" alt="Preview" id="previewImage">
                                    <span class="file-name" id="fileName"></span>
                                    <button type="button" class="btn btn-sm btn-link text-danger" id="removeFile" style="text-decoration:none">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- ── Terms ─── -->
                            <div class="terms-row">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">
                                    I confirm that all the information provided is accurate and I agree to DermaConnect's <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a>, and <a href="#">Professional Code of Conduct</a>.
                                </label>
                            </div>

                            <!-- ── Submit ─── -->
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-user-md"></i>
                                Submit Application for Review
                            </button>

                            <p class="auth-footer-note">
                                Already registered? <a href="{{ route('login') }}">Sign in to your account</a>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // ── File Upload Preview ─────────────────────────────
                const fileInput  = document.getElementById('profile_image');
                const wrapper    = document.getElementById('fileUploadWrapper');
                const preview    = document.getElementById('filePreview');
                const previewImg = document.getElementById('previewImage');
                const fileName   = document.getElementById('fileName');
                const removeBtn  = document.getElementById('removeFile');

                if (fileInput) {

                    fileInput.addEventListener('change', function (e) {

                        const file = e.target.files[0];

                        if (!file) return;

                        // File size validation (2MB)
                        if (file.size > 2 * 1024 * 1024) {

                            Swal.fire({
                                icon: 'error',
                                title: 'File Too Large',
                                text: 'Profile image must be less than 2MB.'
                            });

                            fileInput.value = '';
                            return;
                        }

                        const reader = new FileReader();

                        reader.onload = function (ev) {

                            previewImg.src = ev.target.result;
                            fileName.textContent = file.name;

                            wrapper.style.display = 'none';
                            preview.style.display = 'flex';
                        };

                        reader.readAsDataURL(file);
                    });

                    removeBtn.addEventListener('click', function () {

                        fileInput.value = '';

                        preview.style.display = 'none';
                        wrapper.style.display = 'block';
                    });
                }

                // ── AJAX Form Submission ────────────────────────────
                const form = document.getElementById('dermatologistRegisterForm');

                if (!form) {
                    console.error('Form not found');
                    return;
                }

                const password       = document.getElementById('password');
                const confirmInput   = document.getElementById('password_confirmation');
                const alertBox       = document.getElementById('formAlert');
                const submitBtn      = form.querySelector('.btn-submit');
                const originalBtnHtml = submitBtn.innerHTML;

                // Clear validation errors
                function clearErrors() {

                    document.querySelectorAll('.ajax-error').forEach(el => el.remove());

                    document.querySelectorAll('.is-invalid').forEach(el => {
                        el.classList.remove('is-invalid');
                    });

                    alertBox.style.display = 'none';
                    alertBox.innerHTML = '';
                }

                // Show validation errors
                function showErrors(errors) {

                    Object.keys(errors).forEach(field => {

                        const input =
                            form.querySelector(`[name="${field}"]`) ||
                            form.querySelector(`[name="${field}[]"]`);

                        if (!input) return;

                        input.classList.add('is-invalid');

                        const error = document.createElement('div');
                        error.className = 'text-danger ajax-error mt-1';
                        error.innerText = errors[field][0];

                        input.parentElement.appendChild(error);
                    });
                }

                // Alert box
                function showAlert(type, message) {

                    alertBox.className = `alert alert-${type}`;
                    alertBox.innerHTML = message;
                    alertBox.style.display = 'block';
                }

                // Submit Form
                form.addEventListener('submit', async function (e) {

                    e.preventDefault();

                    clearErrors();

                    // Password validation
                    if (password.value !== confirmInput.value) {

                        showErrors({
                            password_confirmation: ['Passwords do not match']
                        });

                        return;
                    }

                    // Disable button
                    submitBtn.disabled = true;

                    submitBtn.innerHTML =
                        '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                    try {

                        const formData = new FormData(form);

                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        let data = {};

                        try {
                            data = await response.json();
                        } catch (jsonError) {
                            console.error('Invalid JSON response');
                        }

                        // Validation errors
                        if (response.status === 422) {

                            showErrors(data.errors || {});

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please fix the highlighted fields and try again.'
                            });

                        }

                        // Success
                        else if (response.ok) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Application Submitted!',
                                text: 'Thank you for registering with DermaConnect. Your dermatologist profile has been submitted successfully and is now under admin review.',
                                confirmButtonText: 'Okay',
                                confirmButtonColor: '#3085d6',
                                allowOutsideClick: false
                            }).then((result) => {

                                if (result.isConfirmed && data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            });

                            form.reset();

                            preview.style.display = 'none';
                            wrapper.style.display = 'block';

                        }

                        // Other errors
                        else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Something Went Wrong',
                                text: data.message || 'Please try again later.'
                            });
                        }

                    } catch (error) {

                        console.error(error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'Please check your internet connection and try again.'
                        });

                    } finally {

                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnHtml;
                    }
                });

            });
        </script>

    @endpush

@endsection
