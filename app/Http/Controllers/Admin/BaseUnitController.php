<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseUnitRequest;
use App\Http\Requests\UnitRequest;
use App\Interfaces\BaseUnit\BaseUnitRepositoryInterface;
use Illuminate\Http\Request;

class BaseUnitController extends Controller
{

    private $baseUnit;

    public function __construct(BaseUnitRepositoryInterface $baseUnit)
    {
        $this->baseUnit = $baseUnit;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->baseUnit->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->baseUnit->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->baseUnit->store($request);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     */
    public function updateStatus(Request $request)
    {
        return $this->baseUnit->updateStatus($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->baseUnit->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param BaseUnitRequest $request
     */
    public function update(BaseUnitRequest $request)
    {
        return $this->baseUnit->update($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
       return $this->baseUnit->destroy($request);
    }
}
