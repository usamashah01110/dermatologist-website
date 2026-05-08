@extends('includes.main')

@section('content')

    <style>
        .doctors-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .doctors-header h2{
            margin: 0;
            max-width: 700px;
        }

        .search-input{
            width: 520px;
            max-width: 100%;
            height: 60px;
            border: 2px solid #1f1f1f;
            border-radius: 18px;
            padding: 0 20px;
            font-size: 18px;
            outline: none;
            background: #fff;
        }

        @media (max-width: 991px){

            .doctors-header{
                flex-direction: column;
                align-items: flex-start;
            }

            .search-input{
                width: 100%;
            }
        }
    </style>
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

                <article
                    class="doctor-card"
                    data-search="{{ strtolower(
                        $doctor->user->name . ' ' .
                        $doctor->specialization . ' ' .
                        $doctor->qualification . ' ' .
                        $doctor->clinic_address
                    ) }}"
                >

                    <img
                        src="{{ asset('storage/' . $doctor->profile_image) }}"
                        alt="{{ $doctor->user->name }}"
                        class="doctor-avatar"
                    />

                    <h5>{{ $doctor->user->name }}</h5>

                    <div class="doctor-meta">

            <span>
                <i class="fas fa-stethoscope"></i>
                {{ $doctor->specialization }}
            </span>

                        <span>
                <i class="fas fa-map-marker-alt"></i>
                {{ $doctor->city }}
            </span>

                    </div>

                    <p>
                        {{ $doctor->qualification }}
                    </p>

                    <div class="doctor-tags">

            <span class="doctor-tag">
                <i class="fas fa-briefcase"></i>
                {{ $doctor->experience_year }} Experience
            </span>

                        <span class="doctor-tag">
                <i class="fas fa-user-check"></i>
                {{ ucfirst($doctor->status) }}
            </span>

                    </div>

                    <a
                        href="{{ route('dermatologist.detail', $doctor->id) }}"
                        class="btn-doctor"
                    >
                        <i class="fas fa-user-doctor"></i>
                        View Profile
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
