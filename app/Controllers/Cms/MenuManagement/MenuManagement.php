<?php

namespace App\Controllers\Cms\MenuManagement;

use App\Controllers\BaseController;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\HelperModel;

class MenuManagement extends BaseController
{

    protected $helperModel;
    protected $menuManagementModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
    }

    public function index()
    {
        $uri = service('uri');
        // dd($uri);
        $lang_code = $this->request->getVar('lang');
        $data = [
            'layout' => $this->dirLayoutCms,
            'section' => $this->dirSectionCms,
            'idleTime' => $this->timeIdle,
            'sidebar' => $this->menuManagementModel::sidebar(),
            'dataMenu' => $this->menuManagementModel::menuBySlug($uri->getSegment(1), $lang_code),
            'breadcrumbs' => $this->menuManagementModel::breadCrumbsBySlug($lang_code),
            'language_row' => $this->menuManagementModel::languageByLangCode($lang_code)
        ];

        // dd($data['dataMenu']);

        if ($data['dataMenu']) {
            return $this->checkIdle(view('cms/menu-management/body', $data));
        }
        return redirect()->to('/login');
    }
}
