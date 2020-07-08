<div class="form-group {{ $errors->has("name") ? ' has-error' : '' }}">
    {!! Form::label("name", trans('slider::slides.form.name')) !!}
    {!! Form::text("name", old("name"), ["class" => "form-control", "placeholder" => trans('slider::slides.form.name')]) !!}
    {!! $errors->first("name", '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group">
    <label for="page">{{ trans('slider::slides.form.page') }}</label>
    <select class="form-control" name="page_id" id="page">
        <option value=""></option>
        <?php foreach ($pages as $page): ?>
            <option value="{{ $page->id }}">{{ $page->title }}</option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="target">{{ trans('slider::slides.form.target') }}</label>
    <select class="form-control" name="target" id="target">
        <option value="_self">{{ trans('slider::slides.form.same tab') }}</option>
        <option value="_blank">{{ trans('slider::slides.form.new tab') }}</option>
    </select>
</div>

<div class="row">
    @foreach (config('asgard.slider.config.slide-images') as $zone)
        <div class="col-md-3 col-sm-4">
            @mediaSingle($zone)
        </div>
    @endforeach
</div>

<div class="form-group{{ $errors->has("external_image_url") ? ' has-error' : '' }}">
    {!! Form::label("external_image_url", trans('slider::sliders.form.external image url')) !!}
    {!! Form::text("external_image_url", old("external_image_url"), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.placeholder.external image url')]) !!}
    {!! $errors->first("external_image_url", '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group{{ $errors->has("youtube_video_url") ? ' has-error' : '' }}">
    {!! Form::label("youtube_video_url", trans('slider::sliders.form.youtube video url')) !!}
    {!! Form::text("youtube_video_url", old("youtube_video_url"), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.placeholder.youtube video url')]) !!}
    {!! $errors->first("youtube_video_url", '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group{{ $errors->has("classes") ? ' has-error' : '' }}">
    {!! Form::label("classes", trans('slider::sliders.form.classes')) !!}
    {!! Form::text("classes", old("classes"), ['class' => 'form-control']) !!}
    {!! $errors->first("classes", '<span class="help-block">:message</span>') !!}
</div>