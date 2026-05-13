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

    {{-- ===== DOCTOR HERO ===== --}}
    <section class="doctor-hero">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
                <span class="separator">/</span>
                <a href="">Dermatologists</a>
                <span class="separator">/</span>
                <span class="current">{{ $doctor->user->name }}</span>
            </nav>

            <div class="doctor-profile-card">
                <div class="row align-items-center g-4">
                    <div class="col-md-4 text-center">
                        <img
                            src="{{ asset('storage/' . $doctor->profile_image) }}"
                            alt="{{ $doctor->user->name }}"
                            class="doctor-profile-image"
                        />
                    </div>
                    <div class="col-md-8">
                        @php
                            $statusLower = strtolower($doctor->status);
                            $isAvailable = in_array($statusLower, ['available', 'active', 'verified', 'approved']);
                        @endphp

                        @if($isAvailable)
                            <div class="doctor-status-badge">
                                <span class="dot"></span>
                                {{ ucfirst($doctor->status) }} for Appointments
                            </div>
                        @else
                            <div class="doctor-status-badge" style="background: rgba(231, 76, 60, 0.12); color: #c0392b;">
                                <span class="dot" style="background: #c0392b;"></span>
                                {{ ucfirst($doctor->status) }}
                            </div>
                        @endif

                        <h1 class="doctor-profile-name">{{ $doctor->user->name }}</h1>

                        <div class="doctor-profile-specialty">
                            <i class="fas fa-stethoscope"></i>
                            {{ $doctor->specialization }}
                        </div>

                        <div class="doctor-profile-stats">
                            <div class="stat-block">
                                <div class="icon"><i class="fas fa-briefcase"></i></div>
                                <div>
                                    <div class="label">Experience</div>
                                    <div class="value">{{ $doctor->experience_year }}</div>
                                </div>
                            </div>
                            <div class="stat-block">
                                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                                <div>
                                    <div class="label">Qualification</div>
                                    <div class="value">{{ \Illuminate\Support\Str::limit($doctor->qualification, 24) }}</div>
                                </div>
                            </div>
                            <div class="stat-block">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <div class="label">Location</div>
                                    <div class="value">{{ $doctor->city }}</div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('booking.page', ['doctor' => $doctor->user->name]) }}" class="btn-doctor">
                            <i class="fas fa-calendar-check"></i>
                            Book an Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== INFO SECTION ===== --}}
    <section class="info-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">

                    <div class="info-card">
                        <h3 class="info-card-title">
                            <i class="fas fa-user-md"></i>
                            About {{ $doctor->user->name }}
                        </h3>
                        <p>
                            {{ $doctor->user->name }} is a certified {{ $doctor->specialization }} based in {{ $doctor->city }},
                            with {{ $doctor->experience_year }} of professional experience treating a wide range of dermatological
                            conditions. Patients receive thorough consultations, personalized treatment plans, and ongoing skincare
                            support tailored to their individual needs.
                        </p>
                        @if(!empty($doctor->bio))
                            <p style="margin-top: 16px;">{{ $doctor->bio }}</p>
                        @endif
                    </div>

                    <div class="info-card">
                        <h3 class="info-card-title">
                            <i class="fas fa-graduation-cap"></i>
                            Qualifications & Expertise
                        </h3>
                        <ul class="qualification-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div><strong>{{ $doctor->qualification }}</strong></div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div>Specialist in <strong>{{ $doctor->specialization }}</strong></div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div>{{ $doctor->experience_year }} of clinical practice</div>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <div>Practicing at <strong>{{ $doctor->clinic_address }}</strong></div>
                            </li>
                        </ul>
                    </div>

                    <div class="info-card">
                        <h3 class="info-card-title">
                            <i class="fas fa-spa"></i>
                            Services Offered
                        </h3>
                        <div class="row g-2">
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Acne &amp; Pimple Treatment</div></div>
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Skin Allergy Diagnosis</div></div>
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Pigmentation &amp; Melasma</div></div>
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Anti-Aging Treatments</div></div>
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Hair Loss Solutions</div></div>
                            <div class="col-sm-6"><div class="service-item"><i class="fas fa-check"></i> Cosmetic Dermatology</div></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="booking-sidebar">

                        <div class="booking-cta-card">
                            <div class="booking-cta-content">
                                <h3>Ready to Book?</h3>
                                <p>Schedule a consultation with {{ $doctor->user->name }} and take the next step in your skin journey.</p>

                                <a href="{{ route('booking.page', ['doctor' => $doctor->user->name]) }}" class="btn-book-appointment">
                                    <i class="fas fa-calendar-check"></i>
                                    Book Appointment
                                </a>

                                <a href="" class="btn-secondary-action">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Doctors
                                </a>
                            </div>
                        </div>

                        <div class="clinic-info-card">
                            <h4><i class="fas fa-clinic-medical"></i> Clinic Details</h4>

                            <div class="clinic-info-item">
                                <span class="icon-wrap"><i class="fas fa-map-marker-alt"></i></span>
                                <div>
                                    <div class="label">Address</div>
                                    <div class="value">{{ $doctor->clinic_address }}</div>
                                </div>
                            </div>

                            <div class="clinic-info-item">
                                <span class="icon-wrap"><i class="fas fa-city"></i></span>
                                <div>
                                    <div class="label">City</div>
                                    <div class="value">{{ $doctor->city }}</div>
                                </div>
                            </div>

                            @if(!empty($doctor->user->phone))
                                <div class="clinic-info-item">
                                    <span class="icon-wrap"><i class="fas fa-phone"></i></span>
                                    <div>
                                        <div class="label">Contact</div>
                                        <div class="value">{{ $doctor->user->phone }}</div>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($doctor->user->email))
                                <div class="clinic-info-item">
                                    <span class="icon-wrap"><i class="fas fa-envelope"></i></span>
                                    <div>
                                        <div class="label">Email</div>
                                        <div class="value">{{ $doctor->user->email }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ⭐ CUSTOMER REVIEWS SECTION ===== --}}
    <section class="reviews-section">
        <div class="container">
            <div class="reviews-header">
                <span class="reviews-badge">
                    <i class="fas fa-heart"></i> Patient Stories
                </span>
                <h2 class="reviews-title">
                    What Patients Say About {{ $doctor->user->name }}
                </h2>
                <p class="reviews-subtitle">
                    Real experiences from real patients who trusted {{ $doctor->user->name }} with their skin health journey.
                </p>

                {{-- ⭐ Average rating summary --}}
                @if(isset($reviews) && $reviews->count() > 0)
                    @php
                        $avgRating = $reviews->avg('rating') ?? 5;
                        $totalReviews = $reviews->count();
                    @endphp
                    <div class="doctor-rating-summary">
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($avgRating) ? 'active' : '' }}"></i>
                            @endfor
                        </div>
                        <span class="rating-value">{{ number_format($avgRating, 1) }}</span>
                        <span class="rating-count">({{ $totalReviews }} {{ $totalReviews == 1 ? 'review' : 'reviews' }})</span>
                    </div>
                @endif
            </div>

            {{-- ===== ⭐ WRITE A REVIEW BUTTON / FORM ===== --}}
            @auth

                <div class="write-review-wrapper">

                        <button type="button" class="btn-write-review" onclick="toggleReviewForm()">
                            <i class="fas fa-pen-to-square"></i>
                            Write a Review
                        </button>

                        <div class="review-form-container" id="reviewFormContainer" style="display: none;">
                            <div class="review-form-card">
                                <button type="button" class="close-review-form" onclick="toggleReviewForm()">
                                    <i class="fas fa-times"></i>
                                </button>

                                <h3 class="review-form-title">
                                    <i class="fas fa-comment-medical"></i>
                                    Share Your Experience
                                </h3>
                                <p class="review-form-subtitle">
                                    Help others by sharing your honest experience with {{ $doctor->user->name }}.
                                </p>

                                <form action="{{ route('review.store', $doctor->id ) }}" method="POST">
                                    @csrf

                                    {{-- Star Rating --}}
                                    <div class="review-form-group">
                                        <label class="review-form-label">Your Rating <span style="color:#dc3545">*</span></label>
                                        <div class="star-rating-input">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio"
                                                       id="star{{ $i }}"
                                                       name="rating"
                                                       value="{{ $i }}"
                                                       {{ old('rating') == $i ? 'checked' : '' }}
                                                       required>
                                                <label for="star{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                            @endfor
                                        </div>
                                        @error('rating')
                                        <small style="color:#dc3545; display:block; margin-top:6px;">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Review Text --}}
                                    <div class="review-form-group">
                                        <label class="review-form-label">Your Review <span style="color:#dc3545">*</span></label>
                                        <textarea name="review_text"
                                                  class="review-form-textarea"
                                                  rows="5"
                                                  placeholder="Share your experience — what went well, how the doctor treated you, treatment results, etc."
                                                  minlength="10"
                                                  maxlength="1000"
                                                  required>{{ old('review_text') }}</textarea>
                                        <small class="char-counter">
                                            <span id="charCount">0</span> / 1000 characters (min 10)
                                        </small>
                                        @error('review_text')
                                        <small style="color:#dc3545; display:block; margin-top:6px;">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="review-form-actions">
                                        <button type="submit" class="btn-submit-review">
                                            <i class="fas fa-paper-plane"></i>
                                            Submit Review
                                        </button>
                                        <button type="button" class="btn-cancel-review" onclick="toggleReviewForm()">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            @else
                <div class="write-review-wrapper">
                    <div class="login-to-review-notice">
                        <i class="fas fa-lock"></i>
                        <div>
                            <strong>Want to share your experience?</strong>
                            <p>
                                <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Login</a>
                                or
                                <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600;">Register</a>
                                to write a review for {{ $doctor->user->name }}.
                            </p>
                        </div>
                    </div>
                </div>
            @endauth

            {{-- ===== EXISTING REVIEWS DISPLAY ===== --}}
            @if(isset($userReview) && $userReview->count() > 0)
                <div class="row g-4">
                    @foreach($userReview as $review)
                        <div class="col-md-6 col-lg-4">
                            <div class="review-card">
                                <div class="review-quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>

                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= ($review->rating ?? 5) ? '' : 'inactive' }}"></i>
                                    @endfor
                                </div>

                                <p class="review-text">{{ $review->review_text }}</p>

                                <div class="reviewer-info">
                                    <img src="{{ $review->image_path ? asset('storage/' . $review->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($review->name) . '&background=1565C0&color=fff' }}"
                                         alt="{{ $review->name }}"
                                         class="reviewer-image"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($review->name) }}&background=1565C0&color=fff'" />
                                    <div>
                                        <h5 class="reviewer-name">{{ $review->name }}</h5>
                                        <span class="reviewer-location">
                                            <i class="fas fa-map-marker-alt"></i> {{ $review->location }}
                                        </span>
                                    </div>
                                    <div class="verified-badge" title="Verified Patient">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-reviews">
                    <i class="fas fa-comment-medical"></i>
                    <h4>No Reviews Yet</h4>
                    <p>Be the first patient to share your experience with {{ $doctor->user->name }} after your consultation.</p>
                </div>
            @endif
        </div>
    </section>

    <script>
        // Auto-dismiss toast notifications
        setTimeout(() => {
            document.querySelectorAll('.toast-custom').forEach(t => t.remove());
        }, 5000);

        // Toggle review form
        function toggleReviewForm() {
            const container = document.getElementById('reviewFormContainer');
            if (container) {
                if (container.style.display === 'none' || !container.style.display) {
                    container.style.display = 'block';
                    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    container.style.display = 'none';
                }
            }
        }

        // Character counter
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('.review-form-textarea');
            const counter = document.getElementById('charCount');

            if (textarea && counter) {
                textarea.addEventListener('input', function() {
                    counter.textContent = this.value.length;
                    counter.style.color = this.value.length < 10 ? '#dc3545' : '#27ae60';
                });

                if (textarea.value) {
                    counter.textContent = textarea.value.length;
                }
            }

            // Auto-open form on validation errors
            @if($errors->any())
            toggleReviewForm();
            @endif
        });
    </script>
@endsection
