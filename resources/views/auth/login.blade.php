@extends('includes.main')

<style>
    /* ── LOGIN PAGE ─────────────────────────────────── */

    .login-section {
      min-height: calc(100vh - 80px);
      padding: 60px 0;
      background: var(--off-white);
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .login-section::before {
      content: '';
      position: absolute;
      top: -200px;
      right: -200px;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, var(--soft-blue) 0%, transparent 70%);
      border-radius: 50%;
      opacity: .6;
    }

    .login-section::after {
      content: '';
      position: absolute;
      bottom: -200px;
      left: -200px;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, var(--soft-blue) 0%, transparent 70%);
      border-radius: 50%;
      opacity: .5;
    }

    .login-card {
      background: var(--white);
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 32px 80px rgba(21,101,192,.12);
      border: 1px solid var(--border);
      position: relative;
      z-index: 2;
    }

    /* Left promo panel */
    .login-promo {
      background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary) 50%, var(--accent-blue) 100%);
      padding: 60px 50px;
      color: #fff;
      position: relative;
      overflow: hidden;
      height: 100%;
      min-height: 600px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .login-promo::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 20% 30%, rgba(255,255,255,.12) 0%, transparent 45%),
        radial-gradient(circle at 80% 70%, rgba(255,255,255,.08) 0%, transparent 45%);
    }

    .login-promo-top {
      position: relative;
    }

    .login-promo-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: rgba(255,255,255,.18);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.25);
      color: #fff;
      font-size: .82rem;
      font-weight: 600;
      letter-spacing: .5px;
      padding: 8px 16px;
      border-radius: 50px;
      margin-bottom: 28px;
    }

    .login-promo-badge i { font-size: .75rem; color: var(--mid-blue); }

    .login-promo h2 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 3vw, 2.4rem);
      color: #fff;
      line-height: 1.2;
      margin-bottom: 16px;
    }

    .login-promo h2 em {
      font-style: normal;
      color: var(--mid-blue);
    }

    .login-promo > p {
      color: rgba(255,255,255,.85);
      font-size: 1rem;
      line-height: 1.7;
      margin-bottom: 36px;
      max-width: 380px;
      position: relative;
    }

    .login-features {
      position: relative;
      margin-bottom: 40px;
    }

    .login-feature {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 18px;
    }

    .login-feature-icon {
      width: 38px;
      height: 38px;
      border-radius: 12px;
      background: rgba(255,255,255,.18);
      backdrop-filter: blur(6px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      flex-shrink: 0;
      font-size: .85rem;
    }

    .login-feature-text {
      color: rgba(255,255,255,.92);
      font-size: .92rem;
      line-height: 1.5;
      padding-top: 8px;
    }

    .login-promo-bottom {
      position: relative;
      padding-top: 28px;
      border-top: 1px solid rgba(255,255,255,.15);
    }

    .login-testimonial {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .login-testimonial-avatars {
      display: flex;
    }

    .login-testimonial-avatars img {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      border: 2px solid var(--primary);
      margin-left: -10px;
      object-fit: cover;
    }

    .login-testimonial-avatars img:first-child { margin-left: 0; }

    .login-testimonial-text strong {
      display: block;
      font-size: .92rem;
      color: #fff;
      font-weight: 600;
      margin-bottom: 2px;
    }

    .login-testimonial-text span {
      font-size: .8rem;
      color: rgba(255,255,255,.7);
    }

    .login-testimonial-text i {
      color: #FFB300;
      font-size: .72rem;
    }

    /* Right form panel */
    .login-form-wrapper {
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
    }

    .login-form-header {
      margin-bottom: 36px;
    }

    .login-form-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .login-form-header p {
      color: var(--text-light);
      font-size: .95rem;
      margin: 0;
    }

    .login-form-header p a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .login-form-header p a:hover { text-decoration: underline; }

    .login-form-label {
      font-size: .85rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
      display: block;
    }

    .login-form-input {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 12px;
      padding: 14px 16px 14px 46px;
      font-size: .94rem;
      color: var(--text-dark);
      background: var(--white);
      font-family: 'DM Sans', sans-serif;
      transition: all .25s ease;
    }

    .login-form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(21,101,192,.1);
    }

    .login-form-input::placeholder { color: var(--text-light); }

    .login-input-wrapper {
      position: relative;
      margin-bottom: 22px;
    }

    .login-input-wrapper > i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: .92rem;
      pointer-events: none;
      transition: color .25s ease;
    }

    .login-input-wrapper:focus-within > i { color: var(--primary); }

    .password-toggle {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-light);
      font-size: .9rem;
      cursor: pointer;
      padding: 6px 8px;
      border-radius: 6px;
      transition: all .25s ease;
    }

    .password-toggle:hover {
      color: var(--primary);
      background: var(--soft-blue);
    }

    .login-options-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .remember-check {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .remember-check input {
      width: 18px;
      height: 18px;
      accent-color: var(--primary);
      cursor: pointer;
    }

    .remember-check label {
      font-size: .87rem;
      color: var(--text-mid);
      cursor: pointer;
      margin: 0;
    }

    .forgot-link {
      font-size: .87rem;
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
      transition: color .2s;
    }

    .forgot-link:hover { color: var(--primary-dark); }

    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, var(--primary), var(--accent-blue));
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      padding: 15px 32px;
      border-radius: 50px;
      border: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      transition: all .3s ease;
      box-shadow: 0 10px 32px rgba(21,101,192,.3);
      cursor: pointer;
      margin-bottom: 26px;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 16px 42px rgba(21,101,192,.4);
    }

    .btn-login:active { transform: translateY(0); }

    .btn-login i { transition: transform .25s ease; }
    .btn-login:hover i { transform: translateX(4px); }

    .login-divider {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 22px;
      color: var(--text-light);
      font-size: .8rem;
    }

    .login-divider::before,
    .login-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .social-login-row {
      display: flex;
      gap: 12px;
      margin-bottom: 32px;
    }

    .btn-social {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 13px 18px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      background: var(--white);
      color: var(--text-dark);
      font-size: .88rem;
      font-weight: 500;
      text-decoration: none;
      transition: all .25s ease;
      cursor: pointer;
    }

    .btn-social:hover {
      border-color: var(--accent-blue);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(21,101,192,.08);
      color: var(--text-dark);
    }

    .btn-social img {
      width: 18px;
      height: 18px;
    }

    .btn-social i {
      font-size: 1.1rem;
    }

    .btn-social .fa-facebook-f { color: #1877F2; }
    .btn-social .fa-apple { color: #000; }

    .signup-prompt {
      text-align: center;
      padding: 22px;
      background: var(--soft-blue);
      border-radius: 14px;
      font-size: .9rem;
      color: var(--text-mid);
    }

    .signup-prompt strong {
      display: block;
      color: var(--text-dark);
      font-weight: 600;
      margin-bottom: 12px;
      font-size: .95rem;
    }

    .signup-options {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .signup-option {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      border-radius: 50px;
      background: var(--white);
      color: var(--primary);
      font-weight: 600;
      font-size: .85rem;
      text-decoration: none;
      transition: all .25s ease;
      border: 1.5px solid transparent;
    }

    .signup-option:hover {
      transform: translateY(-2px);
      border-color: var(--primary);
      color: var(--primary);
      box-shadow: 0 6px 16px rgba(21,101,192,.15);
    }

    .signup-option i { font-size: .8rem; }

    @media (max-width: 991px) {
      .login-promo {
        min-height: auto;
        padding: 44px 36px;
      }
      .login-form-wrapper { padding: 44px 36px; }
    }

    @media (max-width: 576px) {
      .login-section { padding: 30px 0; }
      .login-promo, .login-form-wrapper { padding: 36px 24px; }
      .login-form-header h2 { font-size: 1.6rem; }
      .social-login-row { flex-direction: column; }
      .signup-options { flex-direction: column; }
    }
</style>

@section('content')

<section class="login-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <div class="login-card">
          <div class="row g-0">

            <!-- ── Left Promo Panel ──────────────────── -->
            <div class="col-lg-5">
              <div class="login-promo">

                <div class="login-promo-top">
                  <div class="login-promo-badge">
                    <i class="fas fa-shield-halved"></i>
                    Secure & HIPAA Compliant
                  </div>
                  <h2>Welcome Back to Your <em>Skin Health Journey</em></h2>
                  <p>Sign in to manage appointments, view treatment plans, and stay connected with Pakistan's top dermatologists.</p>

                  <div class="login-features">
                    <div class="login-feature">
                      <div class="login-feature-icon"><i class="fas fa-calendar-check"></i></div>
                      <div class="login-feature-text">Manage all your appointments in one place</div>
                    </div>
                    <div class="login-feature">
                      <div class="login-feature-icon"><i class="fas fa-file-medical"></i></div>
                      <div class="login-feature-text">Access prescriptions and treatment history</div>
                    </div>
                    <div class="login-feature">
                      <div class="login-feature-icon"><i class="fas fa-message"></i></div>
                      <div class="login-feature-text">Message your dermatologist directly</div>
                    </div>
                  </div>
                </div>

                <div class="login-promo-bottom">
                  <div class="login-testimonial">
                    <div class="login-testimonial-avatars">
                      <img src="https://i.pravatar.cc/100?img=47" alt="Patient">
                      <img src="https://i.pravatar.cc/100?img=12" alt="Patient">
                      <img src="https://i.pravatar.cc/100?img=32" alt="Patient">
                      <img src="https://i.pravatar.cc/100?img=54" alt="Patient">
                    </div>
                    <div class="login-testimonial-text">
                      <strong>Trusted by 50,000+ patients</strong>
                      <span>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        4.9/5 average rating
                      </span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- ── Right Form Panel ──────────────────── -->
            <div class="col-lg-7">
              <div class="login-form-wrapper">

                <div class="login-form-header">
                  <h2>Sign In to DermaConnect</h2>
                  <p>Enter your credentials to access your account.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                  @csrf

                  <label class="login-form-label" for="email">Email Address</label>
                  <div class="login-input-wrapper">
                    <input type="email" id="email" name="email" class="login-form-input" placeholder="you@example.com" required autocomplete="email">
                    <i class="fas fa-envelope"></i>
                  </div>

                  <label class="login-form-label" for="password">Password</label>
                  <div class="login-input-wrapper">
                    <input type="password" id="password" name="password" class="login-form-input" placeholder="Enter your password" required autocomplete="current-password">
                    <i class="fas fa-lock"></i>
                    <button type="button" class="password-toggle" id="togglePassword" aria-label="Show password">
                      <i class="far fa-eye"></i>
                    </button>
                  </div>

                  <div class="login-options-row">
                    <div class="remember-check">
                      <input type="checkbox" id="remember" name="remember">
                      <label for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                  </div>

                  <button type="submit" class="btn-login">
                    Sign In <i class="fas fa-arrow-right"></i>
                  </button>

                  <div class="signup-prompt">
                    <strong>New to DermaConnect?</strong>
                    <div class="signup-options">
                      <a href="{{ route('register') }}" class="signup-option">
                        <i class="fas fa-user"></i> Sign up as Patient
                      </a>
                      <a href="{{ route('register.dermatologist') }}" class="signup-option">
                        <i class="fas fa-stethoscope"></i> Sign up as Dermatologist
                      </a>
                    </div>
                  </div>

                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  // Password show/hide toggle
  (function() {
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const icon = toggle.querySelector('i');

    toggle.addEventListener('click', function() {
      const isPassword = password.type === 'password';
      password.type = isPassword ? 'text' : 'password';
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
      toggle.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
    });
  })();
</script>
@endpush

@endsection