<?php

namespace App\Controllers\Cms\MenuManagement;

use App\Controllers\BaseController;
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
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
    }

    // MENU
    public function dataMenu()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start') == 0 ? $this->request->getVar('start') : $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->menuManagementModel::dataMenu($filter, $column, $orderDir, $fullData);

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
                    'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
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
        if (!$this->validate($rules)) {
            session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_name . " please check your input again"));
            return redirect()->back()->withInput();
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

            session()->setFlashdata("notif", $this->sessionMessage('success', "Menu " . $menu_name . " has been created"));
            return redirect()->back();
        }
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
            if (!$this->validate($rules)) {
                session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when update " . $data['menu_name'] . " please check your input again"));
                return redirect()->back()->withInput();
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

                session()->setFlashdata("notif", $this->sessionMessage('success', "Menu " . $data['menu_name'] . " has been updated"));
                return redirect()->back();
            }
        }
        return $this->response->setJSON($data);
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

        $fullData = true;
        $data = $this->menuManagementModel::dataSubmenu($filter, $column, $orderDir, $fullData);

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
        if (!$this->validate($rules)) {
            session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_children_name . " please check your input again"));
            return redirect()->back()->withInput();
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

            session()->setFlashdata("notif", $this->sessionMessage('success', "Submenu " . $menu_children_name . " has been created"));
            return redirect()->back();
        }
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
            if (!$this->validate($rules)) {
                session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when update " . $data['menu_children_name'] . " please check your input again"));
                return redirect()->back()->withInput();
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

                session()->setFlashdata("notif", $this->sessionMessage('success', "Submenu " . $data['menu_children_name'] . " has been updated"));
                return redirect()->back();
            }
        }
        return $this->response->setJSON($data);
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

        $fullData = true;
        $data = $this->menuManagementModel::dataTabMenu($filter, $column, $orderDir, $fullData);

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
        if (!$this->validate($rules)) {
            session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when create " . $menu_tab_name . " please check your input again"));
            return redirect()->back()->withInput();
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

            session()->setFlashdata("notif", $this->sessionMessage('success', "Tab Menu " . $menu_tab_name . " has been created"));
            return redirect()->back();
        }
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
            if (!$this->validate($rules)) {
                session()->setFlashdata("notif", $this->sessionMessage('error', "Oops, something went wrong when update " . $data['menu_tab_name'] . " please check your input again"));
                return redirect()->back()->withInput();
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

                session()->setFlashdata("notif", $this->sessionMessage('success', "Tab Menu " . $data['menu_tab_name'] . " has been updated"));
                return redirect()->back();
            }
        }
        return $this->response->setJSON($data);
    }

    public function dtActionButtons()
    {
        $columnName = $this->request->getVar('columnName');
        $modelName = $this->request->getVar('modelName');
        $buttons = $this->request->getVar('buttons');
        $draw = $this->request->getVar('draw');
        $header = $this->request->getVar('header');
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
        $data = $this->menuManagementModel::$modelName('', $columnName, 'asc', $fullData);

        switch ($buttons) {
            case 'print':

                $totalData = count($data);

                $response = [
                    'draw' => $draw,
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalData,
                    'data' => $data

                ];
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
                break;
            default:
                $data = $this->menuManagementModel::$modelName('', $columnName, 'asc');

                $totalData = count($data);

                $response = [
                    'draw' => $draw,
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalData,
                    'data' => $data

                ];
                return $this->response->setJSON($response);
        }
    }
}
