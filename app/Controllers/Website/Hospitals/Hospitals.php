<?php

namespace App\Controllers\Website\Hospitals;

use App\Controllers\BaseController;

use App\Models\Website\Hospitals\HospitalsModel;

class Hospitals extends BaseController
{

    protected $hospitalsModel;
    public function __construct()
    {
        $this->hospitalsModel = new HospitalsModel();
    }

    public function index()
    {
        session()->set('menu', 'hospitals');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Hospitals'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/hospitals/body', $data);
    }

    public function single($hospital_name)
    {
        session()->set('menu', 'hospitals');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle($hospital_name),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/hospitals/single', $data);
    }

    public function package($hospital_name, $package_name)
    {
        session()->set('menu', 'hospitals');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle($hospital_name . " - " . $package_name),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/hospitals/package', $data);
    }
}
