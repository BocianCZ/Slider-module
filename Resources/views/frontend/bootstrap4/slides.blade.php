@foreach($slider->activeSlides as $index => $slide)
    <div class="carousel-item @if($index === 0) active @endif ">
        @if ($slide->isYoutubeVideo())
            @include('slider::frontend.bootstrap4.youtube-video-slide', ['slide' => $slide])
        @else
            <img class="d-block w-100" src="{!! $slide->getImageUrl() !!}" alt="{{ $slide->title }}">
            @if(!empty($slide->getLinkUrl()))
                <a href="{{ $slide->getLinkUrl() }}" target="{{ $slide->target }}">
            @endif
            <div class="carousel-caption d-none d-md-block">
                <h1>{{ $slide->title }}</h1>
                <span>
                    {{ $slide->caption }}
                </span>
            </div>
            @if(!empty($slide->getLinkUrl()))
                </a>
            @endif
        @endif
    </div>
@endforeach
