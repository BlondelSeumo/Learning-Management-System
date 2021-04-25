<?php

namespace Modules\FooterSetting\Services;

use Modules\FooterSetting\Repositories\FooterWidgetRepository;

class FooterWidgetService
{


    protected $footerWidgetRepository;

    public function __construct(FooterWidgetRepository $footerWidgetRepository)
    {
        $this->footerWidgetRepository = $footerWidgetRepository;
    }

    public function getAll()
    {
        return $this->footerWidgetRepository->getAll();
    }

    public function getAllCompany()
    {
        return $this->footerWidgetRepository->getAllCompany();
    }

    public function getAllAccount()
    {
        return $this->footerWidgetRepository->getAllAccount();
    }

    public function getAllService()
    {
        return $this->footerWidgetRepository->getAllService();
    }

    public function save($data)
    {
        return $this->footerWidgetRepository->save($data);
    }

    public function statusUpdate($data, $id)
    {

        return $this->footerWidgetRepository->statusUpdate($data, $id);
    }

    public function update($data, $id)
    {
        return $this->footerWidgetRepository->update($data, $id);
    }

    public function editById($id)
    {
        return $this->footerWidgetRepository->edit($id);
    }

    public function delete($id)
    {
        return $this->footerWidgetRepository->delete($id);
    }

}
