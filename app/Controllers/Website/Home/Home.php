<?php

namespace App\Controllers\Website\Home;

use App\Controllers\BaseController;

use App\Models\Website\Home\HomeModel;

class Home extends BaseController
{

    protected $homeModel;
    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        session()->set('menu', 'home');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Home'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite,
            'is_menu' => 'home'
        ];

        return view('website/home/body', $data);
    }
}
