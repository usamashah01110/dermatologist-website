@extends('includes.main')

@section('content')
<section class="hero">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-8 text-center text-white">
        <div class="hero-badge mx-auto">
          <i class="fas fa-heart-pulse"></i>
          Skin health powered by trust and expertise
        </div>
        <h1>
          Our mission is to help every patient
          <em>feel confident in their skin.</em>
        </h1>
        <p>DermaCare brings together certified dermatologists, personalized treatment guidance, and modern telemedicine—all with the warmth of real healthcare support.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="#care-approach" class="btn-hero-primary">
            <i class="fas fa-hand-holding-medical"></i> Learn More
          </a>
          <a href="#why-us" class="btn-hero-secondary">
            <i class="fas fa-user-md"></i> Our Approach
          </a>
        </div>
        <div class="hero-stats justify-content-center mt-4">
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

<section class="register-section" id="care-approach">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <span class="section-label">About DermaCare</span>
        <h2 class="section-title">A modern dermatology experience with a personal touch.</h2>
        <p class="section-subtitle">Since our founding, we've been focused on making dermatology accessible across Pakistan. We combine verified specialists, evidence-based care, and caring follow-up so patients can trust their skin journey.</p>

        <div class="benefit-item">
          <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
          <div>
            <h6>Verified experts</h6>
            <p>Every dermatologist is carefully reviewed to ensure medical excellence and patient trust.</p>
          </div>
        </div>

        <div class="benefit-item">
          <div class="benefit-icon"><i class="fas fa-clock"></i></div>
          <div>
            <h6>Fast access</h6>
            <p>Book consultations quickly and get treatment advice without the wait of traditional clinics.</p>
          </div>
        </div>

        <div class="benefit-item mb-0">
          <div class="benefit-icon"><i class="fas fa-hand-holding-heart"></i></div>
          <div>
            <h6>Patient-centered care</h6>
            <p>Our care plans are tailored to each patient's goals, skin type, and long-term health.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="register-visual">
          <img src="https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?w=900&q=80&fit=crop" alt="Dermatology care"/>
          <div class="register-visual-badge">
            <div class="icon"><i class="fas fa-user-md"></i></div>
            <div class="text">
              <strong>Trusted by 50,000+ patients</strong>
              <span>Connecting skin care with compassion.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="diseases-section" id="why-us">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Why choose us</span>
      <h2 class="section-title">Our values shape the care we deliver.</h2>
      <p class="section-subtitle mx-auto">We believe stronger outcomes start with trust, transparency, and skin care designed around the patient.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-microscope"></i></div>
          <h5>Evidence-based guidance</h5>
          <p>Our dermatologists use up-to-date clinical protocols for safe, modern treatment plans.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-chart-line"></i></div>
          <h5>Progress tracking</h5>
          <p>We follow your improvements over time and refine care so you stay on the healthiest path.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-handshake"></i></div>
          <h5>Care you can trust</h5>
          <p>Transparent treatment recommendations and friendly follow-up are the standard here.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="reviews-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Patient stories</span>
      <h2 class="section-title">Patients love the DermaCare experience.</h2>
      <p class="section-subtitle mx-auto">Real results, reliable support, and easy access to dermatologists across Pakistan.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="review-card review-featured">
          <div class="review-quote">"</div>
          <div class="review-stars">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="review-text">DermaCare helped me finally manage my acne with a plan that actually fits my lifestyle. The doctor was supportive and responsive every step of the way.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=13" alt="Hina" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Hina Khan</div>
              <div class="reviewer-info">Islamabad, ICT</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="review-card">
          <div class="review-quote" style="color:var(--mid-blue)">"</div>
          <div class="review-stars">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="review-text">The consultation was detailed and the follow-up advice has made such a difference. I felt heard and well cared for from start to finish.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=24" alt="Bilal" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Bilal Ahmed</div>
              <div class="reviewer-info">Lahore, Punjab</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="review-card">
          <div class="review-quote" style="color:var(--mid-blue)">"</div>
          <div class="review-stars">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
          </div>
          <p class="review-text">My chronic eczema symptoms have improved so much, and the dermatologist explained every treatment clearly. I finally feel confident with my skin again.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=36" alt="Sara" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Sara Ali</div>
              <div class="reviewer-info">Karachi, Sindh</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="register-section">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-lg-7">
        <span class="section-label">Ready to start</span>
        <h2 class="section-title">Book your consultation with trusted dermatologists.</h2>
        <p class="section-subtitle">Whether you are seeking treatment for a skin condition or looking for preventative care, our team is ready to support you with experience and compassion.</p>
        <a href="#" class="btn-register mt-3"><i class="fas fa-calendar-check"></i> Book Appointment</a>
      </div>
      <div class="col-lg-5">
        <div class="register-visual" style="height:360px;">
          <img src="https://images.unsplash.com/photo-1524253482453-3fed8d2fe12b?w=900&q=80&fit=crop" alt="Appointment booking" />
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
