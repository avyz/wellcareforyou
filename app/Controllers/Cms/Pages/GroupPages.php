<?php

namespace App\Controllers\Cms\Pages;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Pages\GroupPagesModel;
use App\Models\Cms\Pages\PagesModel;

class GroupPages extends BaseController
{
    protected $helperModel;
    protected $generalController;
    protected $groupPagesModel;
    protected $pagesModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->generalController = new General();
        $this->pagesModel = new PagesModel();
        $this->groupPagesModel = new GroupPagesModel();
    }
    // Group Pages
    public function dataGroupPages()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $lang_code = $this->request->getVar('lang_code');

        $fullData = true;
        $data = $this->groupPagesModel::dataGroupPages($filter, $column, $orderDir, $fullData, $lang_code);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $dataSlice,
            'start' => $start

        ];
        return $this->response->setJSON($response);
    }

    public function createGroupPages()
    {
        $navbar_management_group_name = $this->request->getVar('navbar_management_group_name');
        $lang_code = $this->request->getVar('lang_code');
        $is_navbar = $this->request->getVar('is_navbar');

        $rules = [
            'navbar_management_group_name' => [
                'label' => 'Group Name',
                'rules' => 'trim|required|is_unique[page_navbar_group_table.navbar_management_group_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Group Name is required',
                    'is_unique' => 'Group Name already exist',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        $cek_is_navbar = $this->groupPagesModel->cekIsNavbar($lang_code);
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $navbar_management_group_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Group Pages', 'Fail to insert data because field invalid');
        } else if ($is_navbar == 1 && $cek_is_navbar) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $navbar_management_group_name . " please check your input again");
            $validation = ['is_navbar' => 'Cannot force to be navbar because you already set navbar in this language'];
            $this->generalController->logUser('Create Pages', 'Fail to insert data because Cannot force to be navbar because you already set navbar in this language');
        } else {

            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'lang_code' => $lang_code,
                'navbar_management_group_name' => ucwords($navbar_management_group_name),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1,
                'is_navbar' => $is_navbar
            ];
            $this->helperModel::insertData($data, false, 'page_navbar_group_table');
            $session = $this->sessionMessage('success', 'Group Pages ' . $navbar_management_group_name . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Group Pages', 'Group Pages ' . $navbar_management_group_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editGroupPages()
    {
        $navbar_management_group_id = $this->request->getVar('navbar_management_group_id');
        $edit_navbar_management_group_name = $this->request->getVar('edit_navbar_management_group_name');
        $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');
        $edit_is_navbar = $this->request->getVar('edit_is_navbar');
        $data = $this->groupPagesModel::dataGroupPagesByPagesUuid($navbar_management_group_id);

        if ($type != 'view') {
            $requestData = $this->request->getJSON();
            $navbar_management_group_id = $requestData->navbar_management_group_id;
            $type = $requestData->type;
            $edit_navbar_management_group_name = $requestData->edit_navbar_management_group_name;
            $lang_code = $requestData->lang_code;

            $token = csrf_hash();
            $value = "";
            if ($data['navbar_management_group_name'] == $edit_navbar_management_group_name) {
                $value = 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[page_navbar_group_table.navbar_management_group_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_navbar_management_group_name' => [
                    'label' => 'Group Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Group Name is required',
                        'is_unique' => 'Group Name already exist',
                        'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];
            $session = null;
            $validation = null;
            $cek_is_navbar = $this->groupPagesModel->cekIsNavbar($lang_code);
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_navbar_management_group_name . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Group Pages', 'Fail to update because field invalid');
            } else {

                if ($data['is_navbar'] == 0 && $cek_is_navbar && $edit_is_navbar == 1) {
                    $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $edit_navbar_management_group_name . " please check your input again");
                    $validation = ['edit_is_navbar' => 'Cannot force to be navbar because you already set navbar in this language'];
                    $this->generalController->logUser('Create Pages', 'Fail to insert data because Cannot force to be navbar because you already set navbar in this language');
                } else {
                    $data_update = [
                        'lang_code' => $lang_code,
                        'navbar_management_group_name' => $edit_navbar_management_group_name,
                        'updated_at' => $this->dateTime(),
                        'is_navbar' => $edit_is_navbar ? 1 : 0
                    ];

                    $where = [
                        'uuid' => $navbar_management_group_id,
                    ];
                    $this->helperModel::updateData($where, $data_update, 'page_navbar_group_table');
                    $session = $this->sessionMessage('success', 'Group Pages ' . $data['navbar_management_group_name'] . ' has been updated');
                    $validation = null;
                    $this->generalController->logUser('Edit Group Pages', 'Group Pages ' . $data['navbar_management_group_name'] . ' has been updated');
                }
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
    }


    // view Group Pages
    public function viewGroupPagesList()
    {
        $title = 'Group Pages';
        $page = $this->request->getVar('page');
        $navbar_management_group_uuid = $this->request->getVar('navbar_management_group_uuid');
        $lang_code = $this->request->getVar('lang_code');
        $lang_view = $this->request->getVar('lang_view');
        $fullData = false;
        $arr_group_list = [];
        $data = $this->pagesModel::dataPages('', 'navbar_management_id', 'asc', $fullData, $lang_view);
        foreach ($data as $index => $value) {
            $navbar_management_group_child = $this->groupPagesModel::dataGroupChildPagesByManagementGroupUuid($navbar_management_group_uuid, $value['uuid']);
            if ($navbar_management_group_child) {
                $arr_group_list = [
                    'navbar_management_group_uuid' => $navbar_management_group_child['navbar_management_group_uuid'],
                    'is_active_group_child' => $navbar_management_group_child['is_active_group_child']
                ];
            } else {
                $arr_group_list = [
                    'is_active_group_child' => 0
                ];
            }

            $data[$index] = array_merge($value, $arr_group_list);
        }

        $result['page'] = $page;
        $result['navbar_management_group_uuid'] = $navbar_management_group_uuid;
        $result['lang_code'] = $lang_code;
        $result['lang_view'] = $lang_view;
        $result['group'] = $data;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        return  $this->generalController->links($passData);
    }

    public function createGroupPagesList()
    {
        $navbar_management_group_uuid = $this->request->getVar('navbar_management_group_uuid');
        $page = $this->request->getVar('page');
        $lang_code = $this->request->getVar('lang_code');
        $lang_view = $this->request->getVar('lang_view');
        $is_active = $this->request->getVar('is_active');

        $session = null;
        // $validation = null;
        $data_pages = $this->pagesModel::dataPages('', 'navbar_management_id', 'asc', false, $lang_view);
        if (is_array($data_pages)) {
            foreach ($data_pages as $key => $value_menu) {
                if (is_array($is_active) && in_array($value_menu['uuid'], $is_active)) {
                    $navbar_management_group_child = $this->groupPagesModel::dataGroupChildPagesByManagementGroupUuid($navbar_management_group_uuid, $value_menu['uuid']);
                    if (empty($navbar_management_group_child)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'navbar_management_group_uuid' => $navbar_management_group_uuid,
                            'navbar_management_uuid' => $value_menu['uuid'],
                            '`is_active`' => is_array($is_active) && in_array($value_menu['uuid'], $is_active) ? 1 : 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime(),
                        ];

                        $this->helperModel::insertData($data, false, 'page_navbar_group_child_table');
                    } else {
                        $data_update = [
                            '`is_active`' => is_array($is_active) && in_array($value_menu['uuid'], $is_active) ? 1 : 0,
                            'updated_at' => $this->dateTime(),
                        ];

                        $setUpdate = [
                            'navbar_management_group_uuid' => $navbar_management_group_uuid,
                            'navbar_management_uuid' => $value_menu['uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'page_navbar_group_child_table');
                    }
                } else {
                    $navbar_management_group_child = $this->groupPagesModel::dataGroupChildPagesByManagementGroupUuid($navbar_management_group_uuid, $value_menu['uuid']);
                    if (empty($navbar_management_group_child)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'navbar_management_group_uuid' => $navbar_management_group_uuid,
                            'navbar_management_uuid' => $value_menu['uuid'],
                            '`is_active`' => 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $this->helperModel::insertData($data, false, 'page_navbar_group_child_table');
                    } else {
                        $data_update = [
                            '`is_active`' => 0,
                            'updated_at' => $this->dateTime(),
                        ];
                        $setUpdate = [
                            'navbar_management_group_uuid' => $navbar_management_group_uuid,
                            'navbar_management_uuid' => $value_menu['uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'page_navbar_group_child_table');
                    }
                }
            }

            $session = $this->sessionMessage('success', 'Group List has been update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update group list', 'Group List has been update');
            return redirect()->to('/pages/group-pages/page-list?navbar_management_group_uuid=' . $navbar_management_group_uuid . '&lang_code=' . $lang_code . '&lang_view=' . $lang_view . '&page=' . $page);
        } else {
            $session = $this->sessionMessage('error', 'Group List failed to update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update group list', 'Group List failed to update because data group list not found');
            return redirect()->to('/pages/group-pages');
        }
    }
}
