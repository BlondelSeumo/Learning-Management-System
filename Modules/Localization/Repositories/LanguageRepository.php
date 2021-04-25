<?php

namespace Modules\Localization\Repositories;

use Modules\Localization\Entities\Language;

use Modules\Localization\Repositories\LanguageRepositoryInterface;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function all()
    {
        return Language::orderBy('status', 'desc')->get();
    }

    public function create(array $data)
    {
        $language = new Language();
        $language->fill($data)->save();
    }

    public function find($id)
    {
        return Language::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return Language::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Language::findOrFail($id)->delete();
    }
}
