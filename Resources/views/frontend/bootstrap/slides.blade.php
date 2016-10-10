@foreach($slider->slides as $index => $slide)
    <div class="item @if($index === 0) active @endif ">
        <img src="{{ $slide->getImageUrl() }}" alt="{{ $slide->title }}">
        <div class="carousel-caption">
            <h1>{{ $slide->title }}</h1>
            <span>{{ $slide->caption }}</span>
        </div>
    </div>
@endforeach