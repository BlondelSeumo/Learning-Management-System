<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Model\Currency;

use Modules\Setting\Repositories\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function all()
    {
        return Currency::orderBy('name','asc')->get();
    }

    public function create(array $data)
    {
        $currency = new Currency();
        $currency->fill($data)->save();
    }

    public function find($id)
    {
        return Currency::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return Currency::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Currency::findOrFail($id)->delete();
    }
}
