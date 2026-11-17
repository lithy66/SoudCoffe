<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $data= [
            'symbol' => 'required|string|max:10',
            'conversion_factory' => 'required'
        ];

        foreach (config('app.languages') as $key => $value)
        {
            $data[$key.'*.name'] = 'required|string|max:75|unique:unit_translations,name,'.$this->id.',unit_id';
        }

        return $data;
    }

    public function messages(): array
    {
        return [

            'ar.symbol.required' => __('messages.required'),
            'ar.symbol.string' => __('messages.string'),
            'ar.symbol.max' => __('messages.max'),
            'ar.conversion_factory.required' => __('messages.required'),
            'ar.name.required' => __('messages.required'),
            'ar.name.string' => __('messages.string'),
            'ar.name.max' => __('messages.max'),
            'ar.name.unique' => __('messages.unique'),

            'en.symbol.required' => __('messages.required'),
            'en.symbol.string' => __('messages.string'),
            'en.symbol.max' => __('messages.max'),
            'en.conversion_factory.required' => __('messages.required'),
            'en.name.required' => __('messages.required'),
            'en.name.string' => __('messages.string'),
            'en.name.max' => __('messages.max'),
            'en.name.unique' => __('messages.unique'),
        ];
    }

}
