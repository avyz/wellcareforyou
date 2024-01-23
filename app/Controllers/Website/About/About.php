<?php

namespace App\Controllers\Website\About;

use App\Controllers\BaseController;

use App\Models\Website\About\AboutModel;

class About extends BaseController
{

    protected $aboutModel;
    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    public function index()
    {
        session()->set('menu', 'about');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('About'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/about/body', $data);
    }
}
