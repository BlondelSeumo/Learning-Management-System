<?php

namespace Modules\Appearance\Repositories;

use \Modules\Appearance\Entities\Theme;


class ThemeRepository
{

    protected Theme $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getAll()
    {
        return $this->theme::all();
    }

    public function getAllActive()
    {

        return $this->theme::where('status', 1)->where('is_active', 0)->get();
    }

    public function activeThemes()
    {
        return $this->theme::where('is_active', 1)->get();
    }

    public function isActive($id)
    {

        $items = $this->activeThemes();
        foreach ($items as $item) {
            $this->theme::where('id', $item->id)->update([
                    'is_active' => 0
                ]
            );
        }

        return $this->theme::where('id', $id)->update([
            'is_active' => 1
        ]);

    }

    public function ActiveOne()
    {
        return $this->theme::where('is_active', 1)->firstOrFail();
    }

    public function show($id)
    {
        return $this->theme::where('id', $id)->firstOrFail();
    }

}
