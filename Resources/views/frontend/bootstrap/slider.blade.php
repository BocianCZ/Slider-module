<div id="{{ $slider->system_name }}" class="carousel slide" data-ride="carousel">
    @include('slider::frontend.bootstrap.indicators', ['slider' => $slider])
    <div class="carousel-inner" role="listbox">
        @include('slider::frontend.bootstrap.slides', ['slider' => $slider])
    </div>
    @include('slider::frontend.bootstrap.controls', ['slider' => $slider])
</div>