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
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->pagesModel::dataPages($filter, $column, $orderDir, $fullData);

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

    public function createPages()
    {
        $navbar_management_name = $this->request->getVar('navbar_management_name');
        $navbar_management_number = $this->request->getVar('navbar_management_number');
        $lang_code = $this->request->getVar('lang_code');

        $rules = [
            'navbar_management_name' => [
                'label' => 'Page Name',
                'rules' => 'trim|required|is_unique[page_navbar_table.navbar_management_name]|min_length[3]|regex_match[/^[A-Za-z&]+(?: [A-Za-z&]+)*$/]',
                'errors' => [
                    'required' => 'The Page Name is required',
                    'is_unique' => 'Page Name already exist',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'navbar_management_number' => [
                'label' => 'Page Number',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'regex_match' => 'Character number only and no space in first or end letter',
                    'required' => 'The Page Number is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];
        $session = null;
        $validation = null;

        // Ambil data terakhir dari database
        $lastNumber = $this->pagesModel->getLastNumberPages();

        // Jika tidak ada data di database, atur angka awal sebagai 0
        if (!$lastNumber) {
            $lastNumber = 1;
        }

        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $navbar_management_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Pages', 'Fail to insert data because field invalid');
        } else if ($navbar_management_number > $lastNumber + 1) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $navbar_management_name . " please check your input again");
            $validation = ['navbar_management_number' => 'Num must be ' . ($lastNumber + 1)];
            $this->generalController->logUser('Create Pages', 'Fail to insert data because page number invalid');
        } else {
            $this->helperModel::tambahUrutan($navbar_management_number, 'page_navbar_table', 'page_number', 'navbar_management_id', $lang_code, 'add');

            $data = [
                'uuid' => $this->helperModel::generateUuid(),
                'lang_code' => $lang_code,
                'navbar_management_name' => ucwords($navbar_management_name),
                'navbar_management_url' => '/' . url_title($navbar_management_name, '-', true),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1,
                'page_number' => $navbar_management_number,
            ];
            $this->helperModel::insertData($data, false, 'page_navbar_table');
            $session = $this->sessionMessage('success', 'Pages ' . $navbar_management_name . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Pages', 'Pages ' . $navbar_management_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editPages()
    {
        $navbar_management_id = $this->request->getVar('navbar_management_id');
        $edit_navbar_management_name = $this->request->getVar('edit_navbar_management_name');
        $edit_navbar_management_number = $this->request->getVar('edit_navbar_management_number');
        $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');
        $data = $this->pagesModel::dataPagesByPagesUuid($navbar_management_id);
        if ($type != 'view') {
            $requestData = $this->request->getJSON();
            $navbar_management_id = $requestData->navbar_management_id;
            $type = $requestData->type;
            $edit_navbar_management_name = $requestData->edit_navbar_management_name;
            $edit_navbar_management_number = $requestData->edit_navbar_management_number;
            $lang_code = $requestData->lang_code;

            $token = csrf_hash();
            $value = "";
            if ($data['navbar_management_name'] == $edit_navbar_management_name) {
                $value = 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value = 'trim|required|is_unique[page_navbar_table.navbar_management_name]|min_length[3]|regex_match[/^[A-Za-z&]+(?: [A-Za-z&]+)*$/]';
            }

            $rules = [
                'edit_navbar_management_name' => [
                    'label' => 'Page Name',
                    'rules' => $value,
                    'errors' => [
                        'required' => 'The Page Name is required',
                        'is_unique' => 'Page Name already exist',
                        'regex_match' => 'Character must be capital, alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_navbar_management_number' => [
                    'label' => 'Page Number',
                    'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                    'errors' => [
                        'regex_match' => 'Character number only and no space in first or end letter',
                        'required' => 'The Page Number is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];
            $session = null;
            $validation = null;

            // Ambil data terakhir dari database
            $lastNumber = $this->pagesModel->getLastNumberPages();

            // Jika tidak ada data di database, atur angka awal sebagai 0
            if (!$lastNumber) {
                $lastNumber = 1;
            }

            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_navbar_management_name . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Pages', 'Fail to update because field invalid');
            } else if ($edit_navbar_management_number > $lastNumber) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $edit_navbar_management_name . " please check your input again");
                $validation = ['edit_navbar_management_number' => 'Num must be ' . ($lastNumber)];
                $this->generalController->logUser('Create Pages', 'Fail to insert data because page number invalid');
            } else {
                $this->helperModel::tambahUrutan($edit_navbar_management_number, 'page_navbar_table', 'page_number', 'navbar_management_id', $lang_code, 'edit', $data['navbar_management_id']);
                $data_update = [
                    'lang_code' => $lang_code,
                    'navbar_management_name' => $edit_navbar_management_name,
                    'navbar_management_url' => '/' . url_title($edit_navbar_management_name, '-', true),
                    'updated_at' => $this->dateTime(),
                    'page_number' => $edit_navbar_management_number,
                ];

                $where = [
                    'uuid' => $navbar_management_id,
                ];
                $this->helperModel::updateData($where, $data_update, 'page_navbar_table');
                $session = $this->sessionMessage('success', 'Pages ' . $data['navbar_management_name'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit Pages', 'Pages ' . $data['navbar_management_name'] . ' has been updated');
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
    }
}
