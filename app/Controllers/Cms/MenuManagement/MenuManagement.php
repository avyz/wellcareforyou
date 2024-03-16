<?php

namespace App\Controllers\Cms\MenuManagement;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\HelperModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class MenuManagement extends BaseController
{

    protected $helperModel;
    protected $menuManagementModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
        $this->generalController = new General();
    }

    // MENU
    public function dataMenu()
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
        $data = $this->menuManagementModel::dataMenu($filter, $column, $orderDir, $fullData, $lang_code);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'buttons' => [
                [
                    'name' => 'buttons-csv',
                    'isShow' => true
                ],
                [
                    'name' => 'buttons-excel',
                    'isShow' => true
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => true
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

    // CREATE MENU
    public function createMenu()
    {
        $menu_name = $this->request->getVar('menu_name');
        $menu_icon = $this->request->getVar('menu_icon');
        $lang_code = $this->request->getVar('lang_code');

        $rules = [
            'menu_name' => [
                'label' => 'Menu Name',
                'rules' => 'trim|required|is_unique[menu_table.menu_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Menu Name is required',
                    'is_unique' => 'Menu Name already exist',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'menu_icon' => [
                'label' => 'Menu Icon',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The Menu Icon is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Menu', 'Fail to insert data because field invalid');
            // session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_name . " please check your input again"));
            // return redirect()->back()->withInput();
        } else {
            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'menu_slug' => url_title($menu_name, '-', true),
                'menu_name' => ucwords($menu_name),
                'menu_icon' => $menu_icon,
                'menu_url' => '/' . url_title($menu_name, '-', true),
                'lang_code' => $lang_code,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data, false, 'menu_table');
            $session = $this->sessionMessage('success', 'Menu ' . $menu_name . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Menu', 'Menu ' . $menu_name . ' has been created');
            // session()->setFlashdata("notif", $this->sessionMessage('success', "Menu " . $menu_name . " has been created"));
            // return redirect()->back();
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    // EDIT MENU
    public function editMenu()
    {
        $menu_id = $this->request->getVar('menu_id');
        $type = $this->request->getVar('type');
        $edit_menu_name = $this->request->getVar('edit_menu_name');
        $edit_menu_icon = $this->request->getVar('edit_menu_icon');
        $lang_code = $this->request->getVar('lang_code');
        $data = $this->menuManagementModel::dataMenuByMenuId($menu_id);
        if ($type != 'view') {
            $requestData = $this->request->getJSON();
            $menu_id = $requestData->menu_id;
            $type = $requestData->type;
            $edit_menu_name = $requestData->edit_menu_name;
            $edit_menu_icon = $requestData->edit_menu_icon;
            $lang_code = $requestData->lang_code;

            $token = csrf_hash();
            $value = "";
            if ($data['menu_name'] == $edit_menu_name) {
                $value = 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[menu_table.menu_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_menu_name' => [
                    'label' => 'Menu Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Menu Name is required',
                        'is_unique' => 'Menu Name already exist',
                        'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_menu_icon' => [
                    'label' => 'Menu Icon',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The Menu Icon is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];
            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_menu_name . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Menu', 'Fail to update because field invalid');
            } else {
                $data_update = [
                    'menu_slug' => url_title($edit_menu_name, '-', true),
                    'menu_name' => ucwords($edit_menu_name),
                    'menu_icon' => $edit_menu_icon,
                    'menu_url' => '/' . url_title($edit_menu_name, '-', true),
                    'lang_code' => $lang_code,
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $menu_id,
                ];
                $this->helperModel::updateData($where, $data_update, 'menu_table');
                $session = $this->sessionMessage('success', 'Menu ' . $data['menu_name'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit Menu', 'Menu ' . $data['menu_name'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
    }

    // SUBMENU
    public function dataSubmenu()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start') == 0 ? $this->request->getVar('start') : $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $lang_code = $this->request->getVar('lang_code');

        $fullData = true;
        $data = $this->menuManagementModel::dataSubmenu($filter, $column, $orderDir, $fullData, $lang_code);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        // echo $start;
        $dataSlice = array_slice($data, $start, $length);

        // dd($dataSlice);
        $response = [
            'buttons' => [
                [
                    'name' => 'buttons-csv',
                    'isShow' => true
                ],
                [
                    'name' => 'buttons-excel',
                    'isShow' => false
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => true
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

    // CREATE SUBMENU
    public function createSubmenu()
    {
        $menu_id = $this->request->getVar('menu_id');
        $menu_children_name = $this->request->getVar('menu_children_name');

        $rules = [
            'menu_children_name' => [
                'label' => 'Submenu Name',
                'rules' => 'trim|required|is_unique[menu_children_table.menu_children_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Submenu Name is required',
                    'is_unique' => 'Submenu Name already exist',
                    'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'menu_id' => [
                'label' => 'Menu Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Menu Name is required',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_children_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create submenu', 'Submenu fail to insert because field invalid');
        } else {
            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'menu_id' => $menu_id,
                'menu_children_name' => ucwords($menu_children_name),
                'menu_children_icon' => '<i class="ri-bubble-chart-line"></i>',
                'menu_children_url' => '/' . url_title($menu_children_name, '-', true),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data, false, 'menu_children_table');
            $session = $this->sessionMessage('success', "Submenu " . $menu_children_name . " has been created");
            $validation = null;
            $this->generalController->logUser('Create submenu', 'Submenu ' . $menu_children_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    // EDIT SUBMENU
    public function editSubmenu()
    {
        $submenu_id = $this->request->getVar('submenu_id');
        $edit_menu_id = $this->request->getVar('edit_menu_id');
        $type = $this->request->getVar('type');
        $edit_menu_children_name = $this->request->getVar('edit_menu_children_name');
        $data = $this->menuManagementModel::dataSubmenuByMenuChildrenId($submenu_id);

        if ($type != 'view') {

            $requestData = $this->request->getJSON();
            $submenu_id = $requestData->submenu_id;
            $edit_menu_id = $requestData->edit_menu_id;
            $type = $requestData->type;
            $edit_menu_children_name = $requestData->edit_menu_children_name;

            $token = csrf_hash();

            $value = "";
            if ($data['menu_children_name'] == $edit_menu_children_name) {
                $value = 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[menu_children_table.menu_children_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_menu_children_name' => [
                    'label' => 'Submenu Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Submenu Name is required',
                        'is_unique' => 'Submenu Name already exist',
                        'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_menu_id' => [
                    'label' => 'Menu Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Menu Name is required'
                    ]
                ],
            ];
            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $data['menu_children_name'] . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit submenu', 'Submenu fail to update because field invalid');
            } else {
                $data_update = [
                    'menu_id' => $edit_menu_id,
                    'menu_children_name' => ucwords($edit_menu_children_name),
                    'menu_children_url' => '/' . url_title($edit_menu_children_name, '-', true),
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $submenu_id,
                ];
                $this->helperModel::updateData($where, $data_update, 'menu_children_table');

                $session = $this->sessionMessage('success', "Submenu " . $data['menu_children_name'] . " has been updated");
                $validation = null;
                $this->generalController->logUser('Edit submenu', 'Submenu ' . $data['menu_children_name'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;
        return $this->response->setJSON($result);
    }

    // TAB
    public function dataTabMenu()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start') == 0 ? $this->request->getVar('start') : $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $lang_code = $this->request->getVar('lang_code');

        $fullData = true;
        $data = $this->menuManagementModel::dataTabMenu($filter, $column, $orderDir, $fullData, $lang_code);

        // Hitung jumlah total data
        $totalData = count($data);

        // Ambil data untuk halaman saat ini
        // echo $start;
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
                    'isShow' => true
                ],
                [
                    'name' => 'buttons-print',
                    'isShow' => false
                ]
            ],
            'draw' => $draw,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $dataSlice

        ];
        return $this->response->setJSON($response);
    }

    // CREATE TAB MENU
    public function createTabMenu()
    {
        $menu_children_id = $this->request->getVar('menu_children_id');
        $menu_tab_name = $this->request->getVar('menu_tab_name');

        $rules = [
            'menu_tab_name' => [
                'label' => 'Tab Menu Name',
                'rules' => 'trim|required|is_unique[menu_children_tab_table.menu_tab_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Tab Menu Name is required',
                    'is_unique' => 'Tab Menu Name already exist',
                    'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'menu_children_id' => [
                'label' => 'Submenu Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The Submenu Name is required',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_tab_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Tab Menu', 'Fail to insert tab menu because field invalid');
        } else {
            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'menu_children_id' => $menu_children_id,
                'menu_tab_name' => ucwords($menu_tab_name),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data, false, 'menu_children_tab_table');

            $session = $this->sessionMessage('success', "Tab Menu " . $menu_tab_name . " has been created");
            $validation = null;
            $this->generalController->logUser('Create Tab Menu', 'Tab Menu ' . $menu_tab_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    // EDIT TAB MENU
    public function editTabMenu()
    {
        $tab_menu_id = $this->request->getVar('tab_menu_id');
        $edit_menu_children_id = $this->request->getVar('edit_menu_children_id');
        $type = $this->request->getVar('type');
        $edit_menu_tab_name = $this->request->getVar('edit_menu_tab_name');
        $data = $this->menuManagementModel::dataTabMenuByMenuTabId($tab_menu_id);

        if ($type != 'view') {

            $requestData = $this->request->getJSON();
            $tab_menu_id = $requestData->tab_menu_id;
            $edit_menu_children_id = $requestData->edit_menu_children_id;
            $type = $requestData->type;
            $edit_menu_tab_name = $requestData->edit_menu_tab_name;

            $token = csrf_hash();

            $value = "";
            if ($data['menu_tab_name'] == $edit_menu_tab_name) {
                $value = 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[menu_children_tab_table.menu_tab_name]|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_menu_tab_name' => [
                    'label' => 'Tab Menu Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Tab Menu Name is required',
                        'is_unique' => 'Tab Menu Name already exist',
                        'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_menu_children_id' => [
                    'label' => 'Submenu Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The Submenu Name is required'
                    ]
                ],
            ];
            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $data['menu_tab_name'] . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Tab Menu', 'Fail to update tab menu because field invalid');
            } else {
                $data_update = [
                    'menu_children_id' => $edit_menu_children_id,
                    'menu_tab_name' => ucwords($edit_menu_tab_name),
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $tab_menu_id,
                ];
                $this->helperModel::updateData($where, $data_update, 'menu_children_tab_table');

                $session = $this->sessionMessage('success', "Tab Menu " . $data['menu_tab_name'] . " has been updated");
                $validation = null;
                $this->generalController->logUser('Edit Tab Menu', 'Tab Menu ' . $data['menu_tab_name'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;
        return $this->response->setJSON($result);
    }

    public function dtActionButtons()
    {
        $columnName = $this->request->getVar('columnName');
        $modelName = $this->request->getVar('modelName');
        $buttons = $this->request->getVar('buttons');
        $draw = $this->request->getVar('draw');
        $header = $this->request->getVar('header');
        $lang_code = $this->request->getVar('lang_code');
        if (is_string($header)) {
            $arr_header = explode(",", $header);
        } else {
            $arr_header = $header;
        }
        $column = $this->request->getVar('column');
        if (is_string($header)) {
            $arr_column = explode(",", $column);
        } else {
            $arr_column = $column;
        }
        // dd($column);
        $dataSelected = ['header' => $arr_header, 'column' => $arr_column];

        $fullData = false;
        $data = $this->menuManagementModel::$modelName('', $columnName, 'asc', $fullData, $lang_code);

        switch ($buttons) {
            case 'print':

                $totalData = count($data);

                $response = [
                    'draw' => $draw,
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalData,
                    'data' => $data

                ];
                $this->generalController->logUser('Print', 'Print data ' . $modelName);
                return $this->response->setJSON($response);
            case 'excel':
                // Inisialisasi objek Spreadsheet
                $spreadsheet = new Spreadsheet();

                // Set aktivitas kerja ke objek Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();

                // Tambahkan header
                $headerRow = 1; // Baris header
                $col = 1;

                foreach ($dataSelected['header'] as $key => $value) {
                    $coordinate = Coordinate::stringFromColumnIndex($col++) . $headerRow;
                    $sheet->setCellValue($coordinate, $value);
                }

                // Mengatur data
                $dataRow = 2; // Baris data
                foreach ($data as $row) {
                    // if()
                    $col = 1; // Kolom awal
                    foreach ($dataSelected['column'] as $key => $value) {
                        $coordinate = Coordinate::stringFromColumnIndex($col++) . $dataRow;
                        $spreadsheet->getActiveSheet()->setCellValue($coordinate, $row[$value]);
                    }
                    $dataRow++; // Pindah ke baris data berikutnya
                }

                // Konfigurasi nama file
                $filename = time() . '-' . date('m') . date('Y') . '.xlsx';

                // Buat objek Writer untuk format Xlsx
                $writer = new Xlsx($spreadsheet);

                // Membuat response dengan file Excel
                $response = service('response');
                $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
                $response->setHeader('Cache-Control', 'max-age=0');
                $writer->save('php://output');
                $this->generalController->logUser('Export Excel', 'Export data ' . $modelName);
                return $response;
                // break;
            case 'csv':
                // Inisialisasi objek Spreadsheet
                $spreadsheet = new Spreadsheet();

                // Set aktivitas kerja ke objek Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();

                // Tambahkan header
                $headerRow = 1; // Baris header
                $col = 1;
                foreach ($dataSelected['header'] as $key => $value) {
                    $coordinate = Coordinate::stringFromColumnIndex($col++) . $headerRow;
                    $sheet->setCellValue($coordinate, $value);
                }

                // Mengatur data
                $dataRow = 2; // Baris data
                foreach ($data as $row) {
                    // if()
                    $col = 1; // Kolom awal
                    foreach ($dataSelected['column'] as $key => $value) {
                        $coordinate = Coordinate::stringFromColumnIndex($col++) . $dataRow;
                        $spreadsheet->getActiveSheet()->setCellValue($coordinate, $row[$value]);
                    }
                    $dataRow++; // Pindah ke baris data berikutnya
                }

                // Konfigurasi nama file
                $filename = time() . '-' . date('m') . date('Y') . '.csv';

                // Buat objek Writer untuk format Xlsx
                $writer = new Csv($spreadsheet);

                // Membuat response dengan file Excel
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                $this->generalController->logUser('Export CSV', 'Export data ' . $modelName);
                break;
            default:
                // $data = $this->menuManagementModel::$modelName('', $columnName, 'asc', $fullData, $lang_code);

                $totalData = count($data);

                $response = [
                    'draw' => $draw,
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalData,
                    'data' => $data

                ];
                $this->generalController->logUser('Print', 'Print data ' . $modelName);
                return $this->response->setJSON($response);
        }
    }

    // GET MENU
    public function dataDropdownMenu()
    {
        $lang_code = $this->request->getVar('lang_code');
        $menu_id = $this->request->getVar('menu_id');
        $menu_children_id = $this->request->getVar('menu_children_id');
        $menu_tab_id = $this->request->getVar('menu_tab_id');
        $type = $this->request->getVar('type');

        if ($type == 'add') {
            $menu = $this->menuManagementModel::dataMenu('', 'menu_id', 'asc', false, $lang_code);
            $submenu = $this->menuManagementModel::dataSubmenu('', 'menu_children_id', 'asc', false, $lang_code);
            $tabmenu = $this->menuManagementModel::dataTabMenu('', 'menu_tab_id', 'asc', false, $lang_code);
        } else {
            $menu = $this->menuManagementModel::dataMenuResultByMenuId($menu_id, $lang_code);
            $submenu = $this->menuManagementModel::dataResultSubmenuByMenuChildrenId($menu_children_id);
            $tabmenu = $this->menuManagementModel::dataResultTabMenuByMenuTabId($menu_tab_id);
        }

        $menu_arr = null;
        $submenu_arr = null;
        $tabmenu_arr = null;
        if ($menu_id) {
            $submenu_arr = $this->menuManagementModel::dataSubmenuByMenuId($menu_id);
        } elseif ($menu_children_id) {
            $submenu_row = $this->menuManagementModel::dataSubmenuByMenuChildrenId($menu_children_id);
            $menu_arr = $this->menuManagementModel::dataMenuResultByMenuId($submenu_row['menu_uuid'], $lang_code);
            $tabmenu_arr = $this->menuManagementModel::dataTabMenuByMenuChildrenId($menu_children_id);
        } elseif ($menu_tab_id) {
            $tabmenu_row = $this->menuManagementModel::dataTabMenuByMenuTabId($menu_tab_id);
            $submenu_arr = $this->menuManagementModel::dataResultSubmenuByMenuChildrenId($tabmenu_row['menu_children_uuid']);
            $submenu_row = $this->menuManagementModel::dataSubmenuByMenuChildrenId($tabmenu_row['menu_children_uuid']);
            $menu_arr = $this->menuManagementModel::dataMenuResultByMenuId($submenu_row['menu_uuid'], $lang_code);
        }

        $data = [
            'menu' => $menu,
            'submenu' => $submenu,
            'tabmenu' => $tabmenu,
            'menu_arr' => $menu_arr,
            'submenu_arr' => $submenu_arr,
            'tabmenu_arr' => $tabmenu_arr
        ];
        return $this->response->setJSON($data);
    }
}
