<?php

namespace App\Controllers\Cms\Hospital;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Cms\Hospital\HospitalModel;
use App\Models\HelperModel;

class Hospital extends BaseController
{

    protected $helperModel;
    protected $generalController;
    protected $hospitalModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->hospitalModel = new HospitalModel();
        $this->generalController = new General();
    }

    // Hospital
    public function dataHospital()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $data = $this->hospitalModel::dataHospital($filter, $column, $orderDir);

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

    public function dataLocationByLangUuid()
    {
        $lang_uuid = $this->request->getVar('id');
        $data = $this->hospitalModel::dataArrayLocationByLangUuid($lang_uuid);
        return $this->response->setJSON($data);
    }

    public function dataLocation()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        // $lang_code = $this->request->getVar('lang_code');

        // $fullData = true;
        $data = $this->hospitalModel::dataLocation($filter, $column, $orderDir);

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

    public function createHospitalLocation()
    {
        $lang_uuid = $this->request->getVar('lang_uuid');
        $hospital_location_name = $this->request->getVar('hospital_location_name');

        $rules = [
            'hospital_location_name.*' => [
                'label' => 'State',
                'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The State is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'lang_uuid.*' => [
                'label' => 'Country',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The Country is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];
        $session = null;
        $validation = null;

        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create. Please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Location', 'Fail to create because field invalid');
        } else {
            $is_exist = 0;
            foreach ($lang_uuid as $key => $value) {
                $data_by_name = $this->hospitalModel::dataLocationByLangUuidAndHospitalLocationName($value, ucwords($hospital_location_name[$key]));
                if ($data_by_name) {
                    $is_exist = $key;
                    $validation = ['hospital_location_name.' . $key => 'Location already exist'];
                }
            }
            $session = $this->sessionMessage('error', 'Location already exist');
            $this->generalController->logUser('Create Location', 'Location already exist');
            if (!$is_exist) {
                foreach ($lang_uuid as $key => $value) {
                    $data_location_insert = [
                        'uuid' => $this->helperModel::generateUuid(),
                        'lang_uuid' => $value,
                        'hospital_location_code' => $this->generateUniqueCharacter($hospital_location_name[$key]),
                        'hospital_location_name' => ucwords($hospital_location_name[$key]),
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];
                    $this->helperModel->insertData($data_location_insert, false, 'hospital_location_table');
                }
                $session = $this->sessionMessage('success', 'Location has been created');
                $validation = null;
                $this->generalController->logUser('Create Location', 'Location has been created');
            }
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editHospitalLocation()
    {
        $lang_id = $this->request->getVar('lang_id');
        $type = $this->request->getVar('type');

        $data = $this->hospitalModel::dataArrayLocationByLangUuid($lang_id);
        if ($type != 'view') {
            $edit_hospital_location_name = $this->request->getVar('edit_hospital_location_name');
            $action_type = $this->request->getVar('action_type');
            $location_id = $this->request->getVar('location_id');
            $edit_lang_uuid = $this->request->getVar('edit_lang_uuid');

            $token = csrf_hash();
            $rules = [
                'edit_hospital_location_name.*' => [
                    'label' => 'State',
                    'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                    'errors' => [
                        'required' => 'The State is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_lang_uuid.*' => [
                    'label' => 'Country',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The Country is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];
            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Location', 'Fail to update because field invalid');
            } else {

                $data_location = $this->hospitalModel::dataArrayLocationByLangUuid($edit_lang_uuid[0]);
                if ($action_type == 'edit_value') {
                    foreach ($data_location as $key => $value_menu) {
                        if (is_array($location_id) && in_array($value_menu['uuid'], $location_id)) {
                            $data_update = [
                                'updated_at' => $this->dateTime(),
                            ];

                            $where = [
                                'uuid' => $value_menu['uuid'],
                            ];
                            $this->helperModel::updateData($where, $data_update, 'hospital_location_table');
                        } else {
                            $data_update = [
                                'is_deleted' => 1,
                                'updated_at' => $this->dateTime(),
                            ];

                            $where = [
                                'uuid' => $value_menu['uuid'],
                            ];
                            $this->helperModel::updateData($where, $data_update, 'hospital_location_table');
                        }
                    }
                }

                $is_exist = 0;
                if ($action_type == 'add_value') {
                    foreach ($edit_lang_uuid as $key => $value) {
                        if (!isset($location_id[$key])) {
                            $data_by_name = $this->hospitalModel::dataLocationByLangUuidAndHospitalLocationName($value, ucwords($edit_hospital_location_name[$key]));
                            if ($data_by_name) {
                                $is_exist = $key;
                                $validation = ['edit_hospital_location_name.' . $key => 'Location already exist'];
                            }
                        }
                    }
                }
                $session = $this->sessionMessage('error', 'Location already exist');
                $this->generalController->logUser('Create Location', 'Location already exist');

                if (!$is_exist) {
                    if ($action_type == 'add_value') {
                        foreach ($edit_hospital_location_name as $key => $value) {
                            if (!isset($location_id[$key])) {
                                $data_location_insert = [
                                    'uuid' => $this->helperModel::generateUuid(),
                                    'lang_uuid' => $edit_lang_uuid[$key],
                                    'hospital_location_code' => $this->generateUniqueCharacter($edit_hospital_location_name[$key]),
                                    'hospital_location_name' => ucwords($value),
                                    'created_at' => $this->dateTime(),
                                    'updated_at' => $this->dateTime()
                                ];
                                $this->helperModel->insertData($data_location_insert, false, 'hospital_location_table');
                            }
                        }
                    }
                    $session = $this->sessionMessage('success', 'Location has been updated');
                    $validation = null;
                    $this->generalController->logUser('Edit Location', 'Location has been updated');
                }
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
    }
}
