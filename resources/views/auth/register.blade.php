@extends('includes.main')

@section('content')

    @include('includes.password-toggle')

    <!-- ── HERO ─────────────────────────────────────────── -->
    <section class="auth-hero">
        <div class="container">
            <div class="hero-badge">
                <i class="fas fa-heart-pulse"></i>
                Join 50,000+ Patients Across Pakistan
            </div>
            <h1>Your Skin Health <em>Journey Starts Here</em></h1>
            <p>Create your free account to book consultations, track treatments, and connect with board-certified dermatologists — all in one secure place.</p>
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
                            <h3>Why DermaConnect?</h3>
                            <p>Get expert dermatology care from anywhere in Pakistan, without the wait.</p>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-user-doctor"></i></div>
                                <div>
                                    <h6>Verified Specialists</h6>
                                    <p>Every dermatologist is board-certified and reviewed by our medical team.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-bolt"></i></div>
                                <div>
                                    <h6>Same-Day Bookings</h6>
                                    <p>Skip the waiting room — find available slots and book in minutes.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-notes-medical"></i></div>
                                <div>
                                    <h6>Personalised Care Plans</h6>
                                    <p>Get treatment tailored to your skin type, condition, and lifestyle.</p>
                                </div>
                            </div>

                            <div class="auth-benefit">
                                <div class="auth-benefit-icon"><i class="fas fa-lock"></i></div>
                                <div>
                                    <h6>Private & Secure</h6>
                                    <p>Your medical history and personal data are encrypted and confidential.</p>
                                </div>
                            </div>

                            <div class="trust-strip">
                                <div class="trust-stat">
                                    <strong>200+</strong>
                                    <span>Specialists</span>
                                </div>
                                <div class="trust-stat">
                                    <strong>50k+</strong>
                                    <span>Patients</span>
                                </div>
                                <div class="trust-stat">
                                    <strong>98%</strong>
                                    <span>Satisfaction</span>
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
                            <h2>Create Your Patient Account</h2>
                            <p>It only takes a minute. Your information is secure and never shared without your consent.</p>
                        </div>

                        {{-- ── General Error Banner (top of form) ── --}}
                        @if ($errors->any())
                            <div class="alert-validation">
                                <div class="alert-validation-icon">
                                    <i class="fas fa-circle-exclamation"></i>
                                </div>
                                <div class="alert-validation-content">
                                    <strong>Please fix the following {{ $errors->count() > 1 ? 'errors' : 'error' }}:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{-- ── Session Status Message (success/info) ── --}}
                        @if (session('status'))
                            <div class="alert-status">
                                <i class="fas fa-circle-info"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Switch role banner -->
                        <div class="switch-role">
                            <i class="fas fa-stethoscope me-2" style="color:var(--primary)"></i>
                            Are you a dermatologist?
                            <a href="{{ route('register.dermatologist') }}">Register here instead <i class="fas fa-arrow-right ms-1" style="font-size:.7rem"></i></a>
                        </div>

                        <form action="{{ route('store.patient') }}" method="POST" id="patientRegisterForm" enctype="multipart/form-data" novalidate>
                            @csrf

                            <!-- ── Section 1: Account Information ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                
                                    <div>
                                        <h5>Account Information</h5>
                                        
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="name">Full Name</label>
                                        <div class="input-with-icon">
                                            <input type="text" id="name" name="name"
                                                   class="form-control-custom @error('name') is-invalid @enderror"
                                                   placeholder="Enter name"
                                                   value="{{ old('name') }}" required>
                                        </div>
                                        @error('name')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="email">Email Address</label>
                                        <div class="input-with-icon">
                                            <input type="email" id="email" name="email"
                                                   class="form-control-custom @error('email') is-invalid @enderror"
                                                   placeholder="Enter email"
                                                   value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="password">Password</label>
                                        <div class="input-with-icon">
                                            <input type="password" id="password" name="password"
                                                   class="form-control-custom has-eye @error('password') is-invalid @enderror"
                                                   placeholder="Create a strong password" required minlength="8">
                                            <button type="button" class="pw-eye" data-target="password" aria-label="Show password">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="input-helper"><i class="fas fa-info-circle"></i>Minimum 8 characters</div>
                                        @error('password')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="password_confirmation">Confirm Password</label>
                                        <div class="input-with-icon">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   class="form-control-custom has-eye @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="Re-enter password" required minlength="8">
                                            <button type="button" class="pw-eye" data-target="password_confirmation" aria-label="Show password">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ── Section 2: Personal Details ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                
                                    <div>
                                        <h5>Personal Details</h5>
                                         
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="phone_number">Phone Number </label>
                                        <div class="input-with-icon">
                                            <input type="tel" id="phone_number" name="phone_number"
                                                   class="form-control-custom @error('phone_number') is-invalid @enderror"
                                                   placeholder="Enter phone number"
                                                   value="{{ old('phone_number') }}" required>
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        @error('phone_number')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-custom" for="age">Age  </label>
                                        <div class="input-with-icon">
                                            <input type="number" id="age" name="age"
                                                   class="form-control-custom @error('age') is-invalid @enderror"
                                                   placeholder="Enter age" min="1" max="120"
                                                   value="{{ old('age') }}" required>
                                            <i class="fas fa-cake-candles"></i>
                                        </div>
                                        @error('age')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom">Gender  </label>
                                        <div class="chip-group @error('gender') is-invalid @enderror">
                                            <label class="chip-option">
                                                <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                                                <span><i class="fas fa-mars"></i> Male</span>
                                            </label>
                                            <label class="chip-option">
                                                <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                                <span><i class="fas fa-venus"></i> Female</span>
                                            </label>
                                            <label class="chip-option">
                                                <input type="radio" name="gender" value="Other" {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                                <span><i class="fas fa-genderless"></i> Other</span>
                                            </label>
                                             
                                        </div>
                                        @error('gender')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="profile_image">Profile Photo <span class="optional">(optional)</span></label>
                                        <input type="file" id="profile_image" name="profile_image"
                                               class="form-control-custom @error('profile_image') is-invalid @enderror"
                                               accept="image/png,image/jpeg,image/jpg">
                                        <div class="input-helper"><i class="fas fa-info-circle"></i>JPG or PNG, up to 2&nbsp;MB. This appears on your profile.</div>
                                        <div id="patientImagePreview" class="mt-2"></div>
                                        @error('profile_image')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label-custom" for="address">Address <span class="optional">(optional)</span></label>
                                        <textarea id="address" name="address"
                                                  class="form-control-custom @error('address') is-invalid @enderror"
                                                  placeholder="House #, Street, Area, City, Province" rows="3">{{ old('address') }}</textarea>
                                        <div class="input-helper"><i class="fas fa-info-circle"></i>Useful for in-clinic appointment recommendations near you</div>
                                        @error('address')
                                        <div class="input-error">
                                            <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ── Section 3: Skin Profile ─── -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    
                                    <div>
                                        <h5>Your Skin Profile</h5>
                                        
                                    </div>
                                </div>

                                <label class="form-label-custom">Skin Type <span class="optional">(you can update this later)</span></label>
                                <div class="skin-type-grid @error('skin_type') is-invalid @enderror">
                                    @php
                                        $skinTypes = [
                                          ['value' => 'Normal',      'icon' => 'fa-face-smile',      'desc' => 'Balanced, rarely problematic'],
                                          ['value' => 'Oily',        'icon' => 'fa-droplet',         'desc' => 'Shiny, prone to breakouts'],
                                          ['value' => 'Dry',         'icon' => 'fa-sun',             'desc' => 'Tight, flaky, dull'],
                                          ['value' => 'Combination', 'icon' => 'fa-circle-half-stroke', 'desc' => 'Oily T-zone, dry cheeks'],
                                          ['value' => 'Sensitive',   'icon' => 'fa-shield-heart',    'desc' => 'Easily irritated, reactive'],
                                          ['value' => 'Not sure',    'icon' => 'fa-circle-question', 'desc' => "I'd like a doctor to assess"],
                                        ];
                                    @endphp
                                    @foreach($skinTypes as $type)
                                        <label class="skin-card">
                                            <input type="radio" name="skin_type" value="{{ $type['value'] }}" {{ old('skin_type') == $type['value'] ? 'checked' : '' }}>
                                            <div class="skin-card-content">
                                                <i class="fas {{ $type['icon'] }}"></i>
                                                <strong>{{ $type['value'] }}</strong>
                                                <small>{{ $type['desc'] }}</small>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('skin_type')
                                <div class="input-error mt-2">
                                    <i class="fas fa-circle-exclamation"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- ── Terms ─── -->
                            <div class="terms-row @error('terms') is-invalid @enderror">
                                <input type="checkbox" id="terms" name="terms" value="1"
                                       {{ old('terms') ? 'checked' : '' }} required>
                                <label for="terms">
                                    I agree to DermaConnect's <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a>, and consent to the secure storage of my health information for the purpose of providing dermatology care.
                                </label>
                            </div>
                            @error('terms')
                            <div class="input-error">
                                <i class="fas fa-circle-exclamation"></i>{{ $message }}
                            </div>
                            @enderror

                            <!-- ── Submit ─── -->
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-user-plus"></i>
                                Create My Account
                            </button>

                            <p class="auth-footer-note">
                                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Password match validation
            (function() {
                const password = document.getElementById('password');
                const confirm  = document.getElementById('password_confirmation');
                const form     = document.getElementById('patientRegisterForm');

                form.addEventListener('submit', function(e) {
                    if (password.value !== confirm.value) {
                        e.preventDefault();
                        alert('Passwords do not match. Please re-enter.');
                        confirm.focus();
                    }
                });

                // Scroll to first error on page load
                const firstError = document.querySelector('.input-error, .alert-validation');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                // Profile photo thumbnail preview
                const imgInput = document.getElementById('profile_image');
                const imgPreview = document.getElementById('patientImagePreview');
                if (imgInput && imgPreview) {
                    imgInput.addEventListener('change', function () {
                        imgPreview.innerHTML = '';
                        const file = imgInput.files[0];
                        if (file && file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.style.cssText = 'width:90px;height:90px;object-fit:cover;border-radius:10px;border:1px solid #e5e7eb;';
                            img.onload = () => URL.revokeObjectURL(img.src);
                            imgPreview.appendChild(img);
                        }
                    });
                }
            })();
        </script>
    @endpush

@endsection
