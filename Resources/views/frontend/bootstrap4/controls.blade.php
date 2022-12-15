@if($slider->activeSlides->count() > 1)
    <a class="carousel-control-prev" href="#{{ $slider->system_name }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('slider::frontend.previous') }}</span>
    </a>
    <a class="carousel-control-next" href="#{{ $slider->system_name }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('slider::frontend.next') }}</span>
    </a>
@endif
