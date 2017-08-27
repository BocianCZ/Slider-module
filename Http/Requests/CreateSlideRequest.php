<?php namespace Modules\Slider\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateSlideRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'slider::slider.validation.attributes';

    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
            'title'     =>  'required',
            'caption'   =>  'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('slider::slider.messages.title'),
            'caption.required' => trans('slider::slider.messages.caption'),
        ];
    }
}
