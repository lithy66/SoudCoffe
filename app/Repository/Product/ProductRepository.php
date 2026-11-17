<?php


namespace App\Repository\Product;

use App\Http\Requests\ProductRequest;
use App\Interfaces\Product\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{
    use UploadImageTrait;

    public function index()
    {
        $data['header_title'] = __('admin/sidebar.product');
        $data['product'] = Product::getProduct();

        return view('admin.product.index', $data);
    }

    public function create()
    {
        $data['header_title'] = __('general.add').' '. __('admin/sidebar.product');
        $data['categories'] = Category::ActiveMain()->get();
        return view('admin.product.add', $data);
    }

    public function subCategory($id)
    {
        echo json_encode (Category::select('*')->where('parent_id', $id)->where('is_active', 1)->get());

    }

    public function store($request)
    {
        $product = Product::create([
            'category_id' => $request->category_id,
            'flavor' => $request->type,
            'price' => $request->price,
            'ar' => [
                'name' => $request->ar['name'],
                'description' => $request->ar['description']
            ],
            'en' => [
                'name' => $request->en['name'],
                'description' => $request->en['description']
            ]
        ]);
        $id = $product->id;
        if ($request->type === 'powder')
        {
           $variants = ProductVariant::create([
               'product_id' => $id,
               'stock' => $request->stock,
               'sku' => $request->sku,
               'ar' => [
                 'weight' => $request->ar['weight'],
                 'grind_type' => $request->ar['grind_type'],
                 'roast_level' => $request->ar['roast_level']
               ],
               'en' => [
                  'weight' => $request->en['weight'],
                  'grind_type' => $request->en['grind_type'],
                  'roast_level' => $request->en['roast_level']
               ],
           ]);
        }
        if ($request->has('photo'))
        {
            $this->upload($request, "photo", 'Products', 'upload_image', $id, 'App\Models\Product');
        }

        session()->flash('true');
        return redirect()->route('admin.product')->with(['success' => __('message.true')]);

    }

    public function edit($id)
    {
        $data['header_title'] = __('general.edit').' '.__('general.product');
        $data['product'] = Category::singleTrans($id);

        if (!$data['product'])
        {
            session()->flash('false');
            return redirect(route('admin.product'));
        }

        return view('admin.product.edit', $data);
    }

    public function update($request)
    {
        $trans = Category::find($request->id);

        $info = [
          'user_id' => Auth::user()->id,
            'ar' => [
                'name' => $request->ar['name']
            ],
            'en' => [
                'name' => $request->en['name']
            ]
        ];

        $trans->update($info);
        session()->flash('true');
        return redirect(route('admin.product'));
    }

    public function updateStatus($request)
    {
        $trans = Category::singleTrans($request->id);
        $trans->update(['is_active' => $request->status]);

        session()->flash('true');
        return redirect(route('admin.product'));
    }

    public function destroy($request)
    {
        $trans = Category::singleTrans($request->id);
        $trans->delete();
        session()->flash('true');

        return redirect(route('admin.product'));
    }

}
