@extends('includes.main')

@section('content')
    <style>
        /* ============ BOOKING — MODERN FORM CARD ============ */
        :root {
            --bk-primary: #1B4FD8;
            --bk-primary-light: #EEF3FD;
            --bk-accent: #10B981;
            --bk-text: #0F1724;
            --bk-muted: #6B7585;
            --bk-border: #e9ecef;
            --bk-gradient: linear-gradient(135deg, #1B4FD8 0%, #4A78E8 100%);
            --bk-gradient-soft: linear-gradient(135deg, #EEF3FD 0%, #DCE7FB 100%);
        }

        /* ===== BOOKING CARD ===== */
        .booking-wrapper { padding: 60px 0; position: relative; }
        .booking-card-modern {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(15, 23, 36, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== LEFT BRAND/DOCTOR PANEL ===== */
        .booking-left {
            background: var(--bk-gradient);
            color: white;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .booking-left::before {
            content: ''; position: absolute;
            top: -30%; right: -30%;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .booking-left::after {
            content: ''; position: absolute;
            bottom: -20%; left: -20%;
            width: 250px; height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .booking-left > * { position: relative; z-index: 2; }

        .panel-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: rgba(255,255,255,0.2);
            padding: 0.4rem 0.9rem; border-radius: 20px;
            font-size: 0.78rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
            margin-bottom: 1.25rem;
        }
        .panel-title { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.75rem; line-height: 1.25; }
        .panel-info { font-size: 0.95rem; opacity: 0.92; margin-bottom: 1.5rem; line-height: 1.6; }

        /* Doctor card */
        .doctor-card-modern {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 18px; padding: 1.25rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        .doctor-card-modern:hover { transform: translateY(-3px); }
        .doctor-card-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; }
        .doctor-avatar-modern {
            width: 70px; height: 70px;
            border-radius: 50%; object-fit: cover;
            border: 3px solid rgba(255,255,255,0.3);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }
        .doctor-info-modern strong { display: block; font-size: 1.1rem; margin-bottom: 0.15rem; }
        .doctor-info-modern .specialty {
            font-size: 0.85rem; opacity: 0.9;
            background: rgba(255,255,255,0.2);
            padding: 0.15rem 0.6rem; border-radius: 12px;
            display: inline-block;
        }
        .doctor-meta-row {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.85rem; opacity: 0.92;
            padding: 0.4rem 0;
            border-top: 1px solid rgba(255,255,255,0.15);
        }
        .doctor-meta-row:first-of-type { border-top: none; padding-top: 0; }
        .doctor-meta-row i { width: 18px; opacity: 0.85; }

        .benefits-list { list-style: none; padding: 0; margin: 0 0 1.5rem 0; }
        .benefits-list li {
            display: flex; align-items: flex-start; gap: 0.75rem;
            padding: 0.65rem 0; font-size: 0.95rem; opacity: 0.95;
        }
        .benefits-list i {
            background: rgba(255,255,255,0.2);
            width: 28px; height: 28px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.7rem; flex-shrink: 0;
        }
        .panel-note {
            background: rgba(255,255,255,0.1);
            border-left: 3px solid rgba(255,255,255,0.5);
            padding: 0.85rem 1rem; border-radius: 8px;
            font-size: 0.85rem; line-height: 1.5; opacity: 0.95;
        }

        /* ===== RIGHT FORM PANEL ===== */
        .booking-right { padding: 2.5rem; }
        .form-title-modern { font-size: 1.6rem; font-weight: 700; color: var(--bk-text); margin-bottom: 0.35rem; }
        .form-subtitle-modern { color: var(--bk-muted); margin-bottom: 1.75rem; font-size: 0.95rem; }

        .form-section-bk {
            padding: 1.5rem;
            border: 1px solid #f0f0f5;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            background: #fdfdff;
            transition: all 0.3s ease;
        }
        .form-section-bk:hover {
            border-color: rgba(27, 79, 216, 0.2);
            box-shadow: 0 4px 20px rgba(27, 79, 216, 0.05);
        }
        .section-header-bk {
            display: flex; align-items: center; gap: 0.85rem;
            margin-bottom: 1.25rem; padding-bottom: 0.85rem;
            border-bottom: 1px dashed #e9ecef;
        }
        .section-number-bk {
            width: 38px; height: 38px;
            border-radius: 11px;
            background: var(--bk-gradient); color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            box-shadow: 0 6px 15px rgba(27, 79, 216, 0.25);
            flex-shrink: 0;
        }
        .section-heading-bk { font-weight: 700; color: var(--bk-text); margin: 0; font-size: 1.05rem; }
        .section-sub-bk { color: var(--bk-muted); font-size: 0.82rem; }

        .form-label-bk { font-weight: 600; color: var(--bk-text); margin-bottom: 0.5rem; font-size: 0.88rem; display: block; }
        .required { color: #dc3545; }
        .input-wrap { position: relative; }
        .input-wrap .input-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--bk-primary);
            font-size: 0.95rem; pointer-events: none;
        }
        .form-control-bk, .form-select-bk {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 2px solid var(--bk-border);
            border-radius: 12px;
            font-size: 0.95rem; background: white;
            transition: all 0.3s ease;
            font-family: inherit;
            color: var(--bk-text);
        }
        .form-control-bk.no-icon { padding-left: 1rem; }
        .form-control-bk:focus, .form-select-bk:focus {
            outline: none;
            border-color: var(--bk-primary);
            box-shadow: 0 4px 18px rgba(27, 79, 216, 0.12);
        }
        .form-control-bk:disabled, .form-control-bk[readonly] {
            background: #f8f9fa; cursor: not-allowed;
        }
        textarea.form-control-bk { padding: 0.85rem 1rem; resize: vertical; min-height: 100px; }

        /* ── NEW: Invalid state styling ── */
        .form-control-bk.is-invalid, .form-select-bk.is-invalid {
            border-color: #dc3545 !important;
            background-color: #fef2f2 !important;
        }
        .form-control-bk.is-invalid:focus, .form-select-bk.is-invalid:focus {
            box-shadow: 0 4px 18px rgba(220, 53, 69, 0.12) !important;
        }
        .input-error-bk {
            color: #dc3545;
            font-size: 0.82rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .input-error-bk i { font-size: 0.85rem; }

        /* ── NEW: General error banner ── */
        .alert-validation-bk {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 4px solid #dc3545;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }
        .alert-validation-bk-icon {
            color: #dc3545;
            font-size: 1.25rem;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .alert-validation-bk-content {
            flex: 1;
            color: #991b1b;
            font-size: 0.9rem;
        }
        .alert-validation-bk-content strong {
            display: block;
            margin-bottom: 6px;
            color: #7f1d1d;
            font-size: 0.95rem;
        }
        .alert-validation-bk-content ul {
            margin: 0;
            padding-left: 18px;
        }
        .alert-validation-bk-content li {
            margin: 3px 0;
        }

        .pill-group { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .pill-option { flex: 1; min-width: 120px; position: relative; cursor: pointer; }
        .pill-option input { position: absolute; opacity: 0; }
        .pill-option .pill-label {
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
            padding: 0.7rem 0.85rem;
            border: 2px solid var(--bk-border);
            border-radius: 12px;
            font-size: 0.88rem; font-weight: 600;
            color: var(--bk-muted); background: white;
            transition: all 0.25s ease; text-align: center;
        }
        .pill-option:hover .pill-label {
            border-color: var(--bk-primary);
            color: var(--bk-primary);
            transform: translateY(-1px);
        }
        .pill-option input:checked + .pill-label {
            background: var(--bk-gradient);
            border-color: transparent; color: white;
            box-shadow: 0 6px 16px rgba(27, 79, 216, 0.3);
        }
        .pill-group.is-invalid {
            padding: 8px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
        }

        .check-wrap {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.65rem 0.85rem;
            background: var(--bk-primary-light);
            border-radius: 10px;
            cursor: pointer; transition: background 0.25s;
        }
        .check-wrap:hover { background: #dfe9fb; }
        .check-wrap input { accent-color: var(--bk-primary); width: 18px; height: 18px; }
        .check-wrap label { font-size: 0.9rem; font-weight: 600; color: var(--bk-text); margin: 0; cursor: pointer; }

        .availability-status {
            margin-top: 0.6rem; padding: 0.65rem 0.85rem;
            border-radius: 10px; font-size: 0.85rem; font-weight: 600;
            display: none; align-items: center; gap: 0.5rem;
            animation: fadeIn 0.3s ease;
        }
        .availability-status.show { display: flex; }
        .availability-status.available { background: #E6F6F1; color: #0B875B; border: 1px solid #b6e6d4; }
        .availability-status.full { background: #FDECEC; color: #c0392b; border: 1px solid #f5c6c6; }
        .availability-status.checking { background: #f0f5ff; color: var(--bk-primary); border: 1px solid #c7d8f5; }
        .availability-status .progress-bar-tiny {
            flex: 1; height: 6px;
            background: rgba(255,255,255,0.6);
            border-radius: 3px; overflow: hidden;
            margin-left: 0.5rem;
        }
        .availability-status .progress-bar-tiny .fill { height: 100%; border-radius: 3px; transition: width 0.5s ease; }
        .availability-status.available .fill { background: #0B875B; }
        .availability-status.full .fill { background: #c0392b; width: 100% !important; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
        .spinner-tiny {
            display: inline-block; width: 14px; height: 14px;
            border: 2px solid currentColor;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-submit-bk {
            background: var(--bk-gradient); color: white;
            border: none; border-radius: 12px;
            padding: 0.95rem 2rem;
            font-weight: 600; font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative; overflow: hidden;
        }
        .btn-submit-bk:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(27, 79, 216, 0.3);
            color: white;
        }
        .btn-submit-bk:disabled { opacity: 0.55; cursor: not-allowed; }
        .btn-submit-bk::before {
            content: ''; position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        .btn-submit-bk:hover:not(:disabled)::before { left: 100%; }

        .form-note {
            background: linear-gradient(135deg, #EEF3FD 0%, #f8faff 100%);
            border-left: 4px solid var(--bk-primary);
            padding: 0.85rem 1rem; border-radius: 10px;
            font-size: 0.85rem; color: var(--bk-text); margin-top: 1rem;
        }
        .form-note i { color: var(--bk-primary); margin-right: 0.4rem; }

        @media (max-width: 991px) {
            .booking-left, .booking-right { padding: 1.75rem; }
            .form-section-bk { padding: 1.25rem; }
        }
        @media (max-width: 575px) { .pill-option { min-width: 100%; } }
    </style>

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

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center text-white">
                    <div class="hero-badge mx-auto">
                        <i class="fas fa-calendar-check"></i>
                        Book your dermatologist consultation in a few clicks
                    </div>
                    <h1>
                        Schedule an appointment
                        <em>with a trusted skin specialist.</em>
                    </h1>
                    <p>Complete your appointment request and our team will confirm your booking. If you selected a doctor, we'll keep them in focus for you.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== BOOKING CARD ===== --}}
    <section class="booking-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-11">
                    <div class="booking-card-modern">
                        <div class="row g-0">

                            {{-- ====== LEFT PANEL ====== --}}
                            <div class="col-lg-5 booking-left">
                                <div class="panel-badge">
                                    <i class="fas fa-stethoscope"></i> Appointment details
                                </div>

                                @if($selectedDoctor)
                                    <h2 class="panel-title">Your selected specialist</h2>
                                    <p class="panel-info">You've chosen this doctor from our directory. Confirm your details on the right to complete your booking.</p>

                                    <div class="doctor-card-modern">
                                        <div class="doctor-card-header">
                                            <img src="{{ asset('storage/'.$selectedDoctor->dermatologist->profile_image) }}"
                                                 alt="{{ $selectedDoctor->name }}"
                                                 class="doctor-avatar-modern" />
                                            <div class="doctor-info-modern">
                                                <strong>{{ $selectedDoctor->name }}</strong>
                                                <span class="specialty">{{ $selectedDoctor->dermatologist->specialization }}</span>
                                            </div>
                                        </div>
                                        <div class="doctor-meta-row">
                                            <i class="fas fa-hospital"></i> {{ $selectedDoctor->dermatologist->clinic_address }}
                                        </div>
                                        <div class="doctor-meta-row">
                                            <i class="fas fa-award"></i> {{ $selectedDoctor->dermatologist->experience_year }} experience
                                        </div>
                                        <div class="doctor-meta-row">
                                            <i class="fas fa-users"></i> Max 15 appointments per day
                                        </div>
                                    </div>

                                    <div class="panel-note">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Want a different provider? <a href="#" class="text-white text-decoration-underline">Return to the directory</a> and pick another specialist.
                                    </div>
                                @else
                                    <h2 class="panel-title">Request an appointment</h2>
                                    <p class="panel-info">Submit your details and we'll match you with one of our verified dermatologists, or you can pick a specific specialist from our directory.</p>

                                    <ul class="benefits-list">
                                        <li><i class="fas fa-check"></i> Verified, licensed dermatologists</li>
                                        <li><i class="fas fa-check"></i> Confirmation within 24 hours</li>
                                        <li><i class="fas fa-check"></i> Flexible appointment slots</li>
                                        <li><i class="fas fa-check"></i> Secure & private consultations</li>
                                    </ul>

                                    <div class="panel-note">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Have a preferred dermatologist? <a href="#" class="text-white text-decoration-underline">Browse the directory</a> first.
                                    </div>
                                @endif
                            </div>

                            {{-- ====== RIGHT FORM PANEL ====== --}}
                            <div class="col-lg-7 booking-right">
                                <h3 class="form-title-modern">Appointment request</h3>
                                <p class="form-subtitle-modern">Fill out the form and we'll send a confirmation shortly.</p>

                                {{-- ⭐ NEW: General Error Banner at Top of Form --}}
                                @if ($errors->any())
                                    <div class="alert-validation-bk">
                                        <div class="alert-validation-bk-icon">
                                            <i class="fas fa-circle-exclamation"></i>
                                        </div>
                                        <div class="alert-validation-bk-content">
                                            <strong>Please fix the following {{ $errors->count() > 1 ? 'errors' : 'error' }}:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST" novalidate>
                                    @csrf
                                    <input type="hidden" name="dermatologist_id" value="{{ old('dermatologist_id', $selectedDoctor->dermatologist->id ?? '') }}">

                                    {{-- ====== SECTION 1: PATIENT INFO ====== --}}
                                    <div class="form-section-bk">
                                        <div class="section-header-bk">
                                            <span class="section-number-bk">1</span>
                                            <div>
                                                <h5 class="section-heading-bk">Patient Information</h5>
                                                <span class="section-sub-bk">Who is the appointment for?</span>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label-bk">Full Name <span class="required">*</span></label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-user input-icon"></i>
                                                    <input type="text" name="patient_name"
                                                           class="form-control-bk @error('patient_name') is-invalid @enderror"
                                                           placeholder="e.g. Sara Ahmed"
                                                           value="{{ old('patient_name') }}" required>
                                                </div>
                                                @error('patient_name')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label-bk">Email Address <span class="required">*</span></label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-envelope input-icon"></i>
                                                    <input type="email" name="patient_email"
                                                           class="form-control-bk @error('patient_email') is-invalid @enderror"
                                                           placeholder="you@example.com"
                                                           value="{{ old('patient_email') }}" required>
                                                </div>
                                                @error('patient_email')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label-bk">Phone Number <span class="required">*</span></label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-phone input-icon"></i>
                                                    <input type="tel" name="patient_phone"
                                                           class="form-control-bk @error('patient_phone') is-invalid @enderror"
                                                           placeholder="+92 300 123 4567"
                                                           value="{{ old('patient_phone') }}" required>
                                                </div>
                                                @error('patient_phone')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label-bk">Preferred contact method</label>
                                                <div class="pill-group @error('preferred_contact') is-invalid @enderror">
                                                    <label class="pill-option">
                                                        <input type="radio" name="preferred_contact" value="phone" {{ old('preferred_contact', 'phone') == 'phone' ? 'checked' : '' }}>
                                                        <span class="pill-label"><i class="fas fa-phone"></i> Phone</span>
                                                    </label>
                                                    <label class="pill-option">
                                                        <input type="radio" name="preferred_contact" value="email" {{ old('preferred_contact') == 'email' ? 'checked' : '' }}>
                                                        <span class="pill-label"><i class="fas fa-envelope"></i> Email</span>
                                                    </label>
                                                    <label class="pill-option">
                                                        <input type="radio" name="preferred_contact" value="whatsapp" {{ old('preferred_contact') == 'whatsapp' ? 'checked' : '' }}>
                                                        <span class="pill-label"><i class="fab fa-whatsapp"></i> WhatsApp</span>
                                                    </label>
                                                </div>
                                                @error('preferred_contact')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="check-wrap">
                                                    <input type="checkbox" id="newPatient" name="is_new_patient" value="1" {{ old('is_new_patient') ? 'checked' : '' }}>
                                                    <label for="newPatient"><i class="fas fa-user-plus me-1 text-primary"></i> I'm a new patient (first-time visit)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ====== SECTION 2: APPOINTMENT DETAILS ====== --}}
                                    <div class="form-section-bk">
                                        <div class="section-header-bk">
                                            <span class="section-number-bk">2</span>
                                            <div>
                                                <h5 class="section-heading-bk">Appointment Details</h5>
                                                <span class="section-sub-bk">Pick a date, time, and visit type</span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label-bk">Visit Type <span class="required">*</span></label>
                                            <div class="pill-group @error('appointment_type') is-invalid @enderror">
                                                <label class="pill-option">
                                                    <input type="radio" name="appointment_type" value="consultation" {{ old('appointment_type', 'consultation') == 'consultation' ? 'checked' : '' }}>
                                                    <span class="pill-label"><i class="fas fa-comments"></i> Consultation</span>
                                                </label>
                                                <label class="pill-option">
                                                    <input type="radio" name="appointment_type" value="follow_up" {{ old('appointment_type') == 'follow_up' ? 'checked' : '' }}>
                                                    <span class="pill-label"><i class="fas fa-redo"></i> Follow-up</span>
                                                </label>
                                                <label class="pill-option">
                                                    <input type="radio" name="appointment_type" value="treatment" {{ old('appointment_type') == 'treatment' ? 'checked' : '' }}>
                                                    <span class="pill-label"><i class="fas fa-syringe"></i> Treatment</span>
                                                </label>
                                                <label class="pill-option">
                                                    <input type="radio" name="appointment_type" value="emergency" {{ old('appointment_type') == 'emergency' ? 'checked' : '' }}>
                                                    <span class="pill-label"><i class="fas fa-exclamation-circle"></i> Emergency</span>
                                                </label>
                                            </div>
                                            @error('appointment_type')
                                            <div class="input-error-bk">
                                                <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label-bk">Preferred Date <span class="required">*</span></label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-calendar-alt input-icon"></i>
                                                    <input type="date" name="appointment_date" id="appointmentDate"
                                                           class="form-control-bk @error('appointment_date') is-invalid @enderror"
                                                           value="{{ old('appointment_date') }}" required>
                                                </div>
                                                @error('appointment_date')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror

                                                <div class="availability-status" id="availabilityStatus">
                                                    <span id="availabilityText"></span>
                                                    <div class="progress-bar-tiny"><div class="fill" id="availabilityFill"></div></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-bk">Preferred Time <span class="required">*</span></label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-clock input-icon"></i>
                                                    <input type="time" name="appointment_time" id="appointmentTime"
                                                           class="form-control-bk @error('appointment_time') is-invalid @enderror"
                                                           value="{{ old('appointment_time') }}" required>
                                                </div>
                                                @error('appointment_time')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label-bk">Primary Skin Concern</label>
                                                <div class="input-wrap">
                                                    <i class="fas fa-notes-medical input-icon"></i>
                                                    <select name="concern_category"
                                                            class="form-select-bk @error('concern_category') is-invalid @enderror">
                                                        <option value="">Select concern (optional)</option>
                                                        <option value="acne" {{ old('concern_category') == 'acne' ? 'selected' : '' }}>Acne / Pimples</option>
                                                        <option value="eczema" {{ old('concern_category') == 'eczema' ? 'selected' : '' }}>Eczema</option>
                                                        <option value="psoriasis" {{ old('concern_category') == 'psoriasis' ? 'selected' : '' }}>Psoriasis</option>
                                                        <option value="rosacea" {{ old('concern_category') == 'rosacea' ? 'selected' : '' }}>Rosacea</option>
                                                        <option value="hair_loss" {{ old('concern_category') == 'hair_loss' ? 'selected' : '' }}>Hair Loss</option>
                                                        <option value="pigmentation" {{ old('concern_category') == 'pigmentation' ? 'selected' : '' }}>Pigmentation / Melasma</option>
                                                        <option value="aging" {{ old('concern_category') == 'aging' ? 'selected' : '' }}>Anti-aging</option>
                                                        <option value="allergy" {{ old('concern_category') == 'allergy' ? 'selected' : '' }}>Skin Allergy</option>
                                                        <option value="other" {{ old('concern_category') == 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                                @error('concern_category')
                                                <div class="input-error-bk">
                                                    <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ====== SECTION 3: ADDITIONAL NOTES ====== --}}
                                    <div class="form-section-bk">
                                        <div class="section-header-bk">
                                            <span class="section-number-bk">3</span>
                                            <div>
                                                <h5 class="section-heading-bk">Additional Notes</h5>
                                                <span class="section-sub-bk">Anything else the doctor should know?</span>
                                            </div>
                                        </div>

                                        <label class="form-label-bk">Describe your concern</label>
                                        <textarea name="notes"
                                                  class="form-control-bk no-icon @error('notes') is-invalid @enderror"
                                                  rows="4"
                                                  placeholder="Briefly tell us your symptoms, how long you've had them, any current medications, or anything else relevant...">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <div class="input-error-bk">
                                            <i class="fas fa-circle-exclamation"></i> {{ $message }}
                                        </div>
                                        @enderror

                                        <div class="form-note">
                                            <i class="fas fa-lock"></i>
                                            <strong>Privacy notice:</strong> Your information is encrypted and shared only with the consulting dermatologist.
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <button type="submit" id="submitBtn" class="btn-submit-bk">
                                        <i class="fas fa-paper-plane me-2"></i> Request Appointment
                                    </button>

                                    <p class="text-center mt-3 mb-0 small text-muted">
                                        By submitting, you agree to our
                                        <a href="#" class="text-primary fw-semibold">Terms</a> and
                                        <a href="#" class="text-primary fw-semibold">Privacy Policy</a>.
                                    </p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Auto-dismiss toast notifications after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.toast-custom').forEach(t => t.remove());
            }, 5000);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const MAX_APPOINTMENTS_PER_DAY = 15;
                const dateInput     = document.getElementById('appointmentDate');
                const timeInput     = document.getElementById('appointmentTime');
                const submitBtn     = document.getElementById('submitBtn');
                const statusBox     = document.getElementById('availabilityStatus');
                const statusText    = document.getElementById('availabilityText');
                const statusFill    = document.getElementById('availabilityFill');

                const doctorIdInput = document.querySelector('input[name="dermatologist_id"]');
                const doctorId      = doctorIdInput ? doctorIdInput.value : null;

                // Min date = today
                if (dateInput) {
                    dateInput.min = new Date().toISOString().split('T')[0];
                }

                function setStatus(type, message, count = null) {
                    statusBox.className = 'availability-status show ' + type;
                    statusText.innerHTML = message;

                    const bar = statusBox.querySelector('.progress-bar-tiny');
                    if (count !== null && type === 'available') {
                        statusFill.style.width = ((count / MAX_APPOINTMENTS_PER_DAY) * 100) + '%';
                        bar.style.display = 'block';
                    } else if (type === 'full') {
                        statusFill.style.width = '100%';
                        bar.style.display = 'block';
                    } else {
                        bar.style.display = 'none';
                    }
                }

                function hideStatus() { statusBox.classList.remove('show'); }

                function lockSubmit(locked) {
                    submitBtn.disabled = locked;
                    timeInput.disabled = locked;
                }

                async function checkAvailability(date) {
                    if (!date || !doctorId) { hideStatus(); lockSubmit(false); return; }

                    setStatus('checking', '<span class="spinner-tiny"></span> Checking availability…');
                    lockSubmit(true);

                    try {
                        const url = `/appointments/check-availability?dermatologist_id=${encodeURIComponent(doctorId)}&date=${encodeURIComponent(date)}`;
                        const res = await fetch(url, {
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                        });

                        if (!res.ok) throw new Error('Request failed');
                        const data = await res.json();

                        const booked    = data.booked ?? 0;
                        const remaining = MAX_APPOINTMENTS_PER_DAY - booked;

                        if (remaining <= 0) {
                            setStatus('full',
                                `<i class="fas fa-times-circle"></i> Fully booked (${booked}/${MAX_APPOINTMENTS_PER_DAY}). Please pick another date.`
                            );
                            lockSubmit(true);
                        } else {
                            setStatus('available',
                                `<i class="fas fa-check-circle"></i> ${remaining} slot${remaining === 1 ? '' : 's'} left (${booked}/${MAX_APPOINTMENTS_PER_DAY} booked)`,
                                booked
                            );
                            lockSubmit(false);
                        }
                    } catch (err) {
                        console.warn('Availability check failed:', err);
                        hideStatus();
                        lockSubmit(false);
                    }
                }

                if (dateInput) {
                    dateInput.addEventListener('change', e => checkAvailability(e.target.value));

                    // If old date is set (after validation error), re-check availability
                    if (dateInput.value) {
                        checkAvailability(dateInput.value);
                    }
                }

                document.getElementById('appointmentForm').addEventListener('submit', function(e) {
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        alert('This date is fully booked. Please select another date.');
                    }
                });

                // Scroll to first error if there are validation errors
                const firstError = document.querySelector('.is-invalid, .alert-validation-bk');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>
    @endpush

@endsection
