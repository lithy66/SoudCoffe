<?php
namespace App\Repository\MaterialSubCategory;

use App\Interfaces\MaterialSubCategory\MaterialSubCategoryRepositoryInterface;

use App\Models\MaterialCategory;
use Illuminate\Support\Facades\Auth;

class MaterialSubCategoryRepository implements MaterialSubCategoryRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.materialSC');
       $data['materialSC'] = MaterialCategory::getSubMaterial();

       return view('admin.materialSC.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.materialSC');
        $data['materials'] = MaterialCategory::active();
        return view('admin.materialSC.add',$data);
    }

    public function store($request)
    {

        $info = [

          'parent_id' => $request->parent_id,
          'code' => $request->code,

          'ar' => [
              'name' => $request->ar['name'],
          ],

          'en' => [
                'name' => $request->en['name'],
            ]
        ];

        MaterialCategory::create($info);

        session()->flash('true');
        return redirect()->route('admin.materialSC');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.materialSC');
        $data['materialSC'] = MaterialCategory::singleMaterial($id);
        if (!$data['materialSC']){
            session()->flash('false');
            return redirect()->route('admin.materialSC');
        }
        $data['materials'] = MaterialCategory::active();
        return view('admin.materialSC.edit',$data);
    }

    public function update($request)
    {

        $materialSC = MaterialCategory::find($request->id);

        $info = [

            'parent_id' => $request->parent_id,
            'code' => $request->code,

            'ar' => [
                'name' => $request->ar['name'],
            ],

            'en' => [
                'name' => $request->en['name'],
            ]
        ];

        $materialSC->update($info);
        session()->flash('true');
        return redirect()->route('admin.materialSC');
    }

    public function updateStatus($request)
    {
        $materialSC = MaterialCategory::singleMaterial($request->id);
        $materialSC->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.materialSC');
    }

    public function destroy($request)
    {
        $materialSC = MaterialCategory::singleMaterial($request->id);
        $materialSC->delete();
        session()->flash('true');

        return redirect()->route('admin.materialSC');
    }
}
