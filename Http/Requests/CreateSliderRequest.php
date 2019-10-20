<?php

namespace Modules\Slider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:slider__sliders',
            'system_name' => 'required|unique:slider__sliders',
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
            'name.unique' => trans('slider::validation.name must be unique'),
            'system_name.required' => trans('slider::validation.system name is required'),
            'system_name.unique' => trans('slider::validation.system name must be unique'),
        ];
    }
}
