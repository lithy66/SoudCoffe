<?php


namespace App\Repository\Warehouse;


use App\Interfaces\Warehouse\WarehouseRepositoryInterfaces;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Warehouse;

class WarehouseRepository implements WarehouseRepositoryInterfaces
{

    public function index()
    {
        $data['header_title'] = __('admin/sidebar.warehouse');
        $data['warehouse'] = Warehouse::getWarehouse();
        return view('admin.warehouse.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.warehouse');
        $data['admins'] = Admin::Active();
        $data['branches'] = Branch::Active();

        return view('admin.warehouse.add', $data);
    }

    public function store($request)
    {
        $warehouse = new Warehouse;
        $warehouse->type = $request->type;
        $warehouse->branch_id = $request->branch_id;
        $warehouse->admin_id = $request->admin_id;
        $warehouse->phone = $request->phone;

       $warehouse->translateOrNew('ar')->name = $request->ar['name'];
       $warehouse->translateOrNew('ar')->address = $request->ar['address'];
       $warehouse->translateOrNew('ar')->notes = $request->ar['notes'];

       $warehouse->translateOrNew('en')->name = $request->en['name'];
       $warehouse->translateOrNew('en')->address = $request->en['address'];
       $warehouse->translateOrNew('en')->notes = $request->en['notes'];

       $warehouse->save();

       session()->flash('true');
       return redirect(route('admin.warehouse'));

    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.warehouse');
        $data['admins'] = Admin::Active();
        $data['branches'] = Branch::Active();
        $data['warehouse'] = Warehouse::singleWarehouse($id);

        if (!$data['warehouse'])
        {
            session()->flash('false');
            return redirect(route('admin.warehouse'));
        }

        return view('admin.warehouse.edit', $data);
    }

    public function update($request)
    {
        $warehouse = Warehouse::singleWarehouse($request->id);
        $warehouse->type = $request->type;
        $warehouse->branch_id = $request->branch_id;
        $warehouse->admin_id = $request->admin_id;
        $warehouse->phone = $request->phone;

        $warehouse->translateOrNew('ar')->name = $request->ar['name'];
        $warehouse->translateOrNew('ar')->address = $request->ar['address'];
        $warehouse->translateOrNew('ar')->notes = $request->ar['notes'];

        $warehouse->translateOrNew('en')->name = $request->en['name'];
        $warehouse->translateOrNew('en')->address = $request->en['address'];
        $warehouse->translateOrNew('en')->notes = $request->en['notes'];

        $warehouse->save();

        session()->flash('true');
        return redirect(route('admin.warehouse'));
    }

    public function updateStatus($request)
    {
        $warehouse = Warehouse::singleWarehouse($request->id);
        $warehouse->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.unit');
    }

    public function destroy($request)
    {
        $warehouse = Warehouse::singleWarehouse($request->id);
        $warehouse->delete();
        session()->flash('true');

        return redirect()->route('admin.unit');
    }

}
