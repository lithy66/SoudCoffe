<?php


namespace App\Repository\PurchaseOrder;


use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Models\Admin;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{


    public function index()
    {
        $header_title   = __('admin/sidebar.purchase order');
        $purchaseOrders = PurchaseOrder::with(['supplier', 'warehouse', 'creator'])
            ->latest()
            ->get();

        return view('admin.purchaseOrder.index', compact('header_title', 'purchaseOrders'));
    }

    public function create()
    {
        $header_title = __('general.add').' '. __('admin/sidebar.purchase order');

        return view('admin.purchaseOrder.add', array_merge(
            compact('header_title'),
            $this->formData(null)
        ));
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $purchaseOrder = PurchaseOrder::create(array_merge($this->headerData($request), [
                'po_number'  => PurchaseOrder::generateNumber(),
                'status'     => PurchaseOrder::STATUS_DRAFT,
                'created_by' => auth('admin')->id(),
            ]));

            $this->saveItems(
                $purchaseOrder,
                $request->input('items'),
                (float) $request->input('tax_percent', 0),
                (float) $request->input('discount_percent', 0)
            );
        });

        return redirect()->route('admin.purchaseOrder')->with('success', __('general.add-s'));
    }

    public function edit($purchaseOrder)
    {
        if (!$purchaseOrder->isEditable()) {
            return redirect()->route('admin.purchaseOrder')
                ->with('error', __('admin/body.not_editable'));
        }

        $header_title = __('general.edit') . ' ' . $purchaseOrder->po_number;

        return view('admin.purchaseOrder.edit', array_merge(
            compact('header_title', 'purchaseOrder'),
            $this->formData($purchaseOrder)
        ));
    }

    public function update($request)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($request->input('id'));

        if (!$purchaseOrder->isEditable()) {
            return redirect()->route('admin.purchaseOrder')
                ->with('error', __('admin/purchase_order.not_editable'));
        }

        DB::transaction(function () use ($request, $purchaseOrder) {
            $purchaseOrder->update($this->headerData($request));

            $this->saveItems(
                $purchaseOrder,
                $request->input('items'),
                (float) $request->input('tax_percent', 0),
                (float) $request->input('discount_percent', 0)
            );
        });

        return redirect()->route('admin.purchaseOrder')->with('success', __('general.update-s'));
    }

    /**
     * الاعتماد (draft → sent) والإلغاء (draft/sent → cancelled).
     * الاستلام هيتعمل لاحقاً بعد جداول المخزون.
     * @param $request
     * @return RedirectResponse
     */
    public function updateStatus($request)
    {
        $request->validate([
            'id'     => 'required|exists:purchase_orders,id',
            'status' => 'required|in:' . PurchaseOrder::STATUS_SENT . ',' . PurchaseOrder::STATUS_CANCELLED,
        ]);

        $purchaseOrder = PurchaseOrder::withCount('items')->findOrFail($request->input('id'));
        $new           = $request->input('status');

        if ($new === PurchaseOrder::STATUS_SENT) {
            if ($purchaseOrder->status !== PurchaseOrder::STATUS_DRAFT) {
                return back()->with('error', __('admin/purchase_order.status_not_allowed'));
            }
            if ($purchaseOrder->items_count < 1) {
                return back()->with('error', __('admin/purchase_order.no_items'));
            }

            $purchaseOrder->update([
                'status'      => PurchaseOrder::STATUS_SENT,
                'approved_by' => auth('admin')->id(),
                'approved_at' => now(),
            ]);
        } else {
            if (!in_array($purchaseOrder->status, [PurchaseOrder::STATUS_DRAFT, PurchaseOrder::STATUS_SENT], true)) {
                return back()->with('error', __('admin/purchase_order.status_not_allowed'));
            }

            $purchaseOrder->update(['status' => PurchaseOrder::STATUS_CANCELLED]);
        }

        return back()->with('success', __('admin/purchase_order.status_updated'));
    }

    public function destroy($request)
    {
        $request->validate(['id' => 'required|exists:purchase_orders,id']);

        $purchaseOrder = PurchaseOrder::findOrFail($request->input('id'));

        // الحذف للمسودة والملغي بس (بعد الاعتماد المستند بيفضل للمراجعة)
        if (!in_array($purchaseOrder->status, [PurchaseOrder::STATUS_DRAFT, PurchaseOrder::STATUS_CANCELLED], true)) {
            return back()->with('error', __('admin/purchase_order.delete_not_allowed'));
        }

        $purchaseOrder->delete(); // soft delete

        return back()->with('success', __('messages.true'));
    }

    /* ------------------------------------------------------------------ */

    private function formData($purchaseOrder): array
    {
        return [
            'suppliers'  => Supplier::where('is_active', 1)->get(),
            'warehouses' => Warehouse::where('is_active', 1)->get(),
            'materials'  => Material::where('is_active', 1)->get(),
            'rows'       => $this->rows($purchaseOrder),
        ];
    }

    /** صفوف البنود اللي بتتعرض (old() بعد خطأ validation، أو بنود الأمر، أو صف فاضي)
     * @param $purchaseOrder
     * @return array
     */
    private function rows($purchaseOrder): array
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

    private function headerData($request): array
    {
        return [
            'supplier_id'     => $request->input('supplier_id'),
            'warehouse_id'    => $request->input('warehouse_id'),
            'order_date'      => $request->input('order_date'),
            'expected_date'   => $request->input('expected_date'),
            'currency'        => $request->input('currency'),
            'tax_percent'      => (float) $request->input('tax_percent', 0),
            'discount_percent' => (float) $request->input('discount_percent', 0),
            'notes'           => $request->input('notes'),
        ];
    }

    /** بيمسح البنود القديمة ويكتب الجديدة ويحسب الإجماليات والنسب من السيرفر (مش من المتصفح)
     * @param $purchaseOrder
     * @param array $items
     * @param float $taxPercent
     * @param float $discountPercent
     */
    private function saveItems($purchaseOrder, array $items, float $taxPercent, float $discountPercent): void
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

        // الخصم الأول على الإجمالي، والضريبة على المبلغ بعد الخصم
        $subtotal       = round($subtotal, 2);
        $discountAmount = round($subtotal * $discountPercent / 100, 2);
        $taxableAmount  = $subtotal - $discountAmount;
        $taxAmount      = round($taxableAmount * $taxPercent / 100, 2);

        $purchaseOrder->update([
            'subtotal'        => $subtotal,
            'discount_amount' => $discountAmount,
            'tax_amount'      => $taxAmount,
            'total_amount'    => round($taxableAmount + $taxAmount, 2),
        ]);
    }
}
