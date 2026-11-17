<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Interfaces\Supplier\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    private $supplier;

    public function __construct(SupplierRepositoryInterface $supplier)
    {
        $this->supplier = $supplier;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->supplier->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->supplier->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param SupplierRequest $request
     */
    public function store(SupplierRequest $request)
    {
        return $this->supplier->store($request);
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
        return $this->supplier->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param SupplierRequest $request
     */
    public function update(SupplierRequest $request)
    {
        return $this->supplier->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->supplier->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->supplier->destroy($request);
    }
}
