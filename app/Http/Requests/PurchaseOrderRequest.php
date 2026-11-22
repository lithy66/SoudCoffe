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
        $data = [
            'supplier_id'     => 'required|exists:suppliers,id',
            'warehouse_id'    => 'required|exists:warehouses,id',
            'order_date'      => 'required|date',
            'expected_date'   => 'nullable|date|after_or_equal:order_date',
            'currency'        => 'nullable|string|max:5',
            'tax_amount'      => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes'           => 'nullable|string|max:2000',

            'items'                    => 'required|array|min:1',
            'items.*.material_id'      => 'required|distinct|exists:materials,id',
            'items.*.ordered_quantity' => 'required|numeric|gt:0',
            'items.*.unit_cost'        => 'required|numeric|min:0',
            'items.*.notes'            => 'nullable|string|max:500',
        ];
        if ($this->routeIs('admin.purchaseOrder.update')) {
            $data['id'] = 'required|exists:purchase_orders,id';
        }

        return $data;
    }

    public function messages(): array
    {
        return [
            'supplier_id'              => __('admin/purchase_order.supplier'),
            'warehouse_id'             => __('admin/purchase_order.warehouse'),
            'order_date'               => __('admin/purchase_order.order_date'),
            'expected_date'            => __('admin/purchase_order.expected_date'),
            'currency'                 => __('admin/purchase_order.currency'),
            'tax_amount'               => __('admin/purchase_order.tax'),
            'discount_amount'          => __('admin/purchase_order.discount'),
            'notes'                    => __('admin/purchase_order.notes'),
            'items'                    => __('admin/purchase_order.items'),
            'items.*.material_id'      => __('admin/purchase_order.material'),
            'items.*.ordered_quantity' => __('admin/purchase_order.quantity'),
            'items.*.unit_cost'        => __('admin/purchase_order.unit_cost'),
        ];
    }

}
