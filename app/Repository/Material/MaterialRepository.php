<?php


namespace App\Repository\Material;


use App\Interfaces\Material\MaterialRepositoryInterface;
use App\Models\Image;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\RoastLevel;
use App\Models\Unit;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialRepository implements MaterialRepositoryInterface
{
    use UploadImageTrait;

    public function index()
    {
        $data['header_title'] = __('admin/sidebar.materials');
        $data['materials'] = Material::getMaterial();

        return view('admin.material.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '.__('admin/sidebar.materials');
        $data['categories'] = MaterialCategory::Active();
        $data['units'] = Unit::Active();
        $data['roasts'] = RoastLevel::Active();

        return view('admin.material.add', $data);
    }

    public function store($request)
    {
        if (!$request->has('is_perishable'))
            $request->request->add(['is_perishable' => 0]);
        else
            $request->request->add(['is_perishable' => 1]);

    DB::beginTransaction();
        try {
            $material = new Material;
            $material->material_category_id = $request->material_category_id;
            $material->unit_id = $request->unit_id;
            $material->roast_level_id = $request->roast_level_id;
            $material->barcode = $request->barcode;
            $material->min_stock_level = $request->min_stock_level;
            $material->reorder_level = $request->reorder_level;
            $material->max_stock_level = $request->max_stock_level;
            $material->cost_price = $request->cost_price;
            $material->currency = $request->currency;
            $material->shelf_life_days = $request->shelf_life_days;
            $material->is_perishable = $request->is_perishable;

            $material->translateOrNew('ar')->name = $request->ar['name'];
            $material->translateOrNew('ar')->description = $request->ar['description'];
            $material->translateOrNew('ar')->notes = $request->ar['notes'];

            $material->translateOrNew('en')->name = $request->en['name'];
            $material->translateOrNew('en')->description = $request->en['description'];
            $material->translateOrNew('en')->notes = $request->en['notes'];
            $material->save();

            $id = $material->id;
            $this->upload($request, 'photo', 'Materials', 'upload_image', $id, Material::class);

            DB::commit();
            session()->flash('true');
            return redirect(route('admin.material'));

        }catch (\Exception $exception)
        {
            DB::rollBack();
            session()->flash('false');
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }


    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('admin/sidebar.materials');
        $data['categories'] = MaterialCategory::Active();
        $data['units'] = Unit::Active();
        $data['roasts'] = RoastLevel::Active();
        $data['material'] = Material::singleMaterial($id);

        if (!$data['material']){
            session()->flash('false');
            return redirect()->route('admin.material');
        }

        return view('admin.material.edit', $data);
    }

    public function update($request)
    {
        if (!$request->has('is_perishable'))
            $request->request->add(['is_perishable' => 0]);
        else
            $request->request->add(['is_perishable' => 1]);

        $material = Material::singleMaterial($request->id);
        $material->material_category_id = $request->material_category_id;
        $material->unit_id = $request->unit_id;
        $material->roast_level_id = $request->roast_level_id;
        $material->barcode = $request->barcode;
        $material->min_stock_level = $request->min_stock_level;
        $material->reorder_level = $request->reorder_level;
        $material->max_stock_level = $request->max_stock_level;
        $material->cost_price = $request->cost_price;
        $material->currency = $request->currency;
        $material->shelf_life_days = $request->shelf_life_days;
        $material->is_perishable = $request->is_perishable;

        $material->translateOrNew('ar')->name = $request->ar['name'];
        $material->translateOrNew('ar')->description = $request->ar['description'];
        $material->translateOrNew('ar')->notes = $request->ar['notes'];

        $material->translateOrNew('en')->name = $request->en['name'];
        $material->translateOrNew('en')->description = $request->en['description'];
        $material->translateOrNew('en')->notes = $request->en['notes'];
        $material->save();

        if ($request->has('photo')){
            $this->Delete_attachment($material->id, Material::class, 'upload_image');
            $this->upload($request, 'photo', 'Materials', 'upload_image', $request->id, Material::class);
        }


        session()->flash('true');
        return redirect()->route('admin.material');
    }

    public function updateStatus($request)
    {
        $material = Material::singleMaterial($request->id);
        $material->update(['is_active' => $request->is_active]);

        session()->flash('true');
        return redirect()->route('admin.material');
    }

    public function destroy($request)
    {
        $material = Material::singleMaterial($request->id);
        $material->delete();
        session()->flash('true');

        return redirect()->route('admin.material');
    }
}


