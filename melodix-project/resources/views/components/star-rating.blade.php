@props([
    'rating' => 0,
    'showValue' => true,
])

@php
    $numericRating = max(0, min(5, (float) $rating));
    $filledStars = (int) round($numericRating);
@endphp

<span class="stars rating-component" aria-label="{{ number_format($numericRating, 1) }} out of 5 stars">
    @for ($star = 1; $star <= 5; $star++)
        <i class="bi {{ $star <= $filledStars ? 'bi-star-fill' : 'bi-star' }}" aria-hidden="true"></i>
    @endfor
    @if ($showValue)
        <span class="rating-value">{{ number_format($numericRating, 1) }}</span>
    @endif
</span>
