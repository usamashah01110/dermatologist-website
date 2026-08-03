{{--
    Review card — renders one row of the `reviews` table.

    Usage:
        @include('includes.review-card', ['review' => $review])
        @include('includes.review-card', ['review' => $review, 'featured' => true])

    Columns used: rating, review_text, name, location, created_at, patient_id.
    Callers are expected to have filtered on status = approved.
--}}
@php
    // rating is a tinyint defaulting to 5 — clamp so a bad value can't break the row.
    $rvRating = max(1, min(5, (int) ($review->rating ?? 5)));

    $rvFeatured = $featured ?? false;

    // Initials from the stored name (no image column on the table).
    $rvInitials = collect(preg_split('/\s+/', trim((string) $review->name)))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
    $rvInitials = $rvInitials !== '' ? $rvInitials : '?';

    // Deterministic colour, so the same reviewer always gets the same avatar.
    $rvPalette = ['#1565c0', '#0d47a1', '#00897b', '#6a1b9a', '#ad1457', '#ef6c00', '#2e7d32', '#4527a0'];
    $rvColor   = $rvPalette[crc32((string) $review->name) % count($rvPalette)];

    // patient_id set => written by a registered patient; null => admin-added testimonial.
    $rvVerified = ! is_null($review->patient_id);
@endphp

<div class="rv-card {{ $rvFeatured ? 'rv-card--featured' : '' }}">
    <span class="rv-card-quote" aria-hidden="true">&ldquo;</span>

    <div class="rv-rating">
        <span class="rv-stars" role="img" aria-label="{{ $rvRating }} out of 5 stars">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $rvRating ? '' : 'rv-star-off' }}"></i>
            @endfor
        </span>
        <span class="rv-score">{{ number_format($rvRating, 1) }}</span>
    </div>

    <p class="rv-text">{{ $review->review_text }}</p>

    <div class="rv-footer">
        <span class="rv-avatar" style="background: {{ $rvColor }};" aria-hidden="true">{{ $rvInitials }}</span>

        <div class="rv-identity">
            <div class="rv-name">{{ $review->name }}</div>
            <div class="rv-meta">
                @if(filled($review->location))
                    <span><i class="fas fa-map-marker-alt"></i> {{ $review->location }}</span>
                @endif
                @if($review->created_at)
                    @if(filled($review->location))<span class="rv-meta-dot">&middot;</span>@endif
                    <span>{{ $review->created_at->format('d M Y') }}</span>
                @endif
            </div>
        </div>

        @if($rvVerified)
            <span class="rv-verified" title="Written by a registered patient">
                <i class="fas fa-circle-check"></i> Verified
            </span>
        @endif
    </div>
</div>
