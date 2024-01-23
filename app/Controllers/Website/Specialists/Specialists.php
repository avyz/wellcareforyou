<?php

namespace App\Controllers\Website\Specialists;

use App\Controllers\BaseController;

use App\Models\Website\Specialists\SpecialistsModel;

class Specialists extends BaseController
{

    protected $specialistsModel;
    public function __construct()
    {
        $this->specialistsModel = new SpecialistsModel();
    }

    public function index()
    {
        session()->set('menu', 'specialists');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Specialists'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/specialists/body', $data);
    }
}
