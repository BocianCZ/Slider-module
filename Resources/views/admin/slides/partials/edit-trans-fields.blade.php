<div class='form-group{{ $errors->has("{$lang}[title]") ? ' has-error' : '' }}'>
    {!! Form::label("{$lang}[title]", trans('slider::sliders.form.title')) !!}
    <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->title : '' ?>
    {!! Form::text("{$lang}[title]", old("{$lang}[title]", $old), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.title'), 'autofocus']) !!}
    {!! $errors->first("{$lang}[title]", '<span class="help-block">:message</span>') !!}
</div>
<div class='form-group{{ $errors->has("{$lang}[caption]") ? ' has-error' : '' }}'>
    {!! Form::label("{$lang}[caption]", trans('slider::sliders.form.caption')) !!}
    <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->caption : '' ?>
    {!! Form::text("{$lang}[caption]", old("{$lang}[caption]", $old), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.caption'), 'autofocus']) !!}
    {!! $errors->first("{$lang}[caption]", '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group">
    {!! Form::label("{$lang}[uri]", trans('slider::sliders.form.uri')) !!}
    <div class='input-group{{ $errors->has("{$lang}[uri]") ? ' has-error' : '' }}'>
        <span class="input-group-addon">/{{ $lang }}/</span>
        <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->uri : '' ?>
        {!! Form::text("{$lang}[uri]", old("{$lang}[uri]", $old), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.uri')]) !!}
        {!! $errors->first("{$lang}[uri]", '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has("{$lang}[url]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[url]", trans('slider::sliders.form.url')) !!}
    <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->url : '' ?>
    {!! Form::text("{$lang}[url]", old("{$lang}[url]", $old), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.url')]) !!}
    {!! $errors->first("{$lang}[url]", '<span class="help-block">:message</span>') !!}
</div>

<div class="checkbox">
    <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->active : false ?>
    <label for="{{$lang}}[active]">
        <input id="{{$lang}}[active]"
               name="{{$lang}}[active]"
               type="checkbox"
               class="flat-blue"
               {{ (bool) $old ? 'checked' : '' }}
               value="1" />
        {{ trans('slider::sliders.form.active') }}
    </label>
</div>

<div class="form-group{{ $errors->has("{$lang}[custom_html]") ? ' has-error' : '' }}">
    {!! Form::label("{$lang}[custom_html]", trans('slider::slides.form.custom html')) !!}
    <?php $old = $slide->hasTranslation($lang) ? $slide->translate($lang)->custom_html : '' ?>
    {!! Form::textarea("{$lang}[custom_html]", old("{$lang}[custom_html]", $old), ['class' => 'form-control ckeditor', 'placeholder' => trans('slider::slides.form.custom html')]) !!}
    {!! $errors->first("{$lang}[custom_html]", '<span class="help-block">:message</span>') !!}
</div>