<?php


namespace App\Repository\RoastLevels;

use App\Interfaces\RoastLevels\RoastLevelsRepositoryInterface;
use App\Models\RoastLevel;
use Illuminate\Support\Facades\Auth;


class RoastLevelsRepository implements RoastLevelsRepositoryInterface
{
    public function index()
    {
        $data['header_title'] = __('admin/sidebar.roast level');
        $data['roastLevels'] = RoastLevel::getRoast();
        return view('admin.roastLevels.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.roast level');
        return view('admin.roastLevels.add', $data);
    }

    public function store($request)
    {
        $info = [
            'is_active' => 1,
            'admin_id' => Auth::user()->id,

            'ar' => [
                'name' => $request->ar['name']
            ],

            'en' => [
                'name' => $request->en['name']
            ]
        ];

        RoastLevel::create($info);
        session()->flash('true');

        return redirect(route('admin.roastLevels'));
    }

    public function show($request)
    {

    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.roast level');
        $data['roastLevels'] = RoastLevel::singleRoast($id);

        if (!$data['roastLevels']){
            session()->flash('false');
            return redirect(route('admin.roastLevels'));
        }

        return view('admin.roastLevels.edit', $data);
    }

    public function update($request)
    {

        $roast = RoastLevel::singleRoast($request->id);

        $info = [
            'admin_id' => Auth::user()->id,

            'ar' => [
                'name' => $request->ar['name']
            ],

            'en' => [
                'name' => $request->en['name']
            ]
        ];

        $roast->update($info);
        session()->flash('true');

        return redirect(route('admin.roastLevels'));
    }

    public function updateStatus($request)
    {
        $material = RoastLevel::singleRoast($request->id);
        $material->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect(route('admin.roastLevels'));
    }

    public function destroy($request)
    {
        $material = RoastLevel::singleRoast($request->id);
        $material->delete();
        session()->flash('true');

        return redirect(route('admin.roastLevels'));
    }
}
