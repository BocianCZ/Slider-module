@foreach($slider->activeSlides as $index => $slide)
    <div class="item @if($index === 0) active @endif ">
        <img src="{!! $slide->getImageUrl() !!}" alt="{{ $slide->title }}">
        @if(!empty($slide->getLinkUrl()))
            <a href="{{ $slide->getLinkUrl() }}" target="{{ $slide->target }}">
        @endif
        <div class="carousel-caption">
            <h1>{{ $slide->title }}</h1>
            <span>
                {{ $slide->caption }}
            </span>
        </div>
        @if(!empty($slide->getLinkUrl()))
            </a>
        @endif
    </div>
@endforeach
