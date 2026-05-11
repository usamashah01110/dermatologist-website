@extends('includes.main')

@push('styles')

@endpush

@section('content')

<!-- UI section: left side image aur right side text, jaisa screenshot me dikh raha hai -->
<section class="skincare-hero">
  <div class="container">
    
    <div class="hero-grid">
      <div class="hero-copy">
        <h1>Science-backed Treatments <em>Glow ready results</em></h1>
        <p> we provide information on various skin services backed by scientific evidence. Our goal is to guide you through professional treatments so you can make informed decisions for your unique skin type and connect with trusted dermatologists</p>
         
      </div>
       
    </div>
  </div>
</section>

<!-- Featured article section with same UI style: ek taraf image aur dosri taraf content -->
<section class="featured-section">
  <div class="container">
    <div class="featured-card">
      <div class="featured-row">
        <div class="featured-media">
          <img src="{{ asset( $featured->image_path) }}"
               alt="HydraFacial treatment"
               loading="lazy"
               style="height: 200px; object-fit: cover; width: 100%;">
        </div>
        <div class="featured-details">
          <h2>{{ $featured->title }}</h2>
          <p>{{ $featured->content }}</p>
          <div class="article-meta"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Yahan loop laga raha hoon taake public skincare page par DB se save articles dikhayen -->
<section class="articles-section">
  <div class="container">
    <div class="section-heading text-center mb-5">
      <span class="section-label">Explore more</span>
      <h2>Latest Skincare Articles</h2>
      <p>Browse our complete library of dermatologist-reviewed skincare guides.</p>
    </div>
    <div class="row g-4">
      @forelse($articles as $article)
      <div class="col-md-6 col-lg-6">
        <article class="article-card" style="border: 1px solid #ddd; border-radius: 8px;">
          <div class="article-image">
            <img src="{{ asset($article->image_path ?? 'https://images.unsplash.com/photo-1587502536263-3ff3a90ac499?w=600&q=80&fit=crop') }}" alt="{{ $article->title }}" loading="lazy" style="height: 200px; object-fit: cover;">
          </div>
          <div class="article-content">
            <span class="article-category"><i class="fas fa-heart"></i> Skincare</span>
            <h5>{{ $article->title }}</h5>
            <p>{!! nl2br(e($article->content)) !!}</p>
          </div>
        </article>
      </div>
      @empty
      <div class="col-12">
        <div class="alert alert-info">Koi article available nahi hai. Admin dashboard se naya skincare article add karein.</div>
      </div>
      @endforelse
    </div>
  </div>
</section>

<section class="newsletter-section">
  <div class="container">
    <div class="newsletter-card">
      <div class="newsletter-icon"><i class="fas fa-envelope-open-text"></i></div>
      <h3>Skincare Tips, Straight to Your Inbox</h3>
      <p>Get weekly expert advice, new article alerts, and exclusive treatment guides — written by dermatologists, free forever.</p>
      <div class="newsletter-form">
        <input type="email" placeholder="Enter your email address">
        <button type="button"><i class="fas fa-paper-plane me-2"></i>Subscribe</button>
      </div>
    </div>
  </div>
</section>

@endsection
