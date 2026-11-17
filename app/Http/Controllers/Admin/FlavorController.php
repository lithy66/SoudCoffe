<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlavorRequest;
use App\Interfaces\Flavor\FlavorRepositoryInterface;
use Illuminate\Http\Request;

class FlavorController extends Controller
{

    private $flavor;

    public function __construct(FlavorRepositoryInterface $flavor)
    {
        $this->flavor = $flavor;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->flavor->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->flavor->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param FlavorRequest $request
     */
    public function store(FlavorRequest $request)
    {
        return $this->flavor->store($request);
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
     */
    public function edit($id)
    {
        return $this->flavor->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param FlavorRequest $request
     */
    public function update(FlavorRequest $request)
    {
        return $this->flavor->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->flavor->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->flavor->destroy($request);
    }
}
