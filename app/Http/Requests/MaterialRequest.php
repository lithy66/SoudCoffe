<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'material_category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'roast_level_id' => 'nullable|numeric',
            'barcode' => 'nullable|string',
            'min_stock_level' => 'required',
            'reorder_level' => 'required',
            'max_stock_level' => 'required',
            'cost_price' => 'required',
            'currency' => 'nullable|string|max:3',
            'shelf_life_days' => 'required|numeric',
        ];

        foreach (config('app.languages') as $key => $value)
        {
            $data[$key. '*.name'] = 'required|string|max:75|unique:material_translations,name,'.$this->id.',material_id';
            $data[$key. '*.description'] = 'required|string|max:400';
            $data[$key. '*.notes'] = 'string|max:400|nullable';
        }

        return $data;
    }

    public function messages()
    {
        return[
            'material_category_id.required' => __('messages.required'),
            'material_category_id.numeric' => __('messages.numeric'),
            'unit_id.required' => __('messages.required'),
            'unit_id.numeric' => __('messages.numeric'),
            'roast_level_id.required' => __('messages.required'),
            'roast_level_id.numeric' => __('messages.numeric'),
            'barcode.string' => __('messages.string'),
            'min_stock_level.required' => __('messages.required'),
            'min_stock_level.decimal' => __('messages.numeric'),
            'reorder_level.required' => __('messages.required'),
            'reorder_level.decimal' => __('messages.numeric'),
            'max_stock_level.required' => __('messages.required'),
            'max_stock_level.decimal' => __('messages.numeric'),
            'cost_price.required' => __('messages.required'),
            'cost_price.decimal' => __('messages.numeric'),
            'currency.required' => __('messages.required'),
            'currency.string' => __('messages.string'),
            'currency.max' => __('messages.max'),
            'shelf_life_days.decimal' => __('messages.numeric'),
            'shelf_life_days.required' => __('messages.required'),

//            Translations
            'ar.name.required' => __('messages.required'),
            'ar.name.string' => __('messages.string'),
            'ar.name.max' => __('messages.max'),
            'ar.name.unique' => __('messages.unique'),
            'ar.description.required' => __('messages.required'),
            'ar.description.string' => __('messages.string'),
            'ar.description.max' => __('messages.max'),
            'ar.notes.string' => __('messages.string'),
            'ar.notes.max' => __('messages.max'),

            'en.name.required' => __('messages.required'),
            'en.name.string' => __('messages.string'),
            'en.name.max' => __('messages.max'),
            'en.name.unique' => __('messages.unique'),
            'en.description.required' => __('messages.required'),
            'en.description.string' => __('messages.string'),
            'en.description.max' => __('messages.max'),
            'en.notes.string' => __('messages.string'),
            'en.notes.max' => __('messages.max'),
        ];

    }
}
