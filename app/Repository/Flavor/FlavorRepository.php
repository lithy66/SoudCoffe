<?php


namespace App\Repository\Flavor;


use App\Interfaces\Flavor\FlavorRepositoryInterface;
use App\Models\Flavor;
use Illuminate\Support\Facades\Auth;

class FlavorRepository implements FlavorRepositoryInterface
{
    public function index()
    {
        $data['header_title'] = __('admin/sidebar.flavor');
        $data['flavor'] = Flavor::getFlavor();

        return view('admin.Flavor.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.flavor');
        return view('admin.flavor.add', $data);
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

        Flavor::create($info);
        session()->flash('true');

        return redirect(route('admin.flavor'));
    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.flavor');
        $data['flavor'] = Flavor::singleFlavor($id);

        if (!$data['flavor'])
        {
            session()->flash('false');
            return redirect(route('admin.flavor'));
        }

        return view('admin.flavor.edit', $data);
    }

    public function update($request)
    {

        $Flavor = Flavor::singleFlavor($request->id);

        $info = [
            'admin_id' => Auth::user()->id,

            'ar' => [
                'name' => $request->ar['name']
            ],

            'en' => [
                'name' => $request->en['name']
            ]
        ];

        $Flavor->update($info);
        session()->flash('true');
        return redirect(route('admin.flavor'));
    }

    public function updateStatus($request)
    {
        $Flavor = Flavor::singleFlavor($request->id);
        $Flavor->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect(route('admin.flavor'));
    }

    public function destroy($request)
    {
        $Flavor = Flavor::singleFlavor($request->id);
        $Flavor->delete();
        session()->flash('true');

        return redirect(route('admin.flavor'));
    }
}
