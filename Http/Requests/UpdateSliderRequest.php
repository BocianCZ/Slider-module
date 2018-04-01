<?php

namespace Modules\Slider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    public function rules()
    {
        $slider = $this->route()->parameter('slider__slider');

        return [
            'name' => 'required',
            'primary' => "unique:slider__sliders,primary,{$slider->id}",
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => trans('slider::validation.name is required'),
            'system_name.required' => trans('slider::validation.system name is required'),
        ];
    }
}
