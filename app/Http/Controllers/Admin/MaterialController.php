<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Interfaces\Material\MaterialRepositoryInterface;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    private $material;

    public function __construct(MaterialRepositoryInterface $material)
    {
        $this->material = $material;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->material->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->material->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param MaterialRequest $request
     */
    public function store(MaterialRequest $request)
    {
        return $this->material->store($request);
    }

    /**
     * Display the specified resource.
     * @param string $id
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
        return $this->material->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param MaterialRequest $request
     */
    public function update(MaterialRequest $request)
    {
        return $this->material->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->material->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->material->destroy($request);
    }
}
