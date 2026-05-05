@extends('includes.main')

@section('content')

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

          <!-- Switch role banner -->
          <div class="switch-role">
            <i class="fas fa-stethoscope me-2" style="color:var(--primary)"></i>
            Are you a dermatologist?
            <a href="{{ route('register.dermatologist') }}">Register here instead <i class="fas fa-arrow-right ms-1" style="font-size:.7rem"></i></a>
          </div>

          <form action="" method="POST" id="patientRegisterForm">
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
                    <input type="text" id="name" name="name" class="form-control-custom" placeholder="Ayesha Malik" value="{{ old('name') }}" required>
                    <i class="fas fa-user"></i>
                  </div>
                  @error('name')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label-custom" for="email">Email Address <span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="email" id="email" name="email" class="form-control-custom" placeholder="you@example.com" value="{{ old('email') }}" required>
                    <i class="fas fa-envelope"></i>
                  </div>
                  @error('email')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label-custom" for="password">Password <span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="password" id="password" name="password" class="form-control-custom" placeholder="Create a strong password" required minlength="8">
                    <i class="fas fa-lock"></i>
                  </div>
                  <div class="input-helper"><i class="fas fa-info-circle"></i>Minimum 8 characters</div>
                  @error('password')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
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

            <!-- ── Section 2: Personal Details ─── -->
            <div class="form-section">
              <div class="form-section-title">
                <div class="form-section-number">2</div>
                <div>
                  <h5>Personal Details</h5>
                  <small>Helps us personalise your experience</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label-custom" for="phone_number">Phone Number <span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="tel" id="phone_number" name="phone_number" class="form-control-custom" placeholder="+92 300 1234567" value="{{ old('phone_number') }}" required>
                    <i class="fas fa-phone"></i>
                  </div>
                  @error('phone_number')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label-custom" for="age">Age <span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="number" id="age" name="age" class="form-control-custom" placeholder="28" min="1" max="120" value="{{ old('age') }}" required>
                    <i class="fas fa-cake-candles"></i>
                  </div>
                  @error('age')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label-custom">Gender <span class="required">*</span></label>
                  <div class="chip-group">
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
                    <label class="chip-option">
                      <input type="radio" name="gender" value="Prefer not to say" {{ old('gender') == 'Prefer not to say' ? 'checked' : '' }}>
                      <span><i class="fas fa-user-shield"></i> Prefer not to say</span>
                    </label>
                  </div>
                  @error('gender')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label-custom" for="address">Address <span class="optional">(optional)</span></label>
                  <textarea id="address" name="address" class="form-control-custom" placeholder="House #, Street, Area, City, Province" rows="3">{{ old('address') }}</textarea>
                  <div class="input-helper"><i class="fas fa-info-circle"></i>Useful for in-clinic appointment recommendations near you</div>
                  @error('address')<div class="input-error"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
              </div>
            </div>

            <!-- ── Section 3: Skin Profile ─── -->
            <div class="form-section">
              <div class="form-section-title">
                <div class="form-section-number">3</div>
                <div>
                  <h5>Your Skin Profile</h5>
                  <small>Helps doctors give you better, faster recommendations</small>
                </div>
              </div>

              <label class="form-label-custom">Skin Type <span class="optional">(you can update this later)</span></label>
              <div class="skin-type-grid">
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
              @error('skin_type')<div class="input-error mt-2"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
            </div>

            <!-- ── Terms ─── -->
            <div class="terms-row">
              <input type="checkbox" id="terms" name="terms" required>
              <label for="terms">
                I agree to DermaConnect's <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a>, and consent to the secure storage of my health information for the purpose of providing dermatology care.
              </label>
            </div>

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
  })();
</script>
@endpush

@endsection