<?php


namespace App\Interfaces\Warehouse;


interface WarehouseRepositoryInterfaces
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function updateStatus($request);

    public function destroy($request);

}
