<?php
namespace App\Repository\MaterialC;

use App\Interfaces\MaterialC\MaterialCRepositoryInterface;
use App\Models\MaterialCategory;


class MaterialCRepository implements MaterialCRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.materialC');
       $data['material'] = MaterialCategory::getMaterial();

       return view('admin.materialC.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.materialC');
        return view('admin.materialC.add',$data);
    }

    public function store($request)
    {
        $info = [

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
        return redirect()->route('admin.materialC');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.materialC');
        $data['material'] = MaterialCategory::singleMaterial($id);
        if (!$data['material']){
            session()->flash('false');
            return redirect()->route('admin.materialC');
        }
        return view('admin.materialC.edit',$data);
    }

    public function update($request)
    {

        $material = MaterialCategory::find($request->id);

        $info = [

            'code' => $request->code,

            'ar' => [
                'name' => $request->ar['name'],
            ],

            'en' => [
                'name' => $request->en['name'],
            ]
        ];


        $material->update($info);
        session()->flash('true');
        return redirect()->route('admin.materialC');
    }

    public function updateStatus($request)
    {
        $material = MaterialCategory::singleMaterial($request->id);
        $material->update(['is_active' => $request->is_active]);

        session()->flash('true');
        return redirect()->route('admin.materialC');
    }

    public function destroy($request)
    {
        $material = MaterialCategory::singleMaterial($request->id);
        $material->delete();
        session()->flash('true');

        return redirect()->route('admin.materialC');
    }
}
