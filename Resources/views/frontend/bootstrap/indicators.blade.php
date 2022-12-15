@if($slider->activeSlides->count() > 1)
    <ol class="carousel-indicators">
        @foreach($slider->slides as $index => $slide)
            <li data-target="#{{ $slider->system_name }}" data-slide-to="{{ $index }}"
                class="@if($index === 0) active @endif">{{ $index + 1 }}</li>
        @endforeach
    </ol>
@endif
