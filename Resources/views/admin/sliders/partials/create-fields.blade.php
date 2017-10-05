<div class='form-group{{ $errors->has('name') ? ' has-error' : '' }}'>
    {!! Form::label('name', trans('slider::slider.form.name')) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('slider::slider.form.name')]) !!}
    {!! $errors->first('Name', '<span class="help-block">:message</span>') !!}
</div>

<div class='form-group{{ $errors->has('system_name') ? ' has-error' : '' }}'>
    {!! Form::label('system_name', trans('slider::slider.form.system name')) !!}
    {!! Form::text('system_name', old('system_name'), ['class' => 'form-control', 'placeholder' => trans('slider::slider.form.system name')]) !!}
    {!! $errors->first('System Name', '<span class="help-block">:message</span>') !!}
</div>

<div class="checkbox">
    <label for="active">
        <input id="active"
               name="active"
               type="checkbox"
               class="flat-blue"
               {{ (is_null(old('active'))) ?: 'checked' }}
               value="1" />
        {{ trans('slider::slider.form.active') }}
    </label>
</div>
