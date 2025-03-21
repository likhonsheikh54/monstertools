@props([
    'tool' => false,
])
<div {!! $attributes->merge(['class' => 'wrap-content', 'id']) !!}>
    <x-slot name="herotitle">
        <div class="hero-title ps-3 bg-white">
            <div class="tool-favorite-btn">
                <button
                    class="btn btn-outline-primary rounded-circle add-fav  @if (Auth::check()) add-favorite-btn @endif @if (Auth::check() && $tool->hasBeenFavoritedBy(Auth::user())) active @endif"
                    data-id="{{ $tool->id }}" type="button" id="button"
                    data-url="{{ route('tool.favouriteAction') }}"
                    @if (!Auth::check()) onclick="window.location.href=`{{ route('login') }}`;" @endif>
                    <i class="an an-heart"></i>
                </button>
            </div>
            @if (!empty($tool->name))
                <h1>{{ $tool->name }}</h1>
            @endif
            @if (!empty($tool->description))
                <p>{{ $tool->description ?? '' }}</p>
            @endif
        </div>
    </x-slot>
    {{ $slot }}
</div>
