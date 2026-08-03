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

    {{-- ===== DOCTOR HERO (profile card) ===== --}}
    <style>
        .doc-hero-wrap { padding: 32px 0 8px; }
        .doc-hero-card {
            display: flex;
            flex-wrap: wrap;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(21, 101, 192, 0.10);
        }
        .doc-hero-photo {
            flex: 0 0 320px;
            max-width: 320px;
            background: var(--soft-blue);
            position: relative;
        }
        .doc-hero-photo img {
            width: 100%;
            height: 100%;
            min-height: 400px;
            object-fit: cover;
            display: block;
        }
        .doc-hero-photo::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: 0;
            height: 130px;
            background: linear-gradient(to top, rgba(13, 33, 55, 0.55), transparent);
        }
        .doc-hero-photo .doc-hero-photo-name {
            position: absolute;
            left: 20px;
            bottom: 16px;
            z-index: 2;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #ffffff;
            text-transform: uppercase;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
            pointer-events: none;
        }
        .doc-hero-body {
            flex: 1 1 0;
            min-width: 0;
            padding: 34px 38px;
            color: var(--text-dark);
            position: relative;
            background:
                linear-gradient(180deg, var(--off-white) 0%, var(--white) 220px);
        }
        .doc-hero-section { margin-bottom: 22px; }
        .doc-hero-section:last-child { margin-bottom: 0; }
        .doc-hero-label {
            font-size: .72rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 700;
        }
        .doc-hero-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 6px;
            line-height: 1.15;
        }
        .doc-hero-qual { font-size: 1rem; color: var(--text-mid); margin: 0 0 2px; font-weight: 600; }
        .doc-hero-clinic { font-size: .92rem; color: var(--text-light); margin: 0; line-height: 1.5; }
        .doc-hero-chips { display: flex; flex-wrap: wrap; gap: 10px; }
        .doc-hero-chip {
            display: inline-block;
            background: var(--soft-blue);
            border: 1px solid var(--border);
            color: var(--primary);
            font-size: .85rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 50px;
        }
        .doc-hero-value { font-size: 1.05rem; color: var(--text-dark); font-weight: 600; margin: 0; }
        .doc-hero-value.address { font-size: .95rem; font-weight: 500; line-height: 1.6; color: var(--text-mid); }
        .doc-hero-fee {
            position: absolute;
            top: 30px;
            right: 34px;
            background: linear-gradient(135deg, var(--primary), var(--accent-blue));
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 10px 22px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 24px rgba(21, 101, 192, 0.30);
        }
        .doc-hero-fee small { display: block; font-size: .6rem; font-weight: 600; letter-spacing: 1px; opacity: .9; text-transform: uppercase; }
        .doc-hero-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .82rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 50px;
            margin-bottom: 16px;
        }
        .doc-hero-status .dot { width: 8px; height: 8px; border-radius: 50%; }
        .doc-hero-status.is-available { background: #e6f7ef; color: #1a9b6c; }
        .doc-hero-status.is-available .dot { background: #1a9b6c; }
        .doc-hero-status.not-available { background: #fdecea; color: #d64545; }
        .doc-hero-status.not-available .dot { background: #d64545; }
        .doc-hero-actions { margin-top: 26px; }
        .doc-hero-book {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--accent-blue));
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
            padding: 13px 30px;
            border-radius: 50px;
            text-decoration: none;
            transition: transform .25s ease, box-shadow .25s ease;
            box-shadow: 0 10px 26px rgba(21, 101, 192, 0.30);
        }
        .doc-hero-book:hover { transform: translateY(-2px); color: #fff; box-shadow: 0 16px 36px rgba(21, 101, 192, 0.42); }

        /* Divided detail boxes inside the card */
        .doc-meta-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .doc-meta-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: var(--off-white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 15px 16px;
        }
        .doc-meta-box .ic {
            flex-shrink: 0;
            width: 38px; height: 38px;
            border-radius: 10px;
            background: var(--soft-blue);
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: .95rem;
        }
        .doc-meta-box .mb-label {
            font-size: .7rem; letter-spacing: 1px; text-transform: uppercase;
            color: var(--text-light); font-weight: 600; margin-bottom: 3px;
        }
        .doc-meta-box .mb-value { font-size: .95rem; color: var(--text-dark); font-weight: 600; line-height: 1.35; word-break: break-word; }

        /* Extra sections (About / Qualifications / Services) below the card */
        .doc-extra { margin-top: 24px; display: grid; gap: 22px; }
        .doc-extra-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; }
        .doc-extra-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 26px 28px;
            box-shadow: 0 10px 30px rgba(21, 101, 192, 0.06);
        }
        .doc-extra-title {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.15rem; font-weight: 700; color: var(--text-dark);
            margin: 0 0 14px;
        }
        .doc-extra-title i {
            width: 34px; height: 34px; border-radius: 10px;
            background: var(--soft-blue); color: var(--primary);
            display: inline-flex; align-items: center; justify-content: center; font-size: .9rem;
        }
        .doc-extra-text { color: var(--text-mid); line-height: 1.75; margin: 0; font-size: .96rem; }
        .doc-extra-list { list-style: none; padding: 0; margin: 0; }
        .doc-extra-list li {
            display: flex; align-items: flex-start; gap: 10px;
            color: var(--text-mid); font-size: .94rem; padding: 7px 0; line-height: 1.5;
        }
        .doc-extra-list li i { color: var(--primary); margin-top: 3px; font-size: .85rem; flex-shrink: 0; }
        .doc-extra-list.two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 0 18px; }

        @media (max-width: 991px) {
            .doc-hero-photo { flex-basis: 100%; max-width: 100%; }
            .doc-hero-photo img { min-height: 320px; }
            .doc-hero-body { padding: 30px 32px; }
            .doc-hero-fee { position: static; display: inline-block; margin-bottom: 16px; }
            .doc-extra-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 575px) {
            .doc-hero-body { padding: 26px 20px; }
            .doc-meta-grid { grid-template-columns: 1fr; }
            .doc-extra-list.two-col { grid-template-columns: 1fr; }
        }
    </style>

    <section class="doc-hero-wrap">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
                <span class="separator">/</span>
                <a href="{{ route('dermatologists.page') }}">Dermatologists</a>
                <span class="separator">/</span>
                <span class="current">{{ $doctor->user->name }}</span>
            </nav>

            @php
                $statusLower = strtolower($doctor->status);
                $isAvailable = in_array($statusLower, ['available', 'active', 'verified', 'approved']);
                // Speciality may be a single value or a comma-separated list.
                $specialities = collect(explode(',', (string) $doctor->specialization))
                    ->map(fn ($s) => trim($s))
                    ->filter()
                    ->all();
            @endphp

            <div class="doc-hero-card">
                {{-- Left: photo --}}
                <div class="doc-hero-photo">
                    <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="{{ $doctor->user->name }}">
                    <span class="doc-hero-photo-name">{{ \Illuminate\Support\Str::of($doctor->user->name)->explode(' ')->first() }}</span>
                </div>

                {{-- Right: details --}}
                <div class="doc-hero-body">
                    {{-- Fee badge --}}
                    <div class="doc-hero-fee">
                        @if(!is_null($doctor->consultation_fee))
                            Rs&nbsp;{{ number_format($doctor->consultation_fee) }}
                            <small>Consultation</small>
                        @else
                            On request
                            <small>Consultation</small>
                        @endif
                    </div>

                    @if($isAvailable)
                        <div class="doc-hero-status is-available">
                            <span class="dot"></span> Available
                        </div>
                    @else
                        <div class="doc-hero-status not-available">
                            <span class="dot"></span> {{ ucfirst($doctor->status) }}
                        </div>
                    @endif

                    {{-- PROFILE --}}
                    <div class="doc-hero-section">
                        <div class="doc-hero-label">Profile</div>
                        <h1 class="doc-hero-name">{{ $doctor->user->name }}</h1>
                        <p class="doc-hero-qual">{{ $doctor->qualification }}</p>
                        <p class="doc-hero-clinic">{{ $doctor->clinic_address }}</p>
                    </div>

                    {{-- SPECIALITY --}}
                    <div class="doc-hero-section">
                        <div class="doc-hero-label">Speciality</div>
                        <div class="doc-hero-chips">
                            @foreach($specialities as $speciality)
                                <span class="doc-hero-chip">{{ $speciality }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- DETAILS (divided into boxes) --}}
                    @php
                        $exp = trim((string) $doctor->experience_year);
                        $expText = \Illuminate\Support\Str::contains(strtolower($exp), 'year') ? $exp : $exp.' years';
                        $availabilityText = is_array($doctor->availability_days) && count($doctor->availability_days)
                            ? count($doctor->availability_days).' days / week'
                            : 'On request';
                    @endphp
                    <div class="doc-hero-section">
                        <div class="doc-meta-grid">
                            <div class="doc-meta-box">
                                <span class="ic"><i class="fas fa-briefcase"></i></span>
                                <div>
                                    <div class="mb-label">Experience</div>
                                    <div class="mb-value">{{ $expText }}</div>
                                </div>
                            </div>
                            <div class="doc-meta-box">
                                <span class="ic"><i class="fas fa-phone"></i></span>
                                <div>
                                    <div class="mb-label">Contact</div>
                                    <div class="mb-value">{{ $doctor->phone_number ?? 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="doc-meta-box">
                                <span class="ic"><i class="fas fa-map-marker-alt"></i></span>
                                <div>
                                    <div class="mb-label">City</div>
                                    <div class="mb-value">{{ $doctor->city }}</div>
                                </div>
                            </div>
                            <div class="doc-meta-box">
                                <span class="ic"><i class="fas fa-calendar-week"></i></span>
                                <div>
                                    <div class="mb-label">Availability</div>
                                    <div class="mb-value">{{ $availabilityText }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="doc-hero-actions">
                        <a href="{{ route('booking.page', ['doctor' => $doctor->id]) }}" class="doc-hero-book">
                            <i class="fas fa-calendar-check"></i> Book an Appointment
                        </a>
                    </div>
                </div>
            </div>

            {{-- ===== ABOUT + DETAIL SECTIONS ===== --}}
            <div class="doc-extra">
                <div class="doc-extra-card">
                    <h3 class="doc-extra-title"><i class="fas fa-user-md"></i> About {{ $doctor->user->name }}</h3>
                    <p class="doc-extra-text">
                        {{ $doctor->user->name }} is a certified {{ $doctor->specialization }} based in {{ $doctor->city }},
                        with {{ $expText }} of professional experience treating a wide range of dermatological conditions.
                        Patients receive thorough consultations, personalized treatment plans, and ongoing skincare support
                        tailored to their individual needs.
                    </p>
                    @if(!empty($doctor->bio))
                        <p class="doc-extra-text" style="margin-top:14px;">{{ $doctor->bio }}</p>
                    @endif
                </div>

                <div class="doc-extra-grid">
                    <div class="doc-extra-card">
                        <h3 class="doc-extra-title"><i class="fas fa-graduation-cap"></i> Qualifications &amp; Expertise</h3>
                        <ul class="doc-extra-list">
                            <li><i class="fas fa-check-circle"></i> <span><strong>{{ $doctor->qualification }}</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Specialist in <strong>{{ $doctor->specialization }}</strong></span></li>
                            <li><i class="fas fa-check-circle"></i> <span>{{ $expText }} of clinical practice</span></li>
                            <li><i class="fas fa-check-circle"></i> <span>Practicing at <strong>{{ $doctor->clinic_address }}</strong></span></li>
                        </ul>
                    </div>
                    <div class="doc-extra-card">
                        <h3 class="doc-extra-title"><i class="fas fa-spa"></i> Services Offered</h3>
                        <ul class="doc-extra-list two-col">
                            <li><i class="fas fa-check"></i> <span>Acne &amp; Pimple Treatment</span></li>
                            <li><i class="fas fa-check"></i> <span>Skin Allergy Diagnosis</span></li>
                            <li><i class="fas fa-check"></i> <span>Pigmentation &amp; Melasma</span></li>
                            <li><i class="fas fa-check"></i> <span>Anti-Aging Treatments</span></li>
                            <li><i class="fas fa-check"></i> <span>Hair Loss Solutions</span></li>
                            <li><i class="fas fa-check"></i> <span>Cosmetic Dermatology</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== INFO SECTION ===== --}}
    <section class="info-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="booking-sidebar">

                        <div class="booking-cta-card">
                            <div class="booking-cta-content">
                                <h3>Ready to Book?</h3>
                                <p>Schedule a consultation with {{ $doctor->user->name }} and take the next step in your skin journey.</p>

                                <a href="{{ route('booking.page', ['doctor' => $doctor->id]) }}" class="btn-book-appointment">
                                    <i class="fas fa-calendar-check"></i>
                                    Book Appointment
                                </a>

                                <a href="{{ route('dermatologists.page') }}" class="btn-secondary-action">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Doctors
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="booking-sidebar">
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

                            @if(!empty($doctor->phone_number))
                                <div class="clinic-info-item">
                                    <span class="icon-wrap"><i class="fas fa-phone"></i></span>
                                    <div>
                                        <div class="label">Contact</div>
                                        <div class="value">{{ $doctor->phone_number }}</div>
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
