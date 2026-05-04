@extends('includes.main')
@section('content')
<section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="hero-badge">
          <i class="fas fa-shield-halved"></i>
          Trusted by 50,000+ patients across Pakistan
        </div>
        <h1>
          Healthy Skin Starts
          <em>With Expert Care.</em>
        </h1>
        <p>Connect with board-certified dermatologists, get accurate diagnoses, and receive personalised treatment — all from the comfort of your home.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="#" class="btn-hero-primary">
            <i class="fas fa-calendar-check"></i> Book Appointment
          </a>
          
        </div>
        <div class="hero-stats">
          <div>
            <div class="hero-stat-num">200+</div>
            <div class="hero-stat-label">Verified Doctors</div>
          </div>
          <div class="divider-dot" style="margin-top:12px;background:rgba(255,255,255,.3)"></div>
          <div>
            <div class="hero-stat-num">50k+</div>
            <div class="hero-stat-label">Happy Patients</div>
          </div>
          <div class="divider-dot" style="margin-top:12px;background:rgba(255,255,255,.3)"></div>
          <div>
            <div class="hero-stat-num">98%</div>
            <div class="hero-stat-label">Satisfaction Rate</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
                     <!-- Dynamic disease part -->
<section class="diseases-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Conditions We Treat</span>
      <h2 class="section-title">Common Skin Diseases</h2>
      <p class="section-subtitle mx-auto">Our specialists are experienced in diagnosing and treating a wide range of dermatological conditions.</p>
    </div>
    <div class="row g-4">
      @foreach($diseases as $disease)
      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon-image">
            <img src="{{ $disease->image_path }}" alt="{{ $disease->name }}"/>
          </div>
          <h5>{{ $disease->name }}</h5>
          <p>{{ $disease->description }}</p>
          <span class="disease-tag">{{ $disease->tag }}</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
                     <!-- Dermatologist register part -->
<section class="register-section">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-5 mb-5 mb-lg-0">
        <div class="register-visual">
          <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=800&q=80&fit=crop" alt="Dermatologist at work"/>
          <div class="register-visual-badge">
            <div class="icon"><i class="fas fa-user-md"></i></div>
            <div class="text">
              <strong>Join 200+ Specialists</strong>
              <span>Already on DermaConnect</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="register-content">
          <span class="section-label">For Professionals</span>
          <h2 class="section-title">Are You a Dermatologist?<br>Join Our Platform</h2>
          <p class="section-subtitle mb-5">Expand your reach, manage your schedule effortlessly, and deliver exceptional care to patients across Pakistan — all in one place.</p>

          <div class="benefit-item">
            <div class="benefit-icon"><i class="fas fa-users"></i></div>
            <div>
              <h6>Reach Thousands of Patients</h6>
              <p>Get discovered by patients actively searching for trusted dermatological care in your area.</p>
            </div>
          </div>

          <div class="benefit-item">
            <div class="benefit-icon"><i class="fas fa-calendar-days"></i></div>
            <div>
              <h6>Smart Appointment Management</h6>
              <p>Manage your schedule, bookings, and patient records from one intuitive dashboard.</p>
            </div>
          </div>

          <div class="benefit-item">
            <div class="benefit-icon"><i class="fas fa-shield-halved"></i></div>
            <div>
              <h6>Verified Badge & Credibility</h6>
              <p>Get a verified professional badge that builds patient trust and sets you apart.</p>
            </div>
          </div>

          <a href="#" class="btn-register mt-2">
            <i class="fas fa-stethoscope"></i> Register as Dermatologist
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
                                <!-- Review card -->
<section class="reviews-section">

  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Patient Stories</span>
      <h2 class="section-title">What Our Patients Say</h2>
      <p class="section-subtitle mx-auto">Real experiences from real patients who found the right care on DermaConnect.</p>
    </div>

    <div class="row g-4">
@foreach($reviews as $review)
      <div class="col-md-6 col-lg-4">
        <div class="review-card review-featured">
          <div class="review-quote">"</div>
          <div class="review-stars">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="review-text">{{ $review->review_text }}</p>
          <div class="d-flex align-items-center gap-3">
            <div class="reviewer-image">
              @if($review->image_path)
                <img src="{{ asset('storage/' . $review->image_path) }}" alt="Patient Image" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" />
              @else
                <div class="bg-light rounded-circle shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                  <small class="text-muted">No Image</small>
                </div>
              @endif
            </div>
            <div>
              <div class="reviewer-name">{{ $review->name }}</div>
              <div class="reviewer-info">{{ $review->location }}</div>
            </div>
          </div>
        </div>
      </div>
@endforeach
    </div>
  </div>
</section>
@endsection