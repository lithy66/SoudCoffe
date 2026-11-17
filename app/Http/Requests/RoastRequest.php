<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoastRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        foreach (config('app.languages') as $key => $value)
        {
            $data[$key. '*.name'] = 'required|string|max:75|unique:roast_level_translations,name,'.$this->id.',roast_level_id';
        }

        return $data;
    }

    public function messages()
    {
        return [
            'ar.name.required' => __('messages.required'),
            'ar.name.string' => __('messages.string'),
            'ar.name.max' => __('messages.max'),
            'ar.name.unique' => __('messages.unique'),
            'en.name.unique' => __('messages.unique'),
            'en.name.max' => __('messages.max'),
            'en.name.string' => __('messages.string'),
            'en.name.required' => __('messages.required'),
        ];
    }
}
