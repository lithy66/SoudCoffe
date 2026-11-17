<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        $data = [
            'email' => 'nullable|email',
            'phone' => 'required|string|max:12',
            'tax_number' => 'nullable|string|max:20',
        ];

        foreach (config('app.languages') as $key => $value)
        {
            $data[$key. '*.company_name'] = 'required|string|max:100';
            $data[$key. '*.address'] = 'required|string|max:400';
            $data[$key. '*.notes'] = 'string|max:400|nullable';
        }

        return $data;
    }
    public function messages()
    {
        return [
            'email.max' => __('messages.email true'),
            'phone.required' => __('messages.required'),
            'phone.string' => __('messages.string'),
            'phone.max' => __('messages.max'),
            'tax_number.string' => __('messages.string'),
            'tax_number.max' => __('messages.max'),

            //Translations
            'ar.company_name.required' => __('messages.required'),
            'ar.company_name.string' => __('messages.string'),
            'ar.company_name.max' => __('messages.max'),
            'ar.address.required' => __('messages.required'),
            'ar.address.string' => __('messages.string'),
            'ar.address.max' => __('messages.max'),
            'ar.notes.string' => __('messages.string'),
            'ar.notes.max' => __('messages.max'),

            'en.company_name.unique' => __('messages.unique'),
            'en.company_name.max' => __('messages.max'),
            'en.company_name.string' => __('messages.string'),
            'en.address.required' => __('messages.required'),
            'en.address.string' => __('messages.string'),
            'en.address.max' => __('messages.max'),
            'en.notes.string' => __('messages.string'),
            'en.notes.max' => __('messages.max'),

        ];
    }
}
