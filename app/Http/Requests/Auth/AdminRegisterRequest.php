<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRegisterRequest extends FormRequest
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
        return [
            'name' => 'string|required',
            'email' => ['required', 'email', Rule::unique('admins', 'email')->ignore($this->route('admin'))], // email:rfc,dns
            'phone' => 'required|string|max:20|unique:admins,phone,' .$this->id,
            'password' => $this->route('admin') ? 'nullable' : 'required',
            'role' => ['required', Rule::exists('roles', 'name')->where('guard_name', 'admin')],
            'branch_id' => 'nullable',
            'warehouse_id' => 'nullable',
            'national_id' => 'required|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:400',
            'emergency_contact' => 'nullable|string|max:20',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric|between:0,99999999.99',
            'notes' => 'nullable|string|max:250',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.required'),
            'name.string' => __('messages.string'),
            'email.required' => __('messages.required'),
            'email.email' => __('messages.email'),
            'phone.required' => __('messages.required'),
            'phone.unique' => __('messages.unique'),
            'phone.max' => __('messages.max'),
            'phone.string' => __('messages.string'),
            'password.required' => __('messages.required'),
            'role.required' => __('messages.required'),
            'role.exists'   => __('admin/roles.invalid-role'),
            'national_id.required' => __('messages.required'),
            'national_id.numeric' => __('messages.numeric'),
            'national_id.max' => __('messages.max'),
            'birth_date.required' => __('messages.required'),
            'birth_date.date' => __('messages.date'),
            'gender.required' => __('messages.required'),
            'gender.string' => __('messages.string'),
            'address.required' => __('messages.required'),
            'address.string' => __('messages.string'),
            'emergency_contact.string' => __('messages.string'),
            'emergency_contact.max' => __('messages.max'),
            'hire_date.required' => __('messages.required'),
            'hire_date.date' => __('messages.date'),
            'salary.required' => __('messages.required'),
            'salary.numeric' => __('messages.numeric'),
            'salary.between' => __('messages.between'),
            'notes.max' => __('messages.max'),
            'notes.string' => __('messages.string'),
        ];
    }
}
