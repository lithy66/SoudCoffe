<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'phone' => 'required',
            'email' => 'required|email',
        ];

        foreach (config('app.languages') as $key => $value){
            $data[$key.'*.title'] = 'required | string';
            $data[$key.'*.content'] = 'nullable | string';
            $data[$key.'*.address'] = 'nullable | string';
        }

        return $data;
    }

    public function messages(): array
    {
        return [
            'logo.image' => __('messages.flavor'),
            'logo.mimes' => __('messages.flavor'),
            'logo.max' => __('messages.size'),
            'favicon.image' => __('messages.flavor'),
            'favicon.mimes' => __('messages.flavor'),
            'favicon.max' => __('messages.size'),
            'facebook.string' => __('messages.string'),
            'instagram.string' => __('messages.string'),
            'phone.required' => __('messages.required'),
            'email.required' => __('messages.required'),
            'email.email' => __('messages.email'),
            'ar.title.required' => __('messages.required'),
            'en.title.required' => __('messages.required'),
            'ar.title.string' => __('messages.string'),
            'en.title.string' => __('messages.string'),
            'ar.content.string' => __('messages.string'),
            'en.content.string' => __('messages.string'),
            'ar.address.string' => __('messages.string'),
            'en.address.string' => __('messages.string'),
        ];

    }
}
