<?php
namespace App\Repository\SubCategory;

use App\Interfaces\SubCategory\SubCategoryRepositoryInterface;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function index()
    {
       $data['header_title'] = __('admin/sidebar.sub category');
       $data['subCategory'] = Category::getSubCategory();

       return view('admin.subcategory.index',$data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.sub category');
        $data['categories'] = Category::active();
        return view('admin.subcategory.add',$data);
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
          'parent_id' => $request->parent_id,


          'ar' => [
              'name' => $request->ar['name'],
          ],
          'en' => [
                'name' => $request->en['name'],
            ]
        ];

        Category::create($info);

        session()->flash('true');
        return redirect()->route('admin.subCategory');
    }

    public function edit($id)
    {
        $data['header_title'] =__('general.edit')." ". __('admin/sidebar.sub category');
        $data['category'] = Category::singleCategory($id);
        if (!$data['category']){
            session()->flash('false');
            return redirect()->route('admin.category');
        }
        $data['categories'] = Category::getCategory();
        return view('admin.subCategory.edit',$data);
    }

    public function update($request)
    {

//        return $request;
        $category = Category::find($request->id);

        $info = [

            'admin_id' => auth('admin')->id(),
            'parent_id' => $request->parent_id,

            'ar' => [
                'name' => $request->ar['name'],
            ],
            'en' => [
                'name' => $request->en['name'],
            ]
        ];

        $category->update($info);
        session()->flash('true');
        return redirect()->route('admin.subCategory');
    }

    public function updateStatus($request)
    {
        $category = Category::singleCategory($request->id);
        $category->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect()->route('admin.subCategory');

    }

    public function destroy($request)
    {
        $category = Category::singleCategory($request->id);
        $category->translate->delete();
        $category->delete();
        session()->flash('true');

        return redirect()->route('admin.subCategory');
    }
}
