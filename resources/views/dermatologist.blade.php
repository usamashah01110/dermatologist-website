@extends('includes.main')

@section('content')
<section class="hero">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-8 text-center text-white">
        <div class="hero-badge mx-auto">
          <i class="fas fa-user-md"></i>
          Find the right dermatologist for your skin journey
        </div>
        <h1>
          Browse certified dermatologists
          <em>and book your appointment instantly.</em>
        </h1>
        <p>Explore our trusted network of skin specialists across Pakistan with verified experience, patient ratings, and specialty care.</p>
        <a href="#search" class="btn-hero-primary">
          <i class="fas fa-search"></i> Search Dermatologists
        </a>
      </div>
    </div>
  </div>
</section>

<section class="doctors-section" id="search">
  <div class="container">
    <div class="doctors-header">
      <div>
        <span class="section-label">Dermatologists</span>
        <h2>Search doctors by specialty, location or name.</h2>
      </div>
      <input id="doctorSearch" type="search" class="search-input" placeholder="Search dermatologists, conditions, cities..." aria-label="Search dermatologists" />
    </div>

    <div class="row g-4" id="doctorGrid">
      @foreach($doctors as $doctor)
      <div class="col-md-6 col-lg-4 doctor-card-wrapper">
        <article class="doctor-card" data-search="{{ strtolower($doctor['name'].' '.$doctor['specialty'].' '.$doctor['focus'].' '.$doctor['clinic']) }}">
          <img src="{{ $doctor['image'] }}" alt="{{ $doctor['name'] }}" class="doctor-avatar" />
          <h5>{{ $doctor['name'] }}</h5>
          <div class="doctor-meta">
            <span><i class="fas fa-stethoscope"></i> {{ $doctor['specialty'] }}</span>
            <span><i class="fas fa-map-marker-alt"></i> {{ $doctor['clinic'] }}</span>
          </div>
          <p>{{ $doctor['focus'] }}</p>
          <div class="doctor-tags">
            <span class="doctor-tag"><i class="fas fa-star"></i> {{ $doctor['rating'] }} Rating</span>
            <span class="doctor-tag"><i class="fas fa-briefcase"></i> {{ $doctor['experience'] }}</span>
          </div>
          <a href="{{ route('booking.page', ['doctor' => $doctor['name']]) }}" class="btn-doctor">
            <i class="fas fa-calendar-check"></i> Book Appointment
          </a>
        </article>
      </div>
      @endforeach
    </div>

    <div class="no-results d-none" id="noResults">
      <p>No dermatologists match your search. Try another specialty or location.</p>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('doctorSearch');
    const doctorCards = Array.from(document.querySelectorAll('.doctor-card-wrapper'));
    const noResults = document.getElementById('noResults');

    function updateDoctorSearch() {
      const query = searchInput.value.trim().toLowerCase();
      let visibleCount = 0;

      doctorCards.forEach(card => {
        const doctorCard = card.querySelector('.doctor-card');
        const searchText = doctorCard.dataset.search || '';
        const match = searchText.includes(query);
        card.style.display = match ? 'block' : 'none';
        if (match) visibleCount += 1;
      });

      noResults.classList.toggle('d-none', visibleCount > 0);
    }

    searchInput.addEventListener('input', updateDoctorSearch);
  });
</script>
@endsection
