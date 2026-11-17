<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Interfaces\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->category->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->category->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param categoryRequest $request
     */
    public function store(categoryRequest $request)
    {
        return $this->category->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function updateStatus(Request $request)
    {
        return $this->category->updateStatus($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->category->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param categoryRequest $request
     */
    public function update(categoryRequest $request)
    {
        return $this->category->update($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
       return $this->category->destroy($request);
    }
}
