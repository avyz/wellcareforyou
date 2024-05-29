<?php

namespace App\Controllers\Cms\UserManagement;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\Cms\UserManagement\UserManagementModel;
use App\Models\HelperModel;
use PDO;

class UserManagement extends BaseController
{

    protected $helperModel;
    protected $menuManagementModel;
    protected $userManagementModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
        $this->userManagementModel = new UserManagementModel();
        $this->generalController = new General();
    }

    // User
    public function dataUser()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->userManagementModel::dataUser($filter, $column, $orderDir, $fullData, '');

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

    // Create User
    public function createUser()
    {
        $nama_depan = $this->request->getVar('nama_depan');
        $nama_belakang = $this->request->getVar('nama_belakang');
        $email = $this->request->getVar('email');
        $role_id = $this->request->getVar('role_id');
        $data_role = $this->userManagementModel::dataRoleByUuid($role_id);

        $rules = [
            'nama_depan' => [
                'label' => 'First Name',
                'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The First Name is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'trim|required|is_unique[auth_table.email]|valid_email',
                'errors' => [
                    'required' => 'The Email is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'role_id' => [
                'label' => 'Role',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Role is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];

        if ($nama_belakang !== '') {
            $rules['nama_belakang'] = [
                'label' => 'Last Name',
                'rules' => 'trim|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Last Name is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }

        $fullname = '';
        if ($nama_belakang == '') {
            $fullname = $nama_depan;
        } else {
            $fullname = $nama_depan . ' ' . $nama_belakang;
        }

        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $fullname . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create User', 'Fail to insert data because field invalid');
        } else {
            $data_auth = [
                'uuid' => $this->helperModel::generateUuid(),
                'email' => $email,
                'password' => password_hash('wellcare1234$#@!', PASSWORD_DEFAULT),
                'role_id' => $data_role['role_id'],
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_verified' => 1,
                'is_active' => 1,
                'is_agree' => 1,
            ];
            $auth_id = $this->helperModel::insertData($data_auth, true, 'auth_table');

            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'auth_id' => $auth_id,
                'nama_lengkap' => $fullname,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];
            $this->helperModel::insertData($data, false, 'user_table');
            $session = $this->sessionMessage('success', 'User ' . $fullname . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create User', 'User ' . $fullname . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    // Edit User
    public function editUser()
    {
        $user_id = $this->request->getVar('user_id');
        $type = $this->request->getVar('type');
        $edit_nama_depan = $this->request->getVar('edit_nama_depan');
        $edit_nama_belakang = $this->request->getVar('edit_nama_belakang');
        $edit_email_user = $this->request->getVar('edit_email_user');
        $edit_role_id_user = $this->request->getVar('edit_role_id_user');
        $data_user = $this->userManagementModel::dataUserByUuid($user_id);
        $data_role = $this->userManagementModel::dataRoleByUuid($edit_role_id_user);

        if ($type != 'view') {
            $requestData = $this->request->getJSON();
            $user_id = $requestData->user_id;
            $edit_nama_depan = $requestData->edit_nama_depan;
            $edit_nama_belakang = $requestData->edit_nama_belakang;
            $edit_email_user = $requestData->edit_email_user;
            $edit_role_id_user = $requestData->edit_role_id_user;
            $data_user = $this->userManagementModel::dataUserByUuid($user_id);
            $data_role = $this->userManagementModel::dataRoleByUuid($edit_role_id_user);

            $token = csrf_hash();
            $value = "";
            if ($data_user['email'] == $edit_email_user) {
                $value = 'trim|required|valid_email';
            } else {
                $value = 'trim|required|is_unique[auth_table.email]|valid_email';
            }

            $rules = [
                'edit_nama_depan' => [
                    'label' => 'First Name',
                    'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                    'errors' => [
                        'required' => 'The First Name is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_email_user' => [
                    'label' => 'Email',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Email is required',
                        'is_unique' => 'Email already exist',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_role_id_user' => [
                    'label' => 'Role',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Role is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];

            if ($edit_nama_belakang !== '') {
                $rules['edit_nama_belakang'] = [
                    'label' => 'Last Name',
                    'rules' => 'trim|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                    'errors' => [
                        'required' => 'The Last Name is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            $session = null;
            $validation = null;
            $fullname = '';
            if ($edit_nama_belakang == '') {
                $fullname = $edit_nama_depan;
            } else {
                $fullname = $edit_nama_depan . ' ' . $edit_nama_belakang;
            }
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $fullname . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit User', 'Fail to update because field invalid');
            } else {
                $data_auth = [
                    'role_id' => $data_role['role_id'],
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $data_user['auth_uuid'],
                ];
                $this->helperModel::updateData($where, $data_auth, 'auth_table');

                $data_user_input = [
                    'nama_lengkap' => $fullname,
                    'nama_depan' => $edit_nama_depan,
                    'nama_belakang' => $edit_nama_belakang,
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $user_id,
                ];
                $this->helperModel::updateData($where, $data_user_input, 'user_table');
                $session = $this->sessionMessage('success', 'User ' . $data_user['nama_lengkap'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit User', 'User ' . $data_user['nama_lengkap'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data_user;

        return $this->response->setJSON($result);
    }

    // Role
    public function dataRole()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->userManagementModel::dataRole($filter, $column, $orderDir, $fullData, '');

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'buttons' => [
                [
                    'name' => 'buttons-csv',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-excel',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => false
                ]
            ],
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $dataSlice,
            'start' => $start

        ];
        return $this->response->setJSON($response);
    }

    // Create Role
    public function createRole()
    {
        $role = $this->request->getVar('role');

        $rules = [
            'role' => [
                'label' => 'Role Name',
                'rules' => 'trim|required|min_length[3]|is_unique[role_table.role]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Role Name is required',
                    'is_unique' => 'Role Name already exist',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];

        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $role . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Role', 'Fail to insert data because field invalid');
        } else {
            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'role' => $role,
                'is_active' => 1,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];
            $this->helperModel::insertData($data, false, 'role_table');

            $session = $this->sessionMessage('success', 'Role ' . $role . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Role', 'Role ' . $role . ' has been created');
        };
        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;



        return $this->response->setJSON($result);
    }

    // Edit Role
    public function editRole()
    {
        $role_id = $this->request->getVar('role_id');
        $type = $this->request->getVar('type');
        $edit_role = $this->request->getVar('edit_role');
        $data_role = $this->userManagementModel::dataRoleByUuid($role_id);

        if ($type != 'view') {
            $requestData = $this->request->getJSON();
            $role_id = $requestData->role_id;
            $edit_role = $requestData->edit_role;
            $data_role = $this->userManagementModel::dataRoleByUuid($role_id);

            $token = csrf_hash();
            $value = "";
            if ($data_role['role'] == $edit_role) {
                $value = 'trim|required|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[role_table.role]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_role' => [
                    'label' => 'Role Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Role Name is required',
                        'is_unique' => 'Role Name already exist',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];

            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_role . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Role', 'Fail to update because field invalid');
            } else {
                $data_role_input = [
                    'role' => $edit_role,
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $role_id,
                ];
                $this->helperModel::updateData($where, $data_role_input, 'role_table');
                $session = $this->sessionMessage('success', 'Role ' . $data_role['role'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit Role', 'Role ' . $data_role['role'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data_role;

        return $this->response->setJSON($result);
    }

    // view Menu Management Role
    public function viewMenuManagementRole()
    {
        $title = 'Menu';
        $role_uuid = $this->request->getVar('role_uuid');
        $role = $this->request->getVar('role');
        $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');
        $fullData = false;
        $arr_menu_management = [];
        $new_lang_code = $this->request->getVar('new_lang_code');

        if ($type == 'edit') {
            $language = $new_lang_code;
        } else {
            $language = $lang_code;
        }

        $data = $this->menuManagementModel::dataMenu('', 'menu_id', 'asc', $fullData, $language);
        foreach ($data as $index => $value) {
            $menu_management = $this->userManagementModel::dataMenuManagementRoleByUuid($language, $role_uuid, $value['uuid']);
            $have_children = !empty($this->menuManagementModel::dataResultSubmenuByMenuUuid('', 'menu_children_id', 'asc', $fullData, $value['uuid']));
            if ($menu_management) {
                $arr_menu_management = [
                    'menu_management_uuid' => $menu_management['menu_management_uuid'],
                    'view' => $menu_management['view'],
                    'create' => $menu_management['create'],
                    'edit' => $menu_management['edit'],
                    'delete' => $menu_management['delete'],
                    'buttons-csv' => $menu_management['buttons_csv'],
                    'buttons-excel' => $menu_management['buttons_excel'],
                    'buttons-print' => $menu_management['buttons_print'],
                    'have_children' => $have_children
                ];
            } else {
                $arr_menu_management = [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                    'buttons-csv' => 0,
                    'buttons-excel' => 0,
                    'buttons-print' => 0,
                    'have_children' => $have_children
                ];
            }

            $data[$index] = array_merge($value, $arr_menu_management);
        }

        $result['role_uuid'] = $role_uuid;
        $result['role'] = $role;
        $result['lang_code'] = $lang_code;
        $result['new_lang_code'] = $new_lang_code;
        $result['type'] = $type;
        $result['menus'] = $data;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        if (!$type) {
            return  $this->generalController->links($passData);
        } else {
            // return $this->response->setJSON($passData);
            return $this->checkIdle(view('cms/user-management/management/roles/menu_data', $passData));
        }
    }

    // Create Menu Management Role
    public function createMenuManagementRole()
    {
        $role_uuid = $this->request->getVar('role_uuid');
        $role = $this->request->getVar('role');
        $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');
        $view = $this->request->getVar('view');
        $create = $this->request->getVar('create');
        $edit = $this->request->getVar('edit');
        $delete = $this->request->getVar('delete');
        $buttons_csv = $this->request->getVar('buttons_csv');
        $buttons_excel = $this->request->getVar('buttons_excel');
        $buttons_print = $this->request->getVar('buttons_print');

        $session = null;
        // $validation = null;
        $data_menu = $this->menuManagementModel::dataMenu('', 'menu_id', 'asc', false, $lang_code);
        if (is_array($data_menu)) {
            foreach ($data_menu as $key => $value_menu) {
                if (is_array($view) && in_array($value_menu['uuid'], $view)) {
                    $dataMenuManagementRole = $this->userManagementModel::dataMenuManagementRoleByUuid($lang_code, $role_uuid, $value_menu['uuid']);
                    if (empty($dataMenuManagementRole)) {
                        $data_menus = $this->menuManagementModel::dataMenuByMenuId($value_menu['uuid']);
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'role_uuid' => $role_uuid,
                            'menu_uuid' => $value_menu['uuid'],
                            '`view`' => is_array($view) && in_array($value_menu['uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['uuid'], $buttons_print) ? 1 : 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime(),
                            'lang_code' => $data_menus['lang_code']
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_table');
                    } else {
                        $data_update = [
                            '`view`' => is_array($view) && in_array($value_menu['uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['uuid'], $buttons_print) ? 1 : 0,
                            'updated_at' => $this->dateTime(),
                        ];

                        $setUpdate = [
                            'role_uuid' => $role_uuid,
                            'menu_uuid' => $value_menu['uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_table');
                    }
                } else {
                    $dataMenuManagementRole = $this->userManagementModel::dataMenuManagementRoleByUuid($lang_code, $role_uuid, $value_menu['uuid']);
                    if (empty($dataMenuManagementRole)) {
                        $data_menus = $this->menuManagementModel::dataMenuByMenuId($value_menu['uuid']);
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'role_uuid' => $role_uuid,
                            'menu_uuid' => $value_menu['uuid'],
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime(),
                            'lang_code' => $data_menus['lang_code']
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_table');
                    } else {
                        $data_update = [
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'updated_at' => $this->dateTime(),
                        ];
                        $setUpdate = [
                            'role_uuid' => $role_uuid,
                            'menu_uuid' => $value_menu['uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_table');
                    }
                }
            }

            $session = $this->sessionMessage('success', 'Menu management has been update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update menu', 'Menu management has been update');
            if (!$type) {
                return redirect()->to('/user-management/management/roles/menu?role=' . $role . '&role_uuid=' . $role_uuid . '&lang_code=' . $lang_code);
            } else {
                return redirect()->back();
            }
        } else {
            $session = $this->sessionMessage('error', 'Menu management failed to update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update menu', 'Menu management failed to update because data menu not found');
            return redirect()->to('/user-management/management');
        }
    }

    // view Menu Management Role Child
    public function viewMenuManagementRoleChild()
    {
        $title = 'Submenu';
        $role = $this->request->getVar('role');
        $role_uuid = $this->request->getVar('role_uuid');
        $type = $this->request->getVar('type');
        $lang_code = $this->request->getVar('lang_code');
        $menu_uuid = $this->request->getVar('menu_uuid');
        $menu_name = $this->request->getVar('menu_name');
        $menu_management_uuid = $this->request->getVar('menu_management_uuid');
        $fullData = false;
        $arr_menu_management = [];
        $new_lang_code = $this->request->getVar('new_lang_code');

        $data = $this->menuManagementModel::dataResultSubmenuByMenuUuid('', 'menu_children_id', 'asc', $fullData, $menu_uuid);
        foreach ($data as $index => $value) {
            $menu_management = $this->userManagementModel::dataMenuManagementRoleChildByMenuManagementUuid($value['menu_children_uuid'], $menu_management_uuid);
            $have_children = $this->menuManagementModel::dataResultTabMenuByMenuChildrenUuid('', 'menu_tab_id', 'asc', $fullData, $value['menu_children_uuid']);
            if ($menu_management) {
                $arr_menu_management = [
                    'menu_management_children_uuid' => $menu_management['menu_management_children_uuid'],
                    'menu_management_uuid' => $menu_management_uuid,
                    'view' => $menu_management['view'],
                    'create' => $menu_management['create'],
                    'edit' => $menu_management['edit'],
                    'delete' => $menu_management['delete'],
                    'buttons-csv' => $menu_management['buttons_csv'],
                    'buttons-excel' => $menu_management['buttons_excel'],
                    'buttons-print' => $menu_management['buttons_print'],
                    'have_children' => $have_children
                ];
            } else {
                $arr_menu_management = [
                    'menu_management_uuid' => $menu_management_uuid,
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                    'buttons-csv' => 0,
                    'buttons-excel' => 0,
                    'buttons-print' => 0,
                    'have_children' => $have_children
                ];
            }

            $data[$index] = array_merge($value, $arr_menu_management);
        }

        $result['role'] = $role;
        $result['role_uuid'] = $role_uuid;
        $result['lang_code'] = $lang_code;
        $result['new_lang_code'] = $new_lang_code;
        $result['type'] = $type;
        $result['menu_uuid'] = $menu_uuid;
        $result['menu_name'] = $menu_name;
        $result['menu_management_uuid'] = $menu_management_uuid;
        $result['menus'] = $data;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        if (!$type) {
            return  $this->generalController->links($passData);
        } else {
            // return $this->response->setJSON($passData);
            return $this->checkIdle(view('cms/user-management/management/roles/submenu_data', $passData));
        }
    }

    // Create Menu Management Role Child
    public function createMenuManagementRoleChild()
    {
        $role = $this->request->getVar('role');
        $role_uuid = $this->request->getVar('role_uuid');
        $lang_code = $this->request->getVar('lang_code');
        $menu_uuid = $this->request->getVar('menu_uuid');
        $type = $this->request->getVar('type');
        $menu_name = $this->request->getVar('menu_name');
        $menu_management_uuid = $this->request->getVar('menu_management_uuid');
        $view = $this->request->getVar('view');
        $create = $this->request->getVar('create');
        $edit = $this->request->getVar('edit');
        $delete = $this->request->getVar('delete');
        $buttons_csv = $this->request->getVar('buttons_csv');
        $buttons_excel = $this->request->getVar('buttons_excel');
        $buttons_print = $this->request->getVar('buttons_print');

        $session = null;
        $fullData = false;
        $data = $this->menuManagementModel::dataResultSubmenuByMenuUuid('', 'menu_children_id', 'asc', $fullData, $menu_uuid);
        $menu_management = $this->userManagementModel::dataMenuManagementRoleByUuid($lang_code, $role_uuid, $menu_uuid);
        if (is_array($data) && $menu_management['view'] == 1) {
            foreach ($data as $key => $value_menu) {
                if (is_array($view) && in_array($value_menu['menu_children_uuid'], $view)) {
                    $dataMenuManagementRoleChild = $this->userManagementModel::dataMenuManagementRoleChildByMenuManagementUuid($value_menu['menu_children_uuid'], $menu_management_uuid);
                    if (empty($dataMenuManagementRoleChild)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'menu_uuid' => $menu_uuid,
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $value_menu['menu_children_uuid'],
                            '`view`' => is_array($view) && in_array($value_menu['menu_children_uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['menu_children_uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['menu_children_uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['menu_children_uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['menu_children_uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['menu_children_uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['menu_children_uuid'], $buttons_print) ? 1 : 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_children_table');
                    } else {
                        $data_update = [
                            '`view`' => is_array($view) && in_array($value_menu['menu_children_uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['menu_children_uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['menu_children_uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['menu_children_uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['menu_children_uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['menu_children_uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['menu_children_uuid'], $buttons_print) ? 1 : 0,
                            'updated_at' => $this->dateTime(),
                        ];
                        $setUpdate = [
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $value_menu['menu_children_uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_children_table');
                    }
                } else {
                    $dataMenuManagementRoleChild = $this->userManagementModel::dataMenuManagementRoleChildByMenuManagementUuid($value_menu['menu_children_uuid'], $menu_management_uuid);
                    if (empty($dataMenuManagementRoleChild)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'menu_uuid' => $menu_uuid,
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $value_menu['menu_children_uuid'],
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_children_table');
                    } else {
                        $data_update = [
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'updated_at' => $this->dateTime(),
                        ];
                        $setUpdate = [
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $value_menu['menu_children_uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_children_table');
                    }
                }
            }

            $session = $this->sessionMessage('success', 'Submenu management has been update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update submenu', 'Submenu management has been update');
            // return redirect()->to('/user-management/management/roles/submenu?role_uuid=' . $role_uuid . '&menu_uuid=' . $menu_uuid . '&menu_management_uuid=' . $menu_management_uuid . '&lang_code=' . $lang_code . '&role=' . $role . '&menu_name=' . $menu_name);
            if (!$type) {
                return redirect()->to('/user-management/management/roles/submenu?role_uuid=' . $role_uuid . '&menu_uuid=' . $menu_uuid . '&menu_management_uuid=' . $menu_management_uuid . '&lang_code=' . $lang_code . '&role=' . $role . '&menu_name=' . $menu_name);
            } else {
                return redirect()->back();
            }
        } else {
            $session = $this->sessionMessage('error', 'Submenu management fail to update, something went wrong');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update submenu', 'Submenu management fail to update because data submenu not found');
            return redirect()->to('/user-management/management');
        }
    }

    // Data Menu Management Role Child
    // public function menuManagementRoleChild()
    // {
    //     // Menu UUID
    //     $menu_uuid = $this->request->getVar('menu_uuid');
    //     $menu_management_uuid = $this->request->getVar('menu_management_uuid');
    //     $draw = $this->request->getVar('draw');
    //     $length = $this->request->getVar('length');
    //     $start = $this->request->getVar('start');
    //     $filter = $this->request->getVar('search')['value'];
    //     $orderColumn = $this->request->getVar('order')[0]['column'];
    //     $column = $this->request->getVar('columns')[$orderColumn]['data'];
    //     $orderDir = $this->request->getVar('order')[0]['dir'];

    //     $fullData = false;
    //     $arr_menu_management = [];
    //     $data = $this->menuManagementModel::dataResultSubmenuByMenuUuid($filter, $column, $orderDir, $fullData, $menu_uuid);
    //     foreach ($data as $index => $value) {
    //         $menu_management = $this->userManagementModel::dataMenuManagementRoleChildByMenuUuid($value['menu_uuid']);
    //         if ($menu_management) {
    //             $arr_menu_management = [
    //                 'menu_management_children_uuid' => $menu_management['menu_management_children_uuid'],
    //                 'menu_children_uuid' => $menu_management['menu_children_uuid'],
    //                 'menu_management_uuid' => $menu_management_uuid,
    //                 'view' => $menu_management['view'],
    //                 'create' => $menu_management['create'],
    //                 'edit' => $menu_management['edit'],
    //                 'delete' => $menu_management['delete'],
    //                 'buttons-csv' => $menu_management['buttons_csv'],
    //                 'buttons-excel' => $menu_management['buttons_excel'],
    //                 'buttons-print' => $menu_management['buttons_print'],
    //             ];
    //         } else {
    //             $arr_menu_management = [
    //                 'menu_management_uuid' => $menu_management_uuid,
    //                 'view' => 0,
    //                 'create' => 0,
    //                 'edit' => 0,
    //                 'delete' => 0,
    //                 'buttons-csv' => 0,
    //                 'buttons-excel' => 0,
    //                 'buttons-print' => 0,
    //             ];
    //         }

    //         $data[$index] = array_merge($value, $arr_menu_management);
    //     }

    //     // Hitung jumlah total data
    //     $totalData = count($data);

    //     // Ambil data untuk halaman saat ini
    //     $dataSlice = array_slice($data, $start, $length);

    //     // dd($dataSlice);
    //     $response = [
    //         'buttons' => [],
    //         'draw' => $draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalData,
    //         'data' => $dataSlice,

    //     ];
    //     return $this->response->setJSON($response);
    // }

    // Data Menu Management Role Child Tab
    // public function menuManagementRoleChildTab()
    // {
    //     // Menu Children UUID
    //     $menu_children_uuid = $this->request->getVar('menu_children_uuid');
    //     $draw = $this->request->getVar('draw');
    //     $length = $this->request->getVar('length');
    //     $start = $this->request->getVar('start');
    //     $filter = $this->request->getVar('search')['value'];
    //     $orderColumn = $this->request->getVar('order')[0]['column'];
    //     $column = $this->request->getVar('columns')[$orderColumn]['data'];
    //     $orderDir = $this->request->getVar('order')[0]['dir'];

    //     $fullData = false;
    //     $arr_menu_management = [];
    //     $data = $this->menuManagementModel::dataResultTabMenuByMenuChildrenUuid($filter, $column, $orderDir, $fullData, $menu_children_uuid);
    //     foreach ($data as $index => $value) {
    //         $menu_management = $this->userManagementModel::dataMenuManagementRoleChildTabByMenuChildrenUuid($value['menu_children_uuid']);
    //         if ($menu_management) {
    //             $arr_menu_management = [
    //                 'view' => $menu_management['view'],
    //                 'create' => $menu_management['create'],
    //                 'edit' => $menu_management['edit'],
    //                 'delete' => $menu_management['delete'],
    //                 'buttons-csv' => $menu_management['buttons_csv'],
    //                 'buttons-excel' => $menu_management['buttons_excel'],
    //                 'buttons-print' => $menu_management['buttons_print'],
    //             ];
    //         } else {
    //             $arr_menu_management = [
    //                 'view' => 0,
    //                 'create' => 0,
    //                 'edit' => 0,
    //                 'delete' => 0,
    //                 'buttons-csv' => 0,
    //                 'buttons-excel' => 0,
    //                 'buttons-print' => 0,
    //             ];
    //         }

    //         $data[$index] = array_merge($value, $arr_menu_management);
    //     }

    //     // Hitung jumlah total data
    //     $totalData = count($data);

    //     // Ambil data untuk halaman saat ini
    //     $dataSlice = array_slice($data, $start, $length);

    //     // dd($dataSlice);
    //     $response = [
    //         'buttons' => [],
    //         'draw' => $draw,
    //         'recordsTotal' => $totalData,
    //         'recordsFiltered' => $totalData,
    //         'data' => $dataSlice,

    //     ];
    //     return $this->response->setJSON($response);
    // }

    // view menu management role child tab
    public function viewMenuManagementRoleChildTab()
    {
        $title = 'Tab';
        $menu_children_uuid = $this->request->getVar('menu_children_uuid');
        $menu_management_uuid = $this->request->getVar('menu_management_uuid');
        $submenu_name = $this->request->getVar('submenu_name');
        $menu_management_children_uuid = $this->request->getVar('menu_management_children_uuid');
        $role = $this->request->getVar('role');
        $fullData = false;
        $arr_menu_management = [];
        $data = $this->menuManagementModel::dataResultTabMenuByMenuChildrenUuid('', 'menu_tab_id', 'asc', $fullData, $menu_children_uuid);
        foreach ($data as $index => $value) {
            $menu_management = $this->userManagementModel::dataMenuManagementRoleChildTabByMenuTabUuid($value['menu_tab_uuid'], $menu_management_children_uuid);
            if ($menu_management) {
                $arr_menu_management = [
                    'menu_management_children_tab_uuid' => $menu_management['menu_management_children_tab_uuid'],
                    'menu_management_children_uuid' => $menu_management_children_uuid,
                    'menu_management_uuid' => $menu_management_uuid,
                    'view' => $menu_management['view'],
                    'create' => $menu_management['create'],
                    'edit' => $menu_management['edit'],
                    'delete' => $menu_management['delete'],
                    'buttons-csv' => $menu_management['buttons_csv'],
                    'buttons-excel' => $menu_management['buttons_excel'],
                    'buttons-print' => $menu_management['buttons_print'],
                ];
            } else {
                $arr_menu_management = [
                    'menu_management_children_uuid' => $menu_management_children_uuid,
                    'menu_management_uuid' => $menu_management_uuid,
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                    'buttons-csv' => 0,
                    'buttons-excel' => 0,
                    'buttons-print' => 0,
                ];
            }

            $data[$index] = array_merge($value, $arr_menu_management);
        }

        $result['role'] = $role;
        $result['menu_management_children_uuid'] = $menu_management_children_uuid;
        $result['menu_children_uuid'] = $menu_children_uuid;
        $result['menu_management_uuid'] = $menu_management_uuid;
        $result['submenu_name'] = $submenu_name;
        $result['menus'] = $data;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        return  $this->generalController->links($passData);
    }

    // Create Menu Management Role Child Tab
    public function createMenuManagementRoleChildTab()
    {
        $role = $this->request->getVar('role');
        $menu_management_children_uuid = $this->request->getVar('menu_management_children_uuid');
        $menu_children_uuid = $this->request->getVar('menu_children_uuid');
        $menu_management_uuid = $this->request->getVar('menu_management_uuid');
        $submenu_name = $this->request->getVar('submenu_name');
        $view = $this->request->getVar('view');
        $create = $this->request->getVar('create');
        $edit = $this->request->getVar('edit');
        $delete = $this->request->getVar('delete');
        $buttons_csv = $this->request->getVar('buttons_csv');
        $buttons_excel = $this->request->getVar('buttons_excel');
        $buttons_print = $this->request->getVar('buttons_print');


        $session = null;
        $fullData = false;
        $data = $this->menuManagementModel::dataResultTabMenuByMenuChildrenUuid('', 'menu_tab_id', 'asc', $fullData, $menu_children_uuid);
        $menu_management = $this->userManagementModel::dataMenuManagementRoleChildByMenuManagementUuid($menu_children_uuid, $menu_management_uuid);
        if (is_array($data) && $menu_management['view'] == 1) {
            foreach ($data as $key => $value_menu) {
                if (is_array($view) && in_array($value_menu['menu_tab_uuid'], $view)) {
                    $dataMenuManagementRoleChildTab = $this->userManagementModel::dataMenuManagementRoleChildTabByMenuTabUuid($value_menu['menu_tab_uuid'], $menu_management_children_uuid);
                    if (empty($dataMenuManagementRoleChildTab)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'menu_management_children_uuid' => $menu_management_children_uuid,
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $menu_children_uuid,
                            'menu_tab_uuid' => $value_menu['menu_tab_uuid'],
                            '`view`' => is_array($view) && in_array($value_menu['menu_tab_uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['menu_tab_uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['menu_tab_uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['menu_tab_uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['menu_tab_uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['menu_tab_uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['menu_tab_uuid'], $buttons_print) ? 1 : 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_children_tab_table');
                    } else {
                        $data_update = [
                            '`view`' => is_array($view) && in_array($value_menu['menu_tab_uuid'], $view) ? 1 : 0,
                            '`create`' => is_array($create) && in_array($value_menu['menu_tab_uuid'], $create) ? 1 : 0,
                            '`edit`' => is_array($edit) && in_array($value_menu['menu_tab_uuid'], $edit) ? 1 : 0,
                            '`delete`' => is_array($delete) && in_array($value_menu['menu_tab_uuid'], $delete) ? 1 : 0,
                            '`buttons_csv`' => is_array($buttons_csv) && in_array($value_menu['menu_tab_uuid'], $buttons_csv) ? 1 : 0,
                            '`buttons_excel`' => is_array($buttons_excel) && in_array($value_menu['menu_tab_uuid'], $buttons_excel) ? 1 : 0,
                            '`buttons_print`' => is_array($buttons_print) && in_array($value_menu['menu_tab_uuid'], $buttons_print) ? 1 : 0,
                            'updated_at' => $this->dateTime(),
                        ];
                        $setUpdate = [
                            'menu_management_children_uuid' => $menu_management_children_uuid,
                            'menu_tab_uuid' => $value_menu['menu_tab_uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_children_tab_table');
                    }
                } else {
                    $dataMenuManagementRoleChildTab = $this->userManagementModel::dataMenuManagementRoleChildTabByMenuTabUuid($value_menu['menu_tab_uuid'], $menu_management_children_uuid);
                    if (empty($dataMenuManagementRoleChildTab)) {
                        $data = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'menu_management_children_uuid' => $menu_management_children_uuid,
                            'menu_management_uuid' => $menu_management_uuid,
                            'menu_children_uuid' => $menu_children_uuid,
                            'menu_tab_uuid' => $value_menu['menu_tab_uuid'],
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];

                        $this->helperModel::insertData($data, false, 'menu_management_children_tab_table');
                    } else {
                        $data_update = [
                            '`view`' => 0,
                            '`create`' => 0,
                            '`edit`' => 0,
                            '`delete`' => 0,
                            '`buttons_csv`' => 0,
                            '`buttons_excel`' => 0,
                            '`buttons_print`' => 0,
                            'updated_at' => $this->dateTime(),
                        ];

                        $setUpdate = [
                            'menu_management_children_uuid' => $menu_management_children_uuid,
                            'menu_tab_uuid' => $value_menu['menu_tab_uuid']
                        ];
                        $this->helperModel::updateData($setUpdate, $data_update, 'menu_management_children_tab_table');
                    }
                }
            }

            $session = $this->sessionMessage('success', 'Tabmenu management has been update');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update tabmenu', 'Tabmenu management has been update');
            return redirect()->to('/user-management/management/roles/tabmenu?menu_children_uuid=' . $menu_children_uuid . '&menu_management_uuid=' . $menu_management_uuid . '&menu_management_children_uuid=' . $menu_management_children_uuid . '&role=' . $role . '&submenu_name=' . $submenu_name);
        } else {
            $session = $this->sessionMessage('error', 'Tabmenu management fail to update, something went wrong');
            session()->setFlashdata("notif", $session);
            $this->generalController->logUser('Update tabmenu', 'Tabmenu management fail to update because data tabmenu not found');
            return redirect()->to('/user-management/management');
        }
    }

    // Dropdown Role
    public function dataDropdownRole()
    {
        $method = $this->request->getVar('method');
        $role = null;
        if ($method == 'get_data') {
            $role = $this->userManagementModel::dataRole('', 'role_id', 'asc', '', '');
        }
        $response = [
            'role' => $role
        ];
        return $this->response->setJSON($response);
    }

    // Log User
    public function dataLogUser()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];

        $date_start = $this->request->getVar('date_start');
        $date_end = $this->request->getVar('date_end');

        $start_date = null;
        $end_date = null;
        if ($date_start == null && $date_end == null) {
            $start_date = $this->generalController->dateConversionToSqlDate($this->dateTime(), 00, 00, 00);
            $end_date = $this->generalController->dateConversionToSqlDate($this->dateTime(), 23, 59, 59);
        } else {
            $start_date = $this->generalController->dateConversionToSqlDate($date_start, 00, 00, 00);
            $end_date = $this->generalController->dateConversionToSqlDate($date_end, 23, 59, 59);
        }

        $data = $this->userManagementModel::dataLogUser($filter, $column, '', '', '', $start_date, $end_date);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'buttons' => [
                [
                    'name' => 'buttons-csv',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-excel',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => false
                ]
            ],
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $dataSlice,
            'start' => $start

        ];
        return $this->response->setJSON($response);
    }

    // Log Auth
    public function dataLogAuth()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];

        $date_start = $this->request->getVar('date_start');
        $date_end = $this->request->getVar('date_end');

        $start_date = null;
        $end_date = null;
        if ($date_start == null && $date_end == null) {
            $start_date = $this->generalController->dateConversionToSqlDate($this->dateTime(), 0, 0, 0);
            $end_date = $this->generalController->dateConversionToSqlDate($this->dateTime(), 23, 59, 59);
        } else {
            $start_date = $this->generalController->dateConversionToSqlDate($date_start, 0, 0, 0);
            $end_date = $this->generalController->dateConversionToSqlDate($date_end, 23, 59, 59);
        }

        $data = $this->userManagementModel::dataLogAuth($filter, $column, '', '', '', $start_date, $end_date);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'buttons' => [
                [
                    'name' => 'buttons-csv',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-excel',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => false
                ]
            ],
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $dataSlice,
            'start' => $start

        ];
        return $this->response->setJSON($response);
    }
}
