<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
use App\Interfaces\Warehouse\WarehouseRepositoryInterfaces;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private $warehouse;

    public function __construct(WarehouseRepositoryInterfaces $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->warehouse->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->warehouse->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param WarehouseRequest $request
     */
    public function store(WarehouseRequest $request)
    {
        return $this->warehouse->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
        return $this->warehouse->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param WarehouseRequest $request
     */
    public function update(WarehouseRequest $request)
    {
        return $this->warehouse->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->warehouse->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->warehouse->destroy($request);
    }
}
