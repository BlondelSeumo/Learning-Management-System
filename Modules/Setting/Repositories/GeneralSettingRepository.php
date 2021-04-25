<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Model\GeneralSetting;

use Modules\Setting\Repositories\GeneralSettingRepositoryInterface;

class GeneralSettingRepository implements GeneralSettingRepositoryInterface
{
    public function all()
    {
        //
    }

    public function create(array $data)
    {
        //
    }

    public function find($id)
    {

    }

    public function update(array $data)
    {
        return GeneralSetting::first()->update($data);
    }

    public function delete($id)
    {
        //
    }
}
