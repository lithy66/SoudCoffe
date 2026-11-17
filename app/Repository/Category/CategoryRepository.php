<?php
namespace App\Repository\Category;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.category');
       $data['category'] = Category::getCategory();

       return view('admin.category.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.category');
        return view('admin.category.add',$data);
    }

    public function store($request)
    {
        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $info = [
          'is_active' => $request->is_active,
           'admin_id' => auth('admin')->id(),


          'ar' => [
              'name' => $request->ar['name'],
          ],
          'en' => [
                'name' => $request->en['name'],
            ]
        ];

        Category::create($info);

        session()->flash('true');
        return redirect()->route('admin.category');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.category');
        $data['category'] = Category::singleCategory($id);
        if (!$data['category']){
            session()->flash('false');
            return redirect()->route('admin.category');
        }
        return view('admin.category.edit',$data);
    }

    public function update($request)
    {

        $category = Category::find($request->id);

        $info = [

            'admin_id' => auth('admin')->id(),

            'ar' => [
                'name' => $request->ar['name'],
            ],
            'en' => [
                'name' => $request->en['name'],
            ]
        ];

        $category->update($info);
        session()->flash('true');
        return redirect()->route('admin.category');
    }

    public function updateStatus($request)
    {
        $category = Category::singleCategory($request->id);
        $category->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.category');
    }

    public function destroy($request)
    {
        $category = Category::singleCategory($request->id);
        $category->delete();
        session()->flash('true');

        return redirect()->route('admin.category');
    }
}
