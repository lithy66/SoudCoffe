<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Branch\BranchRepositoryInterface;
use App\Models\Material;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    private $part;

    public function __construct(BranchRepositoryInterface $part)
    {
        $this->part = $part;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param $id
     */
    public function create($id)
    {
        return $this->part->create($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $material_id
     * @return void
     */
    public function store(Request $request, $material_id)
    {
        return $this->part->store($request, $material_id);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
