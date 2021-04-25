<?php

namespace Modules\Appearance\Services;


use \Modules\Appearance\Repositories\ThemeRepository;
use App\Traits\UploadTheme;

class ThemeService{
    use UploadTheme;
    protected $themeRepository;

    public function __construct(ThemeRepository  $themeRepository)
    {
        $this->themeRepository = $themeRepository;
    }

    public function getAll(){
        return $this->themeRepository->getAll();
    }
    public function getAllActive(){
        return $this->themeRepository->getAllActive();
    }

    public function isActive($data, $id){

        return $this->themeRepository->isActive($data, $id);
    }

    public function ActiveOne(){
        return $this->themeRepository->ActiveOne();
    }
    public function showById($id){
        return $this->themeRepository->show($id);
    }

    public function delete($id){
        $data = $this->themeRepository->show($id);

        $assetSrc = base_path('public/frontend/'.$data->folder_path);
        $viewSrc = base_path('resources/views/frontend/'.$data->folder_path);
        $this->delete_directory($assetSrc);
        $this->delete_directory($viewSrc);
        $data->delete();
    }

}
