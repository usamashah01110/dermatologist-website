@extends('includes.main')

@section('content')

    <style>
        .doctor-hero {
            position: relative;
            padding: 70px 0 50px;
            background: linear-gradient(135deg, var(--soft-blue) 0%, var(--off-white) 100%);
            overflow: hidden;
        }

        .doctor-hero::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 420px; height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(66,165,245,0.18), transparent 70%);
            z-index: 1;
        }

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            font-size: 0.9rem;
            margin-bottom: 28px;
            position: relative;
            z-index: 2;
        }

        .breadcrumb-nav a {
            color: var(--text-mid);
            text-decoration: none;
            transition: color .2s;
        }

        .breadcrumb-nav a:hover { color: var(--primary); }
        .breadcrumb-nav .separator { color: var(--text-light); }
        .breadcrumb-nav .current { color: var(--primary); font-weight: 600; }

        .doctor-profile-card {
            background: var(--white);
            border-radius: 28px;
            padding: 40px;
            border: 1px solid var(--border);
            box-shadow: 0 30px 80px rgba(21,101,192,.08);
            position: relative;
            z-index: 2;
        }

        .doctor-profile-image {
            width: 100%;
            max-width: 260px;
            aspect-ratio: 1;
            border-radius: 24px;
            object-fit: cover;
            box-shadow: 0 20px 50px rgba(21,101,192,.18);
            border: 5px solid var(--white);
        }

        .doctor-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(39, 174, 96, 0.12);
            color: #1e8449;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .doctor-status-badge .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #27ae60;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .doctor-profile-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.9rem, 3.8vw, 2.6rem);
            color: var(--text-dark);
            margin-bottom: 8px;
            line-height: 1.15;
        }

        .doctor-profile-specialty {
            font-size: 1.05rem;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 22px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .doctor-profile-stats {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
            padding: 22px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            margin: 22px 0 26px;
        }

        .stat-block {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-block .icon {
            width: 46px; height: 46px;
            border-radius: 14px;
            background: var(--soft-blue);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .stat-block .label {
            font-size: 0.72rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 2px;
        }

        .stat-block .value {
            font-size: 0.98rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .info-section { padding: 80px 0; background: var(--white); }

        .info-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            padding: 32px;
            margin-bottom: 24px;
            transition: all .3s;
        }

        .info-card:hover {
            box-shadow: 0 20px 50px rgba(21,101,192,.08);
            border-color: var(--accent-blue);
        }

        .info-card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--text-dark);
            margin-bottom: 18px;
        }

        .info-card-title i {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: var(--soft-blue);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .info-card p { color: var(--text-mid); line-height: 1.8; font-size: 0.95rem; }

        .qualification-list { list-style: none; padding: 0; margin: 0; }

        .qualification-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px dashed var(--border);
            color: var(--text-mid);
        }

        .qualification-list li:last-child { border-bottom: none; }
        .qualification-list li i { color: var(--primary); margin-top: 4px; flex-shrink: 0; }

        .service-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            color: var(--text-mid);
            font-size: 0.92rem;
        }

        .service-item i {
            color: var(--primary);
            background: var(--soft-blue);
            width: 26px; height: 26px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .booking-sidebar { position: sticky; top: 100px; }

        .booking-cta-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent-blue) 100%);
            color: #fff;
            border-radius: 24px;
            padding: 36px 30px;
            box-shadow: 0 25px 60px rgba(21,101,192,.28);
            position: relative;
            overflow: hidden;
        }

        .booking-cta-card::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .booking-cta-card::after {
            content: '';
            position: absolute;
            bottom: -90px; left: -50px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .booking-cta-content { position: relative; z-index: 2; }

        .booking-cta-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: #fff;
            margin-bottom: 12px;
        }

        .booking-cta-card p {
            color: rgba(255,255,255,0.92);
            font-size: 0.92rem;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .btn-book-appointment {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #fff;
            color: var(--primary);
            padding: 16px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all .3s;
            margin-bottom: 14px;
        }

        .btn-book-appointment:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0,0,0,.18);
            color: var(--primary-dark);
        }

        .btn-secondary-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: rgba(255,255,255,0.18);
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.92rem;
            transition: all .3s;
            border: 1px solid rgba(255,255,255,0.35);
        }

        .btn-secondary-action:hover {
            background: rgba(255,255,255,0.28);
            color: #fff;
        }

        .clinic-info-card {
            background: var(--white);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
            margin-top: 24px;
        }

        .clinic-info-card h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .clinic-info-card h4 i { color: var(--primary); }

        .clinic-info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .clinic-info-item:last-child { border-bottom: none; padding-bottom: 0; }

        .clinic-info-item .icon-wrap {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: var(--soft-blue);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .clinic-info-item .label {
            font-size: 0.72rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 3px;
        }

        .clinic-info-item .value { font-weight: 500; color: var(--text-dark); }

        @media (max-width: 991px) {
            .booking-sidebar { position: static; margin-top: 30px; }
            .doctor-profile-card { padding: 28px; }
            .doctor-profile-image { max-width: 200px; }
        }

        @media (max-width: 576px) {
            .doctor-profile-stats { gap: 18px; }
            .doctor-hero { padding: 40px 0 30px; }
            .doctor-profile-card { padding: 22px; }
        }
    </style>

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

@endsection
