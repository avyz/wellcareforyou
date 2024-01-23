<?php

namespace App\Controllers\Website\Doctors;

use App\Controllers\BaseController;

use App\Models\Website\Doctors\DoctorsModel;

class Doctors extends BaseController
{

    protected $doctorsModel;
    public function __construct()
    {
        $this->doctorsModel = new DoctorsModel();
    }

    public function index($specialists = "")
    {
        session()->set('menu', 'doctors');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle($specialists ? 'Specialist ' . $specialists : 'Doctors'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/doctors/body', $data);
    }

    public function profile($doctor_name)
    {
        session()->set('menu', 'doctors');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Doctor ' . $doctor_name . ' profle'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/doctors/profile', $data);
    }

    public function appointment($doctor_name)
    {
        session()->set('menu', 'doctors');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Doctor ' . $doctor_name . ' appointment'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/doctors/appointment', $data);
    }
}
