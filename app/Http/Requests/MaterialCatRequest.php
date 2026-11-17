<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MaterialCatRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        foreach (config('app.languages') as $key => $value)
        {
            $data['code'] = 'required|string|max:4|unique';
            $data[$key.'*.name'] = 'required|string|max:75|unique:material_category_translations,name,'.$this->id.',material_category_id';
        }

        return $data;
    }

    public function messages(): array
    {
        return [
            'code.required' => __('messages.required'),
            'code.string' => __('messages.string'),
            'code.max' => __('messages.max'),
            'code.unique' => __('messages.unique'),
            'ar.name.required' => __('messages.required'),
            'ar.name.string' => __('messages.string'),
            'ar.name.max' => __('messages.max'),
            'ar.name.unique' => __('messages.unique'),
            'en.name.required' => __('messages.required'),
            'en.name.string' => __('messages.string'),
            'en.name.max' => __('messages.max'),
            'en.name.unique' => __('messages.unique'),
        ];
    }
}
