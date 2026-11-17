<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'type' => 'required',
            'admin_id' => 'required',
            'phone' => 'required|string',
            'open' => 'required',
            'close' => 'required',
            'is_online' => 'boolean',
            'is_active' => 'boolean',
        ];
        foreach (config('app.languages') as $key => $value)
        {
            $data[$key.'*.name'] = 'required|string|max:75|unique:branch_translations,name,'.$this->id.',branch_id';
            $data[$key. '*.address'] = 'required|string|max:500';
        }
        return $data;
    }

    public function messages()
    {
        return [
            'type.required' => __('messages.required'),
            'admin_id.required' => __('messages.required'),
            'phone.string' => __('messages.string'),
            'phone.required' => __('messages.required'),
            'open.required' => __('messages.required'),
            'open.date_format' => __('messages.integer'),
            'close.date_format' => __('messages.integer'),
            'close.required' => __('messages.required'),
            'is_active' => __('messages.integer'),
            'is_online' => __('messages.integer'),

            'ar.name.unique' => __('messages.unique'),
            'ar.name.required' => __('messages.required'),
            'ar.name.string' => __('messages.string'),
            'ar.name.max' => __('messages.max'),
            'ar.address.required' => __('messages.required'),
            'ar.address.string' => __('messages.string'),
            'ar.address.max' => __('messages.max'),

            'en.name.required' => __('messages.required'),
            'en.name.string' => __('messages.string'),
            'en.name.max' => __('messages.max'),
            'en.address.required' => __('messages.required'),
            'en.address.string' => __('messages.string'),
            'en.address.max' => __('messages.max'),
            'en.name.unique' => __('messages.unique'),
        ];
    }
}
