<?php
namespace App\Repository\BaseUnit;

use App\Interfaces\BaseUnit\BaseUnitRepositoryInterface;

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class BaseUnitRepository implements BaseUnitRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.base unit');
       $data['base'] = Unit::getBaseUnit();

       return view('admin.baseUnit.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.base unit');
        $data['unites'] = Unit::Active();
        return view('admin.baseUnit.add',$data);
    }

    public function store($request)
    {

        $info = [
            'symbol' => $request->symbol,
            'conversion_factory' => $request->conversion_factory,
            'base_unit_id' => $request->base_unit_id,

          'ar' => [
              'name' => $request->ar['name'],
          ],

          'en' => [
                'name' => $request->en['name'],
            ]
        ];

        Unit::create($info);

        session()->flash('true');
        return redirect()->route('admin.baseUnit');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.base unit');
        $data['base'] = Unit::singleUnit($id);
        if (!$data['base']){
            session()->flash('false');
            return redirect()->route('admin.baseUnit');
        }
        $data['unites'] = Unit::getUnit();
        return view('admin.baseUnit.edit',$data);
    }

    public function update($request)
    {

        $base = Unit::find($request->id);

        $info = [

            'symbol' => $request->symbol,
            'conversion_factory' => $request->conversion_factory,
            'base_unit_id' => $request->base_unit_id,

            'ar' => [
                'name' => $request->ar['name'],
            ],
            'en' => [
                'name' => $request->en['name'],
            ]
        ];

        $base->update($info);
        session()->flash('true');
        return redirect()->route('admin.baseUnit');
    }

    public function updateStatus($request)
    {
        $base = Unit::singleUnit($request->id);
        $base->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.baseUnit');

    }

    public function destroy($request)
    {
        $base = Unit::singleUnit($request->id);
        $base->delete();
        session()->flash('true');

        return redirect()->route('admin.baseUnit');
    }
}
