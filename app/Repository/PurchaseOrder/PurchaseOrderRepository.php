<?php


namespace App\Repository\PurchaseOrder;

use App\Http\Requests\PurchaseOrderRequest;
use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Models\Admin;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Warehouse;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{


    public function index()
    {
        $data['header_title']   = __('admin/sidebar.purchase order');
        $data['purchaseOrders'] = PurchaseOrder::with(['supplier', 'warehouse', 'creator'])->latest()->get();

        return view('admin.purchaseOrder.index', $data);

//        $data['header_title'] = __('admin/sidebar.purchase order');
//        $data['purchaseOrder'] = PurchaseOrder::with(['supplier', 'warehouse', 'creator'])->latest()->get();
//
//        return view('admin.purchaseOrder.index', $data);
    }

    public function create()
    {
        $header_title =__('general.add').' '. __('admin/sidebar.purchase order');

        return view('admin.purchaseOrder.add', array_merge(
            compact('header_title'),
            $this->formData(null)
        ));

//        $data['header_title'] = __('general.add').' '. __('admin/sidebar.purchase order');
//        $data['suppliers'] = Supplier::getSupplier();
//        $data['warehouses'] = Warehouse::Active();
//        $data['categories'] = MaterialCategory::active();
//        $data['admins'] = Admin::Active();
//        return view('admin.purchaseOrder.test.add', $data);
    }

    public function store($request)
    {

    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.purchase order');
        $data['suppliers'] = Supplier::Active();
        $data['warehouses'] = Warehouse::Active();
        $data['admins'] = Admin::Active();
        $data['purchaseOrder'] = PurchaseOrder::singlePurchaseOrder($id);

        if (!$data['purchaseOrder'])
        {
            session()->flash('false');
            return redirect(route('admin.purchaseOrder'));
        }

        return view('admin.purchaseOrder.edit', $data);
    }

    public function update($request)
    {

    }

    public function updateStatus($request)
    {
        $purchase = PurchaseOrder::singlePurchaseOrder($request->id);
        $purchase->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect(route('admin.purchaseOrder'));
    }

    public function destroy($request)
    {
        $purchase = PurchaseOrder::singlePurchaseOrder($request->id);
        $purchase->delete();
        session()->flash('true');

        return redirect(route('admin.purchaseOrder'));
    }

    private function formData(?PurchaseOrder $purchaseOrder): array
    {
        return [
            'suppliers'  => Supplier::Active(),
            'warehouses' => Warehouse::Active(),
            'materials'  => Material::Active(),
            'rows'       => $this->rows($purchaseOrder),
        ];
    }

    private function rows(?PurchaseOrder $purchaseOrder): array
    {
        if (old('items')) {
            return array_values(old('items'));
        }

        if ($purchaseOrder) {
            return $purchaseOrder->items->map(fn ($item) => [
                'material_id'      => $item->material_id,
                'ordered_quantity' => (float) $item->ordered_quantity,
                'unit_cost'        => (float) $item->unit_cost,
                'notes'            => $item->notes,
            ])->all();
        }

        return [['material_id' => '', 'ordered_quantity' => '', 'unit_cost' => '', 'notes' => '']];
    }

    private function headerData(PurchaseOrderRequest $request): array
    {
        return [
            'supplier_id'     => $request->input('supplier_id'),
            'warehouse_id'    => $request->input('warehouse_id'),
            'order_date'      => $request->input('order_date'),
            'expected_date'   => $request->input('expected_date'),
            'currency'        => $request->input('currency'),
            'tax_amount'      => (float) $request->input('tax_amount', 0),
            'discount_amount' => (float) $request->input('discount_amount', 0),
            'notes'           => $request->input('notes'),
        ];
    }

    /** بيمسح البنود القديمة ويكتب الجديدة ويحسب الإجماليات من السيرفر (مش من المتصفح)
     * @param PurchaseOrder $purchaseOrder
     * @param array $items
     * @param float $tax
     * @param float $discount
     */
    private function saveItems(PurchaseOrder $purchaseOrder, array $items, float $tax, float $discount): void
    {
        $purchaseOrder->items()->delete();

        $subtotal = 0;

        foreach ($items as $item) {
            $qty  = (float) $item['ordered_quantity'];
            $cost = (float) $item['unit_cost'];
            $line = round($qty * $cost, 2);

            $subtotal += $line;

            $purchaseOrder->items()->create([
                'material_id'       => $item['material_id'],
                'ordered_quantity'  => $qty,
                'received_quantity' => 0,
                'unit_cost'         => $cost,
                'total_cost'        => $line,
                'notes'             => $item['notes'] ?? null,
            ]);
        }

        $purchaseOrder->update([
            'subtotal'     => round($subtotal, 2),
            'total_amount' => max(0, round($subtotal + $tax - $discount, 2)),
        ]);
    }
}
