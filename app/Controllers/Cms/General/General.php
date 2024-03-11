<?php

namespace App\Controllers\Cms\General;

use App\Controllers\BaseController;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\Cms\Users\UsersModel;
use App\Models\HelperModel;

class General extends BaseController
{

    protected $helperModel;
    protected $menuManagementModel;
    protected $userModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $uri = service('uri');
        $lang_code = $this->request->getVar('lang');
        // dd($this->helperModel::generateUuid());
        $data = [
            'layout' => $this->dirLayoutCms,
            'section' => $this->dirSectionCms,
            'idleTime' => $this->timeIdle,
            'sidebar' => $this->menuManagementModel::sidebar(),
            'dataMenu' => $this->menuManagementModel::menuAksesBySlug($uri->getSegment(1), $lang_code),
            'breadcrumbs' => $this->menuManagementModel::breadCrumbsBySlug($lang_code),
            'language_row' => $this->menuManagementModel::languageByLangCode($lang_code),
            'language_list' => $this->menuManagementModel::languageList()
        ];

        $path = '';
        $title = null;
        if ($data['dataMenu']) {
            if (count($data['dataMenu']['sidebar']) == 0) {
                $menu_url = $data['dataMenu']['menu']['menu_url'];
                $path = $menu_url . '/' . 'body';
                $title = $data['dataMenu']['menu']['menu_name'];
            } else {
                // dd($data);
                $menu_url = $data['dataMenu']['sidebar'][0]['menu_children_url'];
                $path = $menu_url;
                $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $data['dataMenu']['sidebar'][0]['menu_children_name'];
            }


            if ($menu_url == $uri->getPath()) {
                $data['title'] = $title;

                $this->_logUser('Access ' . $title, 'Access ' . $title . ' page successfully');

                return $this->checkIdle(view('cms' . $path, $data));
            } else {
                $this->_logUser('Access not found', 'Page ' . $uri->getPath() . ' is not found');

                throw new \CodeIgniter\Exceptions\PageNotFoundException("Not Found");
            }
        }
        $this->_logUser('Access menu', 'User try to access ' . $uri->getPath() . ' , but is not found, user redirected to home');

        return redirect()->to('/login');
    }

    private function _logUser($activity, $description = '')
    {
        $dataUser = null;
        if (session()->get('email')) {
            $dataUser = $this->userModel::dataUsersByEmail(session()->get('email'));
        }

        if ($dataUser) {
            $data_insert = [
                'user_id' => $dataUser['user_id'],
                'role_id' => $dataUser['role_id'],
                'activity' => $activity,
                'description' => $description,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];

            $throw_id = false;
            $table_name = 'log_table';

            $this->helperModel::insertData($data_insert, $throw_id, $table_name);
        }
    }

    // DELETE MENU
    public function delMenu($segment, $table_name, $uuid)
    {
        $id = $uuid;
        $is_active = null;
        $message = '';
        if ($segment == 'deactivate') {
            $is_active = 0;
            $message = "deactivated";
        } else if ($segment == 'activate') {
            $is_active = 1;
            $message = "activated";
        } else {
            $is_active = 0;
            $message = "deleted";
        }

        $data_update = [
            'is_active' => $is_active,
            'updated_at' => $this->dateTime(),
        ];

        $columns_id = 'uuid';
        $this->helperModel::deleteData($columns_id, $id, $data_update, $table_name . '_table', false);

        $session = $this->sessionMessage('success', "data has been " . $message);
        $token = csrf_hash();

        $result['notification'] = $session;
        $result['token'] = $token;

        return $this->response->setJSON($result);

        // session()->setFlashdata("notif", $this->sessionMessage('success', "data has been " . $message));
        // return redirect()->back();
    }
}
