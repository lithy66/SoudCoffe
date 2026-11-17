<?php
namespace App\Repository\Unit;

use App\Interfaces\Unit\UnitRepositoryInterface;
use App\Models\Category;
use App\Models\Unit;


class UnitRepository implements UnitRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.unit');
       $data['unit'] = Unit::getUnit();

       return view('admin.unit.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.unit');
        return view('admin.unit.add',$data);
    }

    public function store($request)
    {

        $info = [
          'symbol' => $request->symbol,
          'conversion_factory' => $request->conversion_factory,

          'ar' => [
              'name' => $request->ar['name'],
          ],
          'en' => [
                'name' => $request->en['name'],
            ]
        ];

        Unit::create($info);

        session()->flash('true');
        return redirect()->route('admin.unit');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.unit');
        $data['unit'] = Unit::singleUnit($id);
        if (!$data['unit']){
            session()->flash('false');
            return redirect()->route('admin.unit');
        }
        return view('admin.unit.edit',$data);
    }

    public function update($request)
    {

        $unit = Unit::find($request->id);

        $info = [
            'symbol' => $request->symbol,
            'conversion_factory' => $request->conversion_factory,

            'ar' => [
                'name' => $request->ar['name'],
            ],
            'en' => [
                'name' => $request->en['name'],
            ]
        ];

        $unit->update($info);
        session()->flash('true');
        return redirect()->route('admin.unit');
    }

    public function updateStatus($request)
    {
        $unit = Unit::singleUnit($request->id);
        $unit->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.unit');
    }

    public function destroy($request)
    {
        $unit = Unit::singleUnit($request->id);
        $unit->delete();
        session()->flash('true');

        return redirect()->route('admin.unit');
    }
}
