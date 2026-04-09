@extends('includes.main')

@section('content')
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
        <p>Complete your appointment request and our team will confirm your booking. If you selected a doctor, we’ll keep them in focus for you.</p>
      </div>
    </div>
  </div>
</section>

<section class="appointment-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <div class="booking-card">
          <div class="row g-5">
            <div class="col-lg-5">
              <div class="booking-badge">Appointment details</div>
              <h2>Tell us about your booking</h2>
              <p class="booking-info">Fill out the form to request an appointment. We will review your request and send a confirmation with available consultation times.</p>

              @if($selectedDoctor)
              <div class="booking-doctor-card">
                <img src="{{ $selectedDoctor['image'] }}" alt="{{ $selectedDoctor['name'] }}" class="booking-doctor-avatar" />
                <div class="booking-doctor-meta">
                  <strong>{{ $selectedDoctor['name'] }}</strong>
                  <span>{{ $selectedDoctor['specialty'] }}</span>
                  <span>{{ $selectedDoctor['clinic'] }}</span>
                  <span>{{ $selectedDoctor['experience'] }} experience</span>
                </div>
              </div>
              <p class="booking-note">You selected this doctor from the Dermatologists page. If you want a different provider, return to the directory and choose another specialist.</p>
              @else
              <p class="booking-note">If you have a preferred dermatologist, choose them from the Dermatologists page and then request an appointment here.</p>
              @endif
            </div>

            <div class="col-lg-7">
              <h3>Appointment request</h3>
              <form>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="patientName" class="form-label">Full Name</label>
                    <input type="text" id="patientName" class="form-control" placeholder="Your full name" required />
                  </div>
                  <div class="col-md-6">
                    <label for="patientEmail" class="form-label">Email Address</label>
                    <input type="email" id="patientEmail" class="form-control" placeholder="you@example.com" required />
                  </div>
                  <div class="col-md-6">
                    <label for="patientPhone" class="form-label">Phone Number</label>
                    <input type="tel" id="patientPhone" class="form-control" placeholder="+92 300 123 4567" required />
                  </div>
                  <div class="col-md-6">
                    <label for="appointmentDate" class="form-label">Preferred Date</label>
                    <input type="date" id="appointmentDate" class="form-control" required />
                  </div>
                  <div class="col-12">
                    <label for="appointmentTime" class="form-label">Preferred Time</label>
                    <input type="time" id="appointmentTime" class="form-control" required />
                  </div>
                  <div class="col-12">
                    <label for="patientMessage" class="form-label">Brief Message</label>
                    <textarea id="patientMessage" class="form-control" placeholder="Tell us your skin concern or reason for the appointment" rows="5"></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn-register">Request Appointment</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
