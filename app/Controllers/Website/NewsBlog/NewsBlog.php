<?php

namespace App\Controllers\Website\NewsBlog;

use App\Controllers\BaseController;

use App\Models\Website\NewsBlog\NewsBlogModel;

class NewsBlog extends BaseController
{

    protected $newsBlogModel;
    public function __construct()
    {
        $this->newsBlogModel = new NewsBlogModel();
    }

    public function index()
    {
        session()->set('menu', 'newsblog');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('News & Blog'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/newsblog/body', $data);
    }

    public function detail($years, $month, $date, $title)
    {
        session()->set('menu', 'newsblog');
        $description = "News - " . $title;
        $data = [
            'title' => $this->setTitle('Detail - ' . $title),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/newsblog/detail', $data);
    }
}
