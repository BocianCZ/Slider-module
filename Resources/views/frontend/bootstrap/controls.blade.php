@if($slider->activeSlides->count() > 1)
    <a class="left carousel-control" href="#{{ $slider->system_name }}" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('slider::frontend.previous') }}</span>
    </a>
    <a class="right carousel-control" href="#{{ $slider->system_name }}" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">{{ trans('slider::frontend.next') }}</span>
    </a>
@endif
