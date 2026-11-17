<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    Private $PurchaseOrder;

    public function __construct(PurchaseOrderRepositoryInterface $PurchaseOrder)
    {
        $this->PurchaseOrder = $PurchaseOrder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->PurchaseOrder->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->PurchaseOrder->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->PurchaseOrder->store($request);
    }

    /**
     * Display the specified resource.
     * @param $id
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
        return $this->PurchaseOrder->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     */
    public function update(Request $request)
    {
        return $this->PurchaseOrder->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->PurchaseOrder->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->PurchaseOrder->destroy($request);
    }
}
