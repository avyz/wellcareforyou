<?php

namespace App\Controllers\Cms\Settings;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Settings\MiscModel;

class Misc extends BaseController
{
    protected $miscModel;
    protected $helperModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->miscModel = new MiscModel();
        $this->generalController = new General();
    }
}
