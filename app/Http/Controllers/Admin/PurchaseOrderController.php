<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrderRequest;
use App\Interfaces\PurchaseOrder\PurchaseOrderRepositoryInterface;
use App\Models\PurchaseOrder;
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
     * @param PurchaseOrderRequest $request
     */
    public function store(PurchaseOrderRequest $request)
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
     * @param $purchaseOrder
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return $this->PurchaseOrder->edit($purchaseOrder);
    }

    /**
     * Update the specified resource in storage.
     * @param PurchaseOrderRequest $request
     */
    public function update(PurchaseOrderRequest $request)
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
