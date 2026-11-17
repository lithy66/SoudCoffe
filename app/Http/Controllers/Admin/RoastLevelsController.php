<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\roastLevelsRequest;
use App\Http\Requests\RoastRequest;
use App\Interfaces\RoastLevels\RoastLevelsRepositoryInterface;
use Illuminate\Http\Request;

class RoastLevelsController extends Controller
{

    private $roastLevels;

    public function __construct(RoastLevelsRepositoryInterface $roastLevels)
    {
        $this->roastLevels = $roastLevels;
    }

    /**
     * Display a listing of the resource.
     * @param $id
     */
    public function index()
    {
        return $this->roastLevels->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->roastLevels->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param RoastRequest $request
     */
    public function store(RoastRequest $request)
    {
        return $this->roastLevels->store($request);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     */
    public function show(Request $request)
    {
        return $this->roastLevels->show($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
        return $this->roastLevels->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param RoastRequest $request
     */
    public function update(RoastRequest $request)
    {
        return $this->roastLevels->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->roastLevels->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->roastLevels->destroy($request);
    }
}
