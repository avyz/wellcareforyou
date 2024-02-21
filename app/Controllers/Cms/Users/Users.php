<?php

namespace App\Controllers\Cms\Users;

use App\Controllers\BaseController;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\Cms\Users\UsersModel;
use App\Models\HelperModel;

class Users extends BaseController
{

    protected $userModel;
    protected $helperModel;
    protected $menuManagementModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
    }

    public function index()
    {
        $uri = service('uri');
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



        // $data_table = [
        //     'lang_code' => 'id',
        //     'language' => 'ID',
        //     'lang_icon' => 'flag-icon-indonesia.png',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1,
        //     'is_lang_default' => 1,
        // ];

        // $throw_id = false;
        // $table_name = 'lang_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);

        // $data_table = [
        //     'menu_slug' => 'user-management',
        //     'menu_name' => 'User Management',
        //     'menu_icon' => '<i class="ri-user-settings-line"></i>',
        //     'menu_url' => '/user-management',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1
        // ];

        // $throw_id = false;
        // $table_name = 'menu_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);

        // $data_table = [
        //     'menu_id' => 2,
        //     'menu_children_name' => 'Admin',
        //     'menu_children_icon' => '<i class="ri-bubble-chart-line"></i>',
        //     'menu_children_url' => '/menu-management/admin',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1
        // ];

        // $throw_id = false;
        // $table_name = 'menu_children_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);
        // $data_table = [
        //     'menu_children_id' => 3,
        //     'menu_tab_name' => 'Log User',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1
        // ];

        // $throw_id = false;
        // $table_name = 'menu_children_tab_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);

        // $data_table = [
        //     'menu_children_id' => 3,
        //     'menu_tab_name' => 'Log Auth',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1
        // ];

        // $throw_id = false;
        // $table_name = 'menu_children_tab_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);

        // $data_table = [
        //     'menu_children_id' => 6,
        //     'menu_tab_name' => 'Tab',
        //     'created_at' => $this->dateTime(),
        //     'updated_at' => $this->dateTime(),
        //     'is_active' => 1
        // ];

        // $throw_id = false;
        // $table_name = 'menu_children_tab_table';

        // $this->helperModel::insertData($data_table, $throw_id, $table_name);

        if ($data['dataMenu']) {
            return $this->checkIdle(view('cms/users/body', $data));
        }
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Halaman tidak ditemukan");
    }
}
