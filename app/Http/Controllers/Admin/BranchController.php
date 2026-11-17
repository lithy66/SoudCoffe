<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Interfaces\Branch\BranchRepositoryInterface;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Supplier;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $branch;

    public function __construct(BranchRepositoryInterface $branch)
    {
        $this->branch = $branch;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->branch->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->branch->create();
    }

    /**
     * Store a newly created resource in storage.
     * @param BranchRequest $request
     */
    public function store(BranchRequest $request)
    {
        return $this->branch->store($request);
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
     * @return Factory|View|RedirectResponse
     */
    public function edit($id)
    {
       return $this->branch->edit($id);
    }

    /**
     * Update the specified resource in storage.
     * @param BranchRequest $request
     */
    public function update(BranchRequest $request)
    {
        return $this->branch->update($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->branch->updateStatus($request);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        return $this->branch->destroy($request);
    }
}
