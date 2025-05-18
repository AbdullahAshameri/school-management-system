<?php

namespace App\Repository;

interface DegreeRepositoryInterface
{
    public function index();
    public function show($id);
    public function create();
    public function store($request);
    public function edit($id);
    public function destroy($id);
    public function update($request);  // Two parameters: id and request
}

