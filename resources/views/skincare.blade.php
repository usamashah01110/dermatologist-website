@extends('includes.main')

@push('styles')

@endpush

@section('content')

<!-- ── HERO ─────────────────────────────────────────── -->
<section class="skincare-hero">
  <div class="container">
    <div class="hero-badge">
      <i class="fas fa-spa"></i>
      Expert-Curated Skincare Knowledge
    </div>
    <h1>Discover the Science of <em>Healthy Skin</em></h1>
    <p>Evidence-based articles, treatment guides, and expert tips from board-certified dermatologists — written to help you make informed choices about your skin.</p>

    <div class="hero-search">
      <i class="fas fa-magnifying-glass"></i>
      <input type="text" placeholder="Search articles, tips, or skin conditions...">
      <button type="button" aria-label="Search"><i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</section>

<!-- ── CATEGORY FILTER BAR ──────────────────────────── -->
<div class="category-bar">
  <div class="container">
    <div class="category-pills">
      <a href="#" class="category-pill active"><i class="fas fa-grip"></i> All Topics</a>
      <a href="#" class="category-pill"><i class="fas fa-face-frown-open"></i> Acne Care</a>
      <a href="#" class="category-pill"><i class="fas fa-clock-rotate-left"></i> Anti-Aging</a>
      <a href="#" class="category-pill"><i class="fas fa-droplet"></i> Hydration</a>
      <a href="#" class="category-pill"><i class="fas fa-sun"></i> Sun Protection</a>
      <a href="#" class="category-pill"><i class="fas fa-shield-heart"></i> Sensitive Skin</a>
      <a href="#" class="category-pill"><i class="fas fa-list-check"></i> Routines</a>
      <a href="#" class="category-pill"><i class="fas fa-flask"></i> Ingredients</a>
    </div>
  </div>
</div>

<!-- ── FEATURED ARTICLE ─────────────────────────────── -->
<section class="featured-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label">Editor's Pick</span>
      <h2 class="section-title">Featured This Week</h2>
    </div>

    <div class="featured-card">
      <div class="row g-0">
        <div class="col-lg-6">
          <div class="featured-image">
            <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
            <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=900&q=80&fit=crop" alt="Skincare routine essentials">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="featured-content">
            <span class="featured-category"><i class="fas fa-list-check"></i> Routines</span>
            <h2>The Complete Guide to Building Your First Skincare Routine</h2>
            <p>Confused by endless products and conflicting advice? Our dermatologists break down the only four steps you really need — and the order that actually matters for visible results within 30 days.</p>

            <div class="article-meta">
              <div class="article-meta-author">
                <div class="article-meta-avatar">FK</div>
                <div>
                  <strong>Dr. Fatima Khan</strong>
                  <span>Dermatologist</span>
                </div>
              </div>
              <div class="article-meta-divider"></div>
              <span class="article-meta-item"><i class="far fa-calendar"></i> Apr 28, 2026</span>
              <div class="article-meta-divider"></div>
              <span class="article-meta-item"><i class="far fa-clock"></i> 8 min read</span>
            </div>

            <a href="{{ route('skincare.detail') }}" class="btn-read">
              Read Full Article <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── ARTICLES GRID ────────────────────────────────── -->
