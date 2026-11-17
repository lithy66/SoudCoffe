<?php


namespace App\Repository\Branch;

use App\Interfaces\Branch\BranchRepositoryInterface;
use App\Models\Admin;
use App\Models\Branch;

class BranchRepository implements BranchRepositoryInterface
{
    public function index()
    {
        $data['header_title'] = __('admin/sidebar.branches');
        $data['branch'] = Branch::getBranch();

        return view('admin.branch.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.branches');
        $data['admin'] = Admin::active();

        return view('admin.branch.add', $data);
    }

    public function Store($request)
    {
        if (!$request->has('is_online'))
                $request->request->add(['is_online' => 0]);
            else
                $request->request->add(['is_online' => 1]);

        $branch = new Branch;
        $branch->type = $request->type;
        $branch->admin_id = $request->admin_id;
        $branch->phone = $request->phone;
        $branch->is_online = $request->is_online;
        $branch->open = $request->open;
        $branch->close = $request->close;

        $branch->translateOrNew('ar')->name = $request->ar['name'];
        $branch->translateOrNew('ar')->address = $request->ar['address'];

        $branch->translateOrNew('en')->name = $request->en['name'];
        $branch->translateOrNew('en')->address = $request->en['address'];
        $branch->save();

        session()->flash('true');
        return redirect(route('admin.branch'));
    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.branches');
        $data['admin'] = Admin::active();
        $data['branch'] = Branch::singleBranch($id);

        if (!$data['branch']){
            session()->flash('false');
            return redirect()->route('admin.branch');
        }

        return view('admin.branch.edit', $data);
    }

    public function update($request)
    {
        if (!$request->has('is_online'))
            $request->request->add(['is_online' => 0]);
        else
            $request->request->add(['is_online' => 1]);

        $branch = Branch::singleBranch($request->id);
        $branch->type = $request->type;
        $branch->admin_id = $request->admin_id;
        $branch->phone = $request->phone;
        $branch->is_online = $request->is_online;
        $branch->open = $request->open;
        $branch->close = $request->close;

        $branch->translateOrNew('ar')->name = $request->ar['name'];
        $branch->translateOrNew('ar')->address = $request->ar['address'];

        $branch->translateOrNew('en')->name = $request->en['name'];
        $branch->translateOrNew('en')->address = $request->en['address'];
        $branch->save();

        session()->flash('true');
        return redirect(route('admin.branch'));
    }

    public function updateStatus($request)
    {
        $branch = Branch::singleBranch($request->id);
        $branch->update(['is_active' => $request->is_active]);

        session()->flash('true');
        return redirect()->route('admin.branch');
    }

    public function destroy($request)
    {
        $branch = Branch::singleBranch($request->id);
        $branch->delete();
        session()->flash('true');

        return redirect()->route('admin.branch');
    }

}
