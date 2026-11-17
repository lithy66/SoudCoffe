<?php


namespace App\Repository\PurchaseOrder;

use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Models\Admin;
use App\Models\MaterialCategory;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Warehouse;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{

    public function index()
    {
        $data['header_title'] = __('admin/sidebar.purchase order');
        $data['purchaseOrder'] = PurchaseOrder::getPurchaseOrder();

        return view('admin.purchaseOrder.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.purchase order');
        $data['suppliers'] = Supplier::Active();
        $data['warehouses'] = Warehouse::Active();
        $data['categories'] = MaterialCategory::active();
        $data['admins'] = Admin::Active();
        return view('admin.purchaseOrder.add', $data);
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

}
