<?php

namespace App\Controllers\Cms\Pages;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Pages\PagesModel;

class Pages extends BaseController
{
    protected $pagesModel;
    protected $helperModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->pagesModel = new PagesModel();
        $this->generalController = new General();
    }

    public function dataPages()
    {
    }
}
