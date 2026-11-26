<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
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
        $rules = [
            'supplier_id'     => 'required|exists:suppliers,id',
            'warehouse_id'    => 'required|exists:warehouses,id',
            'order_date'      => 'required|date',
            'expected_date'   => 'nullable|date|after_or_equal:order_date',
            'currency'        => 'nullable|string|max:5',
            'tax_percent'      => 'nullable|numeric|min:0|max:100',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'notes'           => 'nullable|string|max:2000',

            'items'                    => 'required|array|min:1',
            'items.*.material_id'      => 'required|distinct|exists:materials,id',
            'items.*.ordered_quantity' => 'required|numeric|gt:0',
            'items.*.unit_cost'        => 'required|numeric|min:0',
            'items.*.notes'            => 'nullable|string|max:500',
        ];

        // في التعديل الـ id بييجي من hidden input (زي باقي الصفحات)
        if ($this->routeIs('admin.purchaseOrder.update')) {
            $rules['id'] = 'required|exists:purchase_orders,id';
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'supplier_id'              => __('admin/purchase_order.supplier'),
            'warehouse_id'             => __('admin/purchase_order.warehouse'),
            'order_date'               => __('admin/body.order_date'),
            'expected_date'            => __('admin/body.expected_date'),
            'currency'                 => __('admin/body.currency'),
            'tax_percent'              => __('admin/purchase_order.tax_percent'),
            'discount_percent'         => __('admin/body.discount'),
            'notes'                    => __('admin/body.notes'),
            'items'                    => __('admin/purchase_order.items'),
            'items.*.material_id'      => __('admin/purchase_order.material'),
            'items.*.ordered_quantity' => __('admin/body.Quantity'),
            'items.*.unit_cost'        => __('admin/purchase_order.unit_cost'),
        ];
    }

}
