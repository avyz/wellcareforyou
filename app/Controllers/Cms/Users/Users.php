<?php

namespace App\Controllers\Cms\Users;

use App\Controllers\BaseController;

use App\Models\Cms\Users\UsersModel;
use App\Models\HelperModel;

class Users extends BaseController
{

    protected $userModel;
    protected $helperModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->helperModel = new HelperModel();
    }

    public function index()
    {
        if (session()->get('email')) {
            $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
            $data = [
                'title' => $this->setTitle('Dashboard'),
                'metaDescription' => $this->setMetaDescription($description),
                'layout' => $this->dirLayoutCms,
                'section' => $this->dirSectionCms
            ];
            return view('cms/users/body', $data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
        }
    }
}
