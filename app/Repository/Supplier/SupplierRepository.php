<?php


namespace App\Repository\Supplier;


use App\Interfaces\Supplier\SupplierRepositoryInterface;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function index()
    {
        $data['header_title'] = __('admin/sidebar.suppliers');
        $data['supplier'] = Supplier::getSupplier();

        return view('admin.supplier.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.suppliers');
        return view('admin.supplier.add', $data);
    }

    public function store($request)
    {

        $info = [
            'email' => $request->email,
            'phone' => $request->phone,
            'tax_number' => $request->tax_number,

            'ar' => [
                'company_name' => $request->ar['company_name'],
                'address' => $request->ar['address'],
                'notes' => $request->ar['notes'],
            ],

            'en' => [
                'company_name' => $request->en['company_name'],
                'address' => $request->en['address'],
                'notes' => $request->en['notes'],
            ]
        ];

        Supplier::create($info);
        session()->flash('true');

        return redirect(route('admin.supplier'));
    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.suppliers');
        $data['supplier'] = Supplier::singleSupplier($id);

        if (!$data['supplier'])
        {
            session()->flash('false');
            return redirect(route('admin.supplier'));
        }

        return view('admin.supplier.edit', $data);
    }

    public function update($request)
    {
        $supplier = Supplier::singleSupplier($request->id);

        $info = [
            'email' => $request->email,
            'phone' => $request->phone,
            'tax_number' => $request->tax_number,

            'ar' => [
                'company_name' => $request->ar['company_name'],
                'address' => $request->ar['address'],
                'notes' => $request->ar['notes'],
            ],

            'en' => [
                'company_name' => $request->en['company_name'],
                'address' => $request->en['address'],
                'notes' => $request->en['notes'],
            ]
        ];

        $supplier->update($info);
        session()->flash('true');

        return redirect(route('admin.supplier'));
    }

    public function updateStatus($request)
    {
        $supplier = Supplier::singleSupplier($request->id);
        $supplier->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect(route('admin.supplier'));
    }

    public function destroy($request)
    {
        $supplier = Supplier::singleSupplier($request->id);
        $supplier->delete();
        session()->flash('true');

        return redirect(route('admin.supplier'));
    }

}
