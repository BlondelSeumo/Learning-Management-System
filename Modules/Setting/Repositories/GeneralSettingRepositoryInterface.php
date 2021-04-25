<?php

namespace Modules\Setting\Repositories;

interface GeneralSettingRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);

    public function update(array $data);

    public function delete($id);
}
