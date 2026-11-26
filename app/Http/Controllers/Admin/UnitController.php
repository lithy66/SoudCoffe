<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\UnitRequest;
use App\Http\Requests\UnitRequest;
use App\Interfaces\Unit\UnitRepositoryInterface;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    private $unit;

    public function __construct(UnitRepositoryInterface $unit)
    {
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->unit->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->unit->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Request
     */
    public function store(UnitRequest $request)
    {
//        return $request;
        return $this->unit->store($request);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     */
    public function updateStatus(Request $request)
    {
        return $this->unit->updateStatus($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
       return $this->unit->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param UnitRequest $request
     */
    public function update(UnitRequest $request)
    {
        return $this->unit->update($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
       return $this->unit->destroy($request);
    }
}
