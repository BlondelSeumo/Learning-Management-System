<?php

namespace Modules\FooterSetting\Repositories;


use Modules\Setting\Model\GeneralSetting;

class FooterSettingRepository
{

    protected $footer;

    public function __construct(GeneralSetting $footer)
    {
        $this->footer = $footer;
    }

    public function getAll()
    {
        return $this->footer::firstOrFail();
    }


    public function update($data, $id)
    {


        $item = $this->footer::where('id', $id)->first();

        return $this->footer::where('id', $id)->update([
            'footer_copy_right' => isset($data['copy_right']) ? $data['copy_right'] : $item->footer_copy_right,
            'footer_about_title' => isset($data['about_title']) ? $data['about_title'] : $item->footer_about_title,
            'footer_about_description' => isset($data['about_description']) ? $data['about_description'] : $item->footer_about_description,
            'footer_section_one_title' => isset($data['company_title']) ? $data['company_title'] : $item->footer_section_one_title,
            'footer_section_two_title' => isset($data['account_title']) ? $data['account_title'] : $item->footer_section_two_title,
            'footer_section_three_title' => isset($data['service_title']) ? $data['service_title'] : $item->footer_section_three_title
        ]);

    }

    public function edit($id)
    {
        $footer = $this->footer->findOrFail($id);
        return $footer;
    }
}