<section class="articles-section">
  <div class="container">

    <div class="articles-header">
      <div class="articles-header-text">
        <h2>Latest Skincare Articles</h2>
        <p>Browse our complete library of dermatologist-reviewed skincare guides.</p>
      </div>
      <span class="articles-count">9 articles</span>
    </div>

    <div class="row g-4">

      <!-- Article 1 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-face-frown-open"></i> Acne Care</span>
            <img src="https://images.unsplash.com/photo-1631730486572-226d1f595b68?w=600&q=80&fit=crop" alt="Acne treatment" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Understanding Acne: Causes, Types, and Modern Treatment Options</h5>
            <p>From hormonal breakouts to cystic acne, learn what's really triggering your skin and the evidence-based treatments that actually work for each type.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">AS</div>
                <span>Apr 22, 2026</span>
              </div>
              <a href="{{ route('skincare.detail') }}" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 2 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-clock-rotate-left"></i> Anti-Aging</span>
            <img src="https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?w=600&q=80&fit=crop" alt="Retinol skincare" loading="lazy">
          </div>
          <div class="article-content">
            <h5>The Truth About Retinol: Benefits, Side Effects, and How to Use It</h5>
            <p>Retinol is the most studied anti-aging ingredient on the planet — but using it wrong can wreck your barrier. Here's the dermatologist-approved way to start.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">RM</div>
                <span>Apr 18, 2026</span>
              </div>
              <a href="{{ route('skincare.detail') }}" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 3 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-droplet"></i> Hydration</span>
            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&q=80&fit=crop" alt="Hyaluronic acid" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Why Hyaluronic Acid Is the Hydration Hero Your Skin Needs</h5>
            <p>This single ingredient holds 1,000 times its weight in water. Learn how to layer it correctly with other actives for plump, dewy skin every morning.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">SA</div>
                <span>Apr 15, 2026</span>
              </div>
              <a href="{{ route('skincare.detail') }}" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 4 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-sun"></i> Sun Protection</span>
            <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80&fit=crop" alt="Sunscreen" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Sunscreen 101: Choosing the Right SPF for Your Skin Type</h5>
            <p>Mineral or chemical? SPF 30 or 50? Learn the differences that actually matter and how to pick a sunscreen you'll actually want to wear daily.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">HZ</div>
                <span>Apr 12, 2026</span>
              </div>
              <a href="{{ route('skincare.detail') }}" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 5 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-shield-heart"></i> Sensitive Skin</span>
            <img src="https://images.unsplash.com/photo-1570554886111-e80fcca6a029?w=600&q=80&fit=crop" alt="Sensitive skincare" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Sensitive Skin? Here's How to Build a Truly Gentle Routine</h5>
            <p>Stinging, redness, and reactions don't have to be normal. Discover the calming ingredients dermatologists recommend and the ones to avoid completely.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">NH</div>
                <span>Apr 08, 2026</span>
              </div>
              <a href="{{ route('skincare.detail') }}" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 6 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-flask"></i> Ingredients</span>
            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=600&q=80&fit=crop" alt="Vitamin C serum" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Vitamin C Serums: Brightening Benefits and Best Practices</h5>
            <p>The gold standard for radiance, dark spots, and antioxidant protection — but stability and pH matter more than concentration. Here's what to look for.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">BK</div>
                <span>Apr 05, 2026</span>
              </div>
              <a href="#" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 7 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-list-check"></i> Routines</span>
            <img src="https://images.unsplash.com/photo-1612817288484-6f916006741a?w=600&q=80&fit=crop" alt="Night routine" loading="lazy">
          </div>
          <div class="article-content">
            <h5>The 5-Step Night Routine That Transforms Skin While You Sleep</h5>
            <p>Your skin repairs itself overnight — these dermatologist-approved steps maximise that natural process for visibly smoother, firmer skin by morning.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">FK</div>
                <span>Apr 02, 2026</span>
              </div>
              <a href="#" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 8 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-face-frown-open"></i> Acne Care</span>
            <img src="https://images.unsplash.com/photo-1607602132700-068258431c6c?w=600&q=80&fit=crop" alt="Salicylic acid" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Salicylic Acid vs Benzoyl Peroxide: Which Acne Fighter Wins?</h5>
            <p>Both are pharmacy staples, but they tackle acne in completely different ways. Here's how to choose — and combine them — for your specific breakout type.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">AS</div>
                <span>Mar 28, 2026</span>
              </div>
              <a href="#" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

      <!-- Article 9 -->
      <div class="col-md-6 col-lg-4">
        <article class="article-card">
          <div class="article-image">
            <span class="article-category-tag"><i class="fas fa-droplet"></i> Hydration</span>
            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=600&q=80&fit=crop" alt="Moisturizer" loading="lazy">
          </div>
          <div class="article-content">
            <h5>Decoding Moisturizers: Humectants, Emollients, and Occlusives</h5>
            <p>Not all moisturizers are created equal. Learn the three ingredient categories every formula needs and how to layer them for all-day hydration.</p>
            <div class="article-footer">
              <div class="article-author-mini">
                <div class="article-author-avatar">SA</div>
                <span>Mar 25, 2026</span>
              </div>
              <a href="#" class="article-read-link">Read <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
      </div>

    </div>
  </div>
</section>

<!-- ── NEWSLETTER ───────────────────────────────────── -->
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