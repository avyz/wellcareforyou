<?php

namespace App\Controllers\Website\Pharmacies;

use App\Controllers\BaseController;

use App\Models\Website\Pharmacies\PharmaciesModel;

class Pharmacies extends BaseController
{

    protected $pharmaciesModel;
    public function __construct()
    {
        $this->pharmaciesModel = new PharmaciesModel();
    }

    public function index()
    {
        session()->set('menu', 'pharmacies');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Pharmacies'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/pharmacies/body', $data);
    }
}
