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
          <a href="#" class="btn-hero-secondary">
            <i class="fas fa-play-circle"></i> How it Works
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

<section class="diseases-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Conditions We Treat</span>
      <h2 class="section-title">Common Skin Diseases</h2>
      <p class="section-subtitle mx-auto">Our specialists are experienced in diagnosing and treating a wide range of dermatological conditions.</p>
    </div>
    <div class="row g-4">

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-droplet"></i></div>
          <h5>Acne & Pimples</h5>
          <p>Comprehensive treatment plans for mild to severe acne, including hormonal and cystic types.</p>
          <span class="disease-tag">Very Common</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-sun"></i></div>
          <h5>Psoriasis</h5>
          <p>Advanced therapies to manage chronic plaque psoriasis and reduce flare-ups effectively.</p>
          <span class="disease-tag">Chronic</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-wind"></i></div>
          <h5>Eczema</h5>
          <p>Personalised care for atopic dermatitis to soothe inflammation and restore skin barrier health.</p>
          <span class="disease-tag">Inflammatory</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-circle-dot"></i></div>
          <h5>Vitiligo</h5>
          <p>Targeted repigmentation therapies and management strategies for vitiligo patches.</p>
          <span class="disease-tag">Autoimmune</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-splotch"></i></div>
          <h5>Rosacea</h5>
          <p>Trigger identification and prescription treatments to control facial redness and flushing.</p>
          <span class="disease-tag">Facial</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-microscope"></i></div>
          <h5>Skin Cancer</h5>
          <p>Early detection screenings and expert management of melanoma and non-melanoma skin cancers.</p>
          <span class="disease-tag">Critical</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-person-rays"></i></div>
          <h5>Fungal Infections</h5>
          <p>Effective antifungal therapies for ringworm, athlete's foot, nail fungus, and more.</p>
          <span class="disease-tag">Infectious</span>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="disease-card">
          <div class="disease-icon"><i class="fas fa-hand-dots"></i></div>
          <h5>Warts & Moles</h5>
          <p>Safe removal and monitoring of warts, skin tags, and moles with minimal scarring.</p>
          <span class="disease-tag">Benign</span>
        </div>
      </div>

    </div>
  </div>
</section>

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
              <span>Already on DermaCare</span>
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

<section class="reviews-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Patient Stories</span>
      <h2 class="section-title">What Our Patients Say</h2>
      <p class="section-subtitle mx-auto">Real experiences from real patients who found the right care on DermaCare.</p>
    </div>

    <div class="row g-4">

      <div class="col-md-6 col-lg-4">
        <div class="review-card review-featured">
          <div class="review-quote">"</div>
          <div class="review-stars">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="review-text">I struggled with severe cystic acne for years. Dr. Fatima created a custom plan that cleared my skin in just 3 months. I finally feel confident again. DermaCare changed my life!</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=47" alt="Ayesha" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Ayesha Malik</div>
              <div class="reviewer-info">Lahore, Punjab</div>
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
          <p class="review-text">Booking was seamless and the doctor was incredibly thorough. My eczema flare-ups have significantly reduced. The online consultation saved me hours of commuting!</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=12" alt="Omar" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Omar Farooq</div>
              <div class="reviewer-info">Karachi, Sindh</div>
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
          <p class="review-text">The psoriasis treatment plan from Dr. Ahmed was a game-changer. He explained everything clearly and followed up regularly. Highly recommended for anyone struggling with chronic skin conditions.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=32" alt="Sara" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Sara Ahmed</div>
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
          <p class="review-text">I was nervous about online dermatology but DermaCare made it incredibly easy. The doctor diagnosed my vitiligo accurately and gave me a hopeful treatment roadmap.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=54" alt="Bilal" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Bilal Khan</div>
              <div class="reviewer-info">Faisalabad, Punjab</div>
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
          <p class="review-text">Super fast appointment and a very knowledgeable dermatologist. The skin cancer screening was thorough and gave me complete peace of mind. Worth every rupee!</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=25" alt="Nadia" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Nadia Hussain</div>
              <div class="reviewer-info">Multan, Punjab</div>
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
          <p class="review-text">As a busy professional, I love how easy it is to consult a top dermatologist without taking time off work. The platform is clean, fast, and the doctors are exceptional.</p>
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/100?img=68" alt="Hamza" class="reviewer-avatar"/>
            <div>
              <div class="reviewer-name">Hamza Raza</div>
              <div class="reviewer-info">Lahore, Punjab</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection