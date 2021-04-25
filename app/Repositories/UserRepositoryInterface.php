<?php

namespace App\Repositories;

interface UserRepositoryInterface
{


    public function create(array $data);

    public function store(array $data);

    public function update(array $data, $id);
}
