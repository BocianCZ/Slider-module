<?php /** @var \Modules\Slider\Entities\Slide $slide */?>
<?php /** @see https://www.powderkegwebdesign.com/implementing-youtube-background-videos/ */ ?>
<style>
    * { box-sizing:border-box;  }
    #slider__slide-wrapper-{{ $slide->id }}  { text-align:center; position:relative; color:#ffffff; height:679px; overflow:hidden; }
    .slider__slide-yt-bg-image     { background-size:cover; background-position:center center; }
    .slider__yt-slide .slide-yt-overlay    { position:relative;height:100%; width:100%; z-index:2; }
    .slider__yt-slide .inner      { padding-top:50px; }
    /*h1      { color:#ffffff; margin:0 auto; }*/
    .slider__yt-slide .video_wrap   { height:100%; width:100%; position:absolute; left:0; overflow:hidden; top:0; padding-bottom:56.5%; }
    .slider__yt-slide iframe      { height:100%; position:absolute; width:100%; top:0; left:0; }
</style>

<script type="text/javascript">
    // Loads the YouTube IFrame API JavaScript code.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    // Inserts YouTube JS code into the page.
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    // onYouTubeIframeAPIReady() is called when the IFrame API is ready to go.
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('slider__player-{{ $slide->id }}', {
            height: '720',
            width: '1280',
            videoId: '{{ $slide->getYoutubeVideoId() }}',
            playerVars: { 'autoplay': 1, 'controls': 0, 'showinfo': 0, 'rel': 0, 'enablejsapi':1, 'wmode': 'transparent'},
            events : {
                'onReady' : pkOnPlayerReady,
                'onStateChange' : pkOnPlayerStateChange
            }
        });
    }

    function pkOnPlayerStateChange(e) {
        var frm = $(e.target.getIframe());
        if (e.data === YT.PlayerState.ENDED) {
            if ('slider__player-{{ $slide->id }}' === frm.attr('id')) {
                player.playVideo();
            }
        }
        if (e.data === YT.PlayerState.BUFFERING) {
            if ('slider__player-{{ $slide->id }}' === frm.attr('id')) {
                e.target.setPlaybackQuality('hd720');
            }
        }
    }
    function pkOnPlayerReady(e) {
        player.mute();
        e.target.setPlaybackQuality('hd720');
    }

    //Load a youtube pixel
    var pkEnableYoutube = function() {
        var deferred = jQuery.Deferred();
        var img = new Image();
        img.onload = function() { return deferred.resolve(); };
        img.onerror = function() { return deferred.reject(); };
        img.src = "https://s.ytimg.com/yts/img/pixel-vfl3z5WfW.gif?" + new Date().getTime();
        return deferred.promise();
    };

    //When the video starts to load, set a timer for the video wrap to fade in
    jQuery(function($){
        $.when(pkEnableYoutube()).done(function(){
            setTimeout(function() {
                $('.video_wrap').fadeIn();
            }, 2000);
        });
    });
</script>

<section
        id="slider__slide-wrapper-{{ $slide->id }}"
        class="slider__yt-slide slider__slide-yt-bg-image"
        style="background-image: url('{{ $slide->getImageUrl() ?? $slide->getYoutubeVideoThumbnail($slide::YOUTUBE_THUMBNAIL_QUALITY_HIGH) }}');"
>
    <div class="slide-yt-overlay">
        <div class="carousel-caption d-none d-md-block">
            <h1>{{ $slide->title }}</h1>
            <span>{{ $slide->caption }}</span>
        </div>
    </div>
    <div class="video_wrap" style="display:none">
        <div id="slider__player-{{ $slide->id }}"></div>
    </div>
</section>
