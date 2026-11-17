<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->product->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->product->create();
    }

    public function subCategory($id)
    {
        return $this->product->subCategory($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        return $this->product->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
        return $this->product->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     */
    public function update(ProductRequest $request)
    {
        return $this->product->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->product->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->product->destroy($request);
    }
}
