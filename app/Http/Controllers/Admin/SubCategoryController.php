<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Interfaces\SubCategory\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    private $subCategory;

    public function __construct(SubCategoryRepositoryInterface $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->subCategory->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subCategory->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryRequest $request
     */
    public function store(SubCategoryRequest $request)
    {
        return $this->subCategory->store($request);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     */
    public function updateStatus(Request $request)
    {
        return $this->subCategory->updateStatus($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->subCategory->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryRequest $request
     */
    public function update(SubCategoryRequest $request)
    {
        return $this->subCategory->update($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
       return $this->subCategory->destroy($request);
    }
}
