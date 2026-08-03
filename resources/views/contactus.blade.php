@extends('includes.main')

@section('content')
{{-- ===== TOAST NOTIFICATIONS ===== --}}
<div class="toast-container-custom" style="position:fixed; top:20px; right:20px; z-index:9999;">
  @if(session('success'))
    <div class="toast-custom" style="background:#fff; border-left:4px solid #10b981; padding:14px 18px; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.12); margin-bottom:10px;">
      <i class="fas fa-check-circle" style="color:#10b981;"></i>
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="toast-custom" style="background:#fff; border-left:4px solid #ef4444; padding:14px 18px; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.12); margin-bottom:10px;">
      <i class="fas fa-times-circle" style="color:#ef4444;"></i>
      {{ session('error') }}
    </div>
  @endif
</div>

<section class="hero">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-8 text-center text-white">
        <div class="hero-badge mx-auto">
          <i class="fas fa-comments"></i>
          We’re here to help you with every skin concern
        </div>
        <h1>
          Reach out to DermaConnect
          <em>for faster support and expert guidance.</em>
        </h1>
        <p>Have a question about booking, your treatment plan, or dermatologist availability? Our team is ready to respond quickly and help you get the care you need.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="#contact-form" class="btn-hero-primary">
            <i class="fas fa-paper-plane"></i> Send a Message
          </a>
          <a href="#contact-info" class="btn-hero-secondary">
            <i class="fas fa-headset"></i> Contact Details
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact-section" id="contact-info">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-5">
        <div class="contact-info-card">
          <span class="section-label">Contact Us</span>
          <h2 class="section-title">We’re here to answer your questions</h2>
          <p class="section-subtitle">Whether you need help with booking, treatment guidance, or clinic information, our support team is just a message away.</p>

          <div class="contact-info-item">
            <i class="fas fa-map-marker-alt"></i>
            <div>
              <strong>Visit our clinic</strong>
              <p>123 Gulberg III, Lahore, Punjab, Pakistan</p>
            </div>
          </div>

          <div class="contact-info-item">
            <i class="fas fa-phone"></i>
            <div>
              <strong>Call us</strong>
              <p>+92 300 123 4567</p>
            </div>
          </div>

          <div class="contact-info-item">
            <i class="fas fa-envelope"></i>
            <div>
              <strong>Email support</strong>
              <p>support@dermaconnect.pk</p>
            </div>
          </div>

          <div class="contact-info-item mb-0">
            <i class="fas fa-clock"></i>
            <div>
              <strong>Office hours</strong>
              <p>Mon – Sat: 9:00 AM – 8:00 PM</p>
            </div>
          </div>

          <p class="contact-details-note">If you need urgent dermatology advice, please call our clinic directly for the fastest response.</p>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="contact-card contact-form" id="contact-form">
          <h3>Send us a message</h3>
          <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your name" required />
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com" required />
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="+92 300 123 4567" />
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" placeholder="Reason for contacting" required />
                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <label for="message" class="form-label">Your Message</label>
                <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Tell us how we can help" rows="6" required>{{ old('message') }}</textarea>
                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <button type="submit" class="btn-register">Submit Request</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
