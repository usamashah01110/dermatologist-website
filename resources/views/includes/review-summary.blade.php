{{--
    Average-rating pill for a section header, computed from the `rating`
    column of whatever review collection it is handed.

    Usage: @include('includes.review-summary', ['reviews' => $reviews])
--}}
@if(isset($reviews) && $reviews->count() > 0)
    @php
        $rvAvg      = round($reviews->avg('rating') ?? 0, 1);
        $rvTotal    = $reviews->count();
        $rvVerified = $reviews->whereNotNull('patient_id')->count();
    @endphp

    <div class="rv-summary">
        <span class="rv-summary-score">{{ number_format($rvAvg, 1) }}</span>

        <span class="rv-summary-stars" role="img" aria-label="Average rating {{ $rvAvg }} out of 5">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= round($rvAvg) ? '' : 'rv-star-off' }}"
                   style="color: {{ $i <= round($rvAvg) ? '#f5b301' : '#dfe6ec' }};"></i>
            @endfor
        </span>

        <span class="rv-summary-divider"></span>

        <span class="rv-summary-count">
            <strong>{{ $rvTotal }} {{ Str::plural('review', $rvTotal) }}</strong>
            @if($rvVerified > 0)
                {{ $rvVerified }} from verified patients
            @else
                from our patients
            @endif
        </span>
    </div>
@endif
