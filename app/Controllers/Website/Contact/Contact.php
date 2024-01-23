<?php

namespace App\Controllers\Website\Contact;

use App\Controllers\BaseController;

use App\Models\Website\Contact\ContactModel;

class Contact extends BaseController
{

    protected $contactModel;
    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        session()->set('menu', 'contact-us');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Contact Us'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/contact/body', $data);
    }
}
