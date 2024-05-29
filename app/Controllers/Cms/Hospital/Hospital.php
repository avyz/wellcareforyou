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

    public function searchDataHospital()
    {
        $search = $this->request->getVar('search');
        $data = null;
        if ($search) {
            $data = $this->hospitalModel::dataHospital($search, 'hospital_id', 'asc');
        }
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function getDataHospitalForTags()
    {
        $data = $this->hospitalModel::dataHospital('', 'hospital_id', 'asc', false);
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    // Hospital Branch
    public function dataHospitalBranch()
    {
        $hospital_uuid = $this->request->getVar('id');
        $data = $this->hospitalModel::dataHospitalBranch($hospital_uuid);
        return $this->response->setJSON($data);
    }

    // Create Hospital
    public function createHospital()
    {
        $hospital_image = $this->request->getFile('hospital_image');
        $hospital_name = $this->request->getVar('hospital_name');
        $hq_hospital_location_uuid = $this->request->getVar('hq_hospital_location_uuid');
        $hq_hospital_phone = $this->request->getVar('hq_hospital_phone');
        $hq_hospital_map_location = $this->request->getVar('hq_hospital_map_location');
        $hq_hospital_address = $this->request->getVar('hq_hospital_address');
        $branch_hospital_location_uuid_input = $this->request->getVar('branch_hospital_location_uuid_input');
        $branch_hospital_phone = $this->request->getVar('branch_hospital_phone');
        $branch_hospital_map_location = $this->request->getVar('branch_hospital_map_location');
        $branch_hospital_address = $this->request->getVar('branch_hospital_address');

        $rules = [
            'hospital_image' => [
                'label' => 'Hospital Photo',
                'rules' => 'trim|max_size[hospital_image,1024]|mime_in[hospital_image,image/jpg,image/jpeg,image/png, image/webp]|is_image[hospital_image]',
                'errors' => [
                    'uploaded' => 'No file on Hospital Photo',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'hospital_name' => [
                'label' => 'Hospital Name',
                'rules' => 'trim|required|min_length[3]|is_unique[hospital_table.hospital_name]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Hospital Name is required',
                    'min_length' => 'The Hospital Name must have at least 3 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'hq_hospital_location_uuid' => [
                'label' => 'State',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The State is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'hq_hospital_phone' => [
                'label' => 'Phone Number',
                'rules' => 'trim|required|min_length[10]|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Phone Number is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'hq_hospital_map_location' => [
                'label' => 'Map Location',
                'rules' => 'trim|required|min_length[3]',
                'errors' => [
                    'required' => 'The Map Location is required',
                    'min_length' => 'The Map Location must have at least 3 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'hq_hospital_address' => [
                'label' => 'Address',
                'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                'errors' => [
                    'required' => 'The Address is required',
                    'min_length' => 'The Address must have at least 3 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];

        if (!empty($branch_hospital_location_uuid_input)) {
            $rules['branch_hospital_location_uuid_input.*'] = [
                'label' => 'State',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The State is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['branch_hospital_phone.*'] = [
                'label' => 'Phone Number',
                'rules' => 'trim|required|min_length[10]|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Phone Number is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['branch_hospital_map_location.*'] = [
                'label' => 'Map Location',
                'rules' => 'trim|required|min_length[3]',
                'errors' => [
                    'required' => 'The Map Location is required',
                    'min_length' => 'The Map Location must have at least 3 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['branch_hospital_address.*'] = [
                'label' => 'Address',
                'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                'errors' => [
                    'required' => 'The Address is required',
                    'min_length' => 'The Address must have at least 3 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }
        // dd($rules);
        $session = null;
        $validation = null;

        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create. Please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Hospital', 'Fail to create because field invalid');
        } else {
            $hospital_image_name = 'logo_' . url_title($hospital_name, '_') . '.' . $hospital_image->getClientExtension();
            $data_insert = [
                'uuid' => $this->helperModel->generateUuid(),
                'hospital_image' => $hospital_image_name,
                'hospital_name' => ucwords($hospital_name),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'hospital_code' => $this->generateUniqueCharacter($hospital_name),
            ];
            $insert = $this->helperModel->insertData($data_insert, true, 'hospital_table');


            if ($insert) {
                $data_insert_center = [
                    'uuid' => $this->helperModel->generateUuid(),
                    'hospital_uuid' => $data_insert['uuid'],
                    'hospital_location_uuid' => $hq_hospital_location_uuid,
                    'hospital_address' => $hq_hospital_address,
                    'hospital_phone' => $hq_hospital_phone,
                    'hospital_map_location' => $hq_hospital_map_location,
                    'is_center' => 1,
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];
                $this->helperModel->insertData($data_insert_center, false, 'hospital_address_table');
                $hospital_image->move('assets/website/images/hospital', $hospital_image_name);
                if (!empty($branch_hospital_location_uuid_input)) {
                    foreach ($branch_hospital_location_uuid_input as $key => $value) {
                        $data_branch_insert = [
                            'uuid' => $this->helperModel->generateUuid(),
                            'hospital_uuid' => $data_insert['uuid'],
                            'hospital_location_uuid' => $branch_hospital_location_uuid_input[$key],
                            'hospital_address' => $branch_hospital_address[$key],
                            'hospital_phone' => $branch_hospital_phone[$key],
                            'hospital_map_location' => $branch_hospital_map_location[$key],
                            'is_center' => 0,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime(),
                        ];
                        $this->helperModel->insertData($data_branch_insert, false, 'hospital_address_table');
                    }
                }

                $session = $this->sessionMessage('success', 'Hospital has been created');
                $validation = null;
                $this->generalController->logUser('Create Hospital', 'Hospital has been created');
            }
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editHospital()
    {
        $hospital_id = $this->request->getVar('hospital_id');
        $type = $this->request->getVar('type');

        $data = $this->hospitalModel::dataHospitalBranch($hospital_id);
        if ($type != 'view') {
            $edit_hospital_image = $this->request->getVar('edit_hospital_image');
            $edit_hospital_image_new = $this->request->getFile('edit_hospital_image_new');
            $edit_hospital_name = $this->request->getVar('edit_hospital_name');
            $edit_hq_hospital_location_uuid = $this->request->getVar('edit_hq_hospital_location_uuid');
            $edit_hq_hospital_phone = $this->request->getVar('edit_hq_hospital_phone');
            $edit_hq_hospital_map_location = $this->request->getVar('edit_hq_hospital_map_location');
            $edit_hq_hospital_address = $this->request->getVar('edit_hq_hospital_address');
            $edit_branch_hospital_location_uuid_input = $this->request->getVar('edit_branch_hospital_location_uuid_input');
            $edit_branch_hospital_phone = $this->request->getVar('edit_branch_hospital_phone');
            $edit_branch_hospital_map_location = $this->request->getVar('edit_branch_hospital_map_location');
            $edit_branch_hospital_address = $this->request->getVar('edit_branch_hospital_address');
            $hospital_branch_id = $this->request->getVar('hospital_branch_id');
            $action_type = $this->request->getVar('action_type');

            $token = csrf_hash();
            $rules = [
                'edit_hospital_image_new' => [
                    'label' => 'Hospital Photo',
                    'rules' => 'trim|max_size[edit_hospital_image_new,1024]|mime_in[edit_hospital_image_new,image/jpg,image/jpeg,image/png, image/webp]|is_image[edit_hospital_image_new]',
                    'errors' => [
                        'uploaded' => 'No file on Hospital Photo',
                        'max_size' => 'Image must less than 1mb',
                        'is_image' => 'Image not valid',
                        'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                    ]
                ],
                'edit_hospital_name' => [
                    'label' => 'Hospital Name',
                    'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                    'errors' => [
                        'required' => 'The Hospital Name is required',
                        'min_length' => 'The Hospital Name must have at least 3 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_hq_hospital_location_uuid' => [
                    'label' => 'State',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The State is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_hq_hospital_phone' => [
                    'label' => 'Phone Number',
                    'rules' => 'trim|required|min_length[10]|regex_match[/^[0-9]+$/]',
                    'errors' => [
                        'required' => 'The Phone Number is required',
                        'regex_match' => 'Character number only',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_hq_hospital_map_location' => [
                    'label' => 'Map Location',
                    'rules' => 'trim|required|min_length[3]',
                    'errors' => [
                        'required' => 'The Map Location is required',
                        'min_length' => 'The Map Location must have at least 3 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_hq_hospital_address' => [
                    'label' => 'Address',
                    'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                    'errors' => [
                        'required' => 'The Address is required',
                        'min_length' => 'The Address must have at least 3 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];
            if (!empty($edit_branch_hospital_location_uuid_input)) {
                $rules['edit_branch_hospital_location_uuid_input.*'] = [
                    'label' => 'State',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The State is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_branch_hospital_phone.*'] = [
                    'label' => 'Phone Number',
                    'rules' => 'trim|required|min_length[10]|regex_match[/^[0-9]+$/]',
                    'errors' => [
                        'required' => 'The Phone Number is required',
                        'regex_match' => 'Character number only',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_branch_hospital_map_location.*'] = [
                    'label' => 'Map Location',
                    'rules' => 'trim|required|min_length[3]',
                    'errors' => [
                        'required' => 'The Map Location is required',
                        'min_length' => 'The Map Location must have at least 3 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_branch_hospital_address.*'] = [
                    'label' => 'Address',
                    'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                    'errors' => [
                        'required' => 'The Address is required',
                        'min_length' => 'The Address must have at least 3 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Hospital', 'Fail to update because field invalid');
            } else {
                $hospital_image_name = '';
                if ($edit_hospital_image_new->getError() == 4) {
                    // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
                    $hospital_image_name = $edit_hospital_image;
                } else {
                    $hospital_image_name = 'logo_' . url_title($edit_hospital_name, '_') . '.' . $edit_hospital_image_new->getClientExtension();
                    $this->unlinkImage('assets/website/images/hospital/' . $hospital_image_name);
                    $edit_hospital_image_new->move('assets/website/images/hospital', $hospital_image_name);
                }

                $data_update = [
                    'updated_at' => $this->dateTime(),
                    'hospital_image' => $hospital_image_name,
                    'hospital_name' => ucwords($edit_hospital_name),
                    'hospital_code' => $this->generateUniqueCharacter($edit_hospital_name),
                ];
                $where = [
                    'uuid' => $hospital_id,
                ];
                $this->helperModel::updateData($where, $data_update, 'hospital_table');

                $data_update_center = [
                    'updated_at' => $this->dateTime(),
                    'hospital_location_uuid' => $edit_hq_hospital_location_uuid,
                    'hospital_address' => $edit_hq_hospital_address,
                    'hospital_phone' => $edit_hq_hospital_phone,
                    'hospital_map_location' => $edit_hq_hospital_map_location,
                ];
                $where_center = [
                    'hospital_uuid' => $hospital_id,
                    'is_center' => 1
                ];
                $this->helperModel::updateData($where_center, $data_update_center, 'hospital_address_table');

                if (is_array($action_type)) {
                    $data_branchs = $this->hospitalModel::dataHospitalBranch($hospital_id);
                    foreach ($action_type as $key => $value_arr) {
                        if ($value_arr == 'edit_value') {
                            foreach ($data_branchs as $key => $value_menu) {
                                if (is_array($hospital_branch_id) && in_array($value_menu['uuid'], $hospital_branch_id)) {
                                    $data_update = [
                                        'updated_at' => $this->dateTime(),
                                    ];

                                    $where = [
                                        'uuid' => $value_menu['uuid'],
                                    ];
                                    $this->helperModel::updateData($where, $data_update, 'hospital_address_table');
                                } else {
                                    $data_update = [
                                        'is_deleted' => 1,
                                        'updated_at' => $this->dateTime(),
                                    ];

                                    $where = [
                                        'uuid' => $value_menu['uuid'],
                                    ];
                                    $this->helperModel::updateData($where, $data_update, 'hospital_address_table');
                                }
                            }
                            $session = $this->sessionMessage('success', 'Hospital has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Hospital', 'Hospital has been updated');
                        }
                        $is_exist = 0;
                        if ($value_arr == 'add_value') {
                            if (empty($hospital_branch_id[$key])) {
                                $data_by_address = $this->hospitalModel::dataHospitalBranchByHospitalUuidAndAddress($hospital_id, $edit_branch_hospital_address[$key]);
                                if ($data_by_address) {
                                    $is_exist = $key;
                                    $validation = ['edit_branch_hospital_address.' . $key => 'Address already exist'];
                                    $session = $this->sessionMessage('error', 'Address already exist');
                                    $this->generalController->logUser('Create Hospital', 'Address already exist');
                                }
                            }
                            if ($is_exist == 0) {
                                if (!empty($edit_branch_hospital_location_uuid_input)) {
                                    if (empty($hospital_branch_id[$key])) {
                                        $data_branch_insert = [
                                            'uuid' => $this->helperModel->generateUuid(),
                                            'hospital_uuid' => $hospital_id,
                                            'hospital_location_uuid' => $edit_branch_hospital_location_uuid_input[$key],
                                            'hospital_address' => $edit_branch_hospital_address[$key],
                                            'hospital_phone' => $edit_branch_hospital_phone[$key],
                                            'hospital_map_location' => $edit_branch_hospital_map_location[$key],
                                            'is_center' => 0,
                                            'created_at' => $this->dateTime(),
                                            'updated_at' => $this->dateTime(),
                                        ];
                                        $this->helperModel->insertData($data_branch_insert, false, 'hospital_address_table');
                                        $session = $this->sessionMessage('success', 'Hospital has been updated');
                                        $validation = null;
                                        $this->generalController->logUser('Edit Hospital', 'Hospital has been updated');
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $session = $this->sessionMessage('success', 'Hospital has been updated');
                    $validation = null;
                    $this->generalController->logUser('Edit Hospital', 'Hospital has been updated');
                }
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
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
                if (is_array($action_type)) {
                    foreach ($action_type as $key => $value_arr) {
                        if ($value_arr == 'edit_value') {
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
                            $session = $this->sessionMessage('success', 'Location has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Location', 'Location has been updated');
                        }
                        $is_exist = 0;
                        if ($value_arr == 'add_value') {
                            if (!isset($location_id[$key])) {
                                $data_by_name = $this->hospitalModel::dataLocationByLangUuidAndHospitalLocationName($edit_lang_uuid[$key], ucwords($edit_hospital_location_name[$key]));
                                if ($data_by_name) {
                                    $is_exist = $key;
                                    $validation = ['edit_hospital_location_name.' . $key => 'Location already exist'];
                                    $session = $this->sessionMessage('error', 'Location already exist');
                                    $this->generalController->logUser('Create Location', 'Location already exist');
                                }
                            }
                            // foreach ($edit_lang_uuid as $key => $value) {
                            //     if (!isset($location_id[$key])) {
                            //         $data_by_name = $this->hospitalModel::dataLocationByLangUuidAndHospitalLocationName($value, ucwords($edit_hospital_location_name[$key]));
                            //         if ($data_by_name) {
                            //             $is_exist = $key;
                            //             $validation = ['edit_hospital_location_name.' . $key => 'Location already exist'];
                            //             $session = $this->sessionMessage('error', 'Location already exist');
                            //             $this->generalController->logUser('Create Location', 'Location already exist');
                            //         }
                            //     }
                            // }
                            if ($is_exist == 0) {
                                if (!isset($location_id[$key])) {
                                    $data_location_insert = [
                                        'uuid' => $this->helperModel::generateUuid(),
                                        'lang_uuid' => $edit_lang_uuid[$key],
                                        'hospital_location_code' => $this->generateUniqueCharacter($edit_hospital_location_name[$key]),
                                        'hospital_location_name' => ucwords($edit_hospital_location_name[$key]),
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime()
                                    ];
                                }
                                // foreach ($edit_hospital_location_name as $key => $value) {
                                //     if (!isset($location_id[$key])) {
                                //         $data_location_insert = [
                                //             'uuid' => $this->helperModel::generateUuid(),
                                //             'lang_uuid' => $edit_lang_uuid[$key],
                                //             'hospital_location_code' => $this->generateUniqueCharacter($edit_hospital_location_name[$key]),
                                //             'hospital_location_name' => ucwords($value),
                                //             'created_at' => $this->dateTime(),
                                //             'updated_at' => $this->dateTime()
                                //         ];
                                //     }
                                // }
                                $this->helperModel->insertData($data_location_insert, false, 'hospital_location_table');
                                $session = $this->sessionMessage('success', 'Location has been updated');
                                $validation = null;
                                $this->generalController->logUser('Edit Location', 'Location has been updated');
                            }
                        }
                    }
                } else {
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

    // Hospital Package
    public function dataPackages()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $hospital_uuid = $this->request->getVar('hospital_uuid');
        $lang_code = $this->request->getVar('lang_code');
        $fullData = false;
        $data = $this->hospitalModel::dataPackageByHospitalUuid($filter, $column, $orderDir, $fullData, $hospital_uuid, $lang_code);

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

    public function viewPackageHospital()
    {
        $title = 'Package Hospital';
        $hospital_uuid = $this->request->getVar('hospital_uuid');
        $hospital_name = $this->request->getVar('hospital_name');
        $hospital_code = $this->request->getVar('hospital_code');
        $lang_code = $this->request->getVar('lang_code');
        $fullData = false;
        $data = $this->hospitalModel::dataPackageByHospitalUuid('', 'hospital_package_id', 'asc', $fullData, $hospital_uuid, $lang_code);

        $result['hospital_uuid'] = $hospital_uuid;
        $result['hospital_name'] = $hospital_name;
        $result['hospital_code'] = $hospital_code;
        $result['lang_code'] = $lang_code;
        $result['packages'] = $data;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        return  $this->generalController->links($passData);
    }

    public function viewPackagePost()
    {
        $hospital_name = $this->request->getVar('hospital_name');
        $title = 'Package ' . $hospital_name;
        $hospital_uuid = $this->request->getVar('hospital_uuid');
        $hospital_code = $this->request->getVar('hospital_code');
        $hospital_package_uuid = $this->request->getVar('hospital_package_uuid');
        $lang_code = $this->request->getVar('lang_code');
        $action_type = $this->request->getVar('action_type');
        $fullData = false;
        if ($action_type == 'edit') {
            $data = $this->hospitalModel::dataPackageByHospitalPackageUuid($hospital_package_uuid);
            $result['package'] = $data;
            $result['hospital_package_uuid'] = $hospital_package_uuid;
        }

        $result['hospital_uuid'] = $hospital_uuid;
        $result['hospital_name'] = $hospital_name;
        $result['hospital_code'] = $hospital_code;
        $result['lang_code'] = $lang_code;
        $result['action_type'] = $action_type;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        return  $this->generalController->links($passData);
    }


    public function uploadImageCustom()
    {
        $file = $this->request->getFile('upload');

        $rules = [
            'upload' => [
                'label' => 'Package Image',
                'rules' => 'trim|max_size[upload,1024]|mime_in[upload,image/jpg,image/jpeg,image/png, image/webp]|is_image[upload]',
                'errors' => [
                    'uploaded' => 'No file on Package Image',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
        ];

        // dd($file);
        // Pindahkan file yang diunggah ke direktori yang ditentukan
        if (!$this->validate($rules)) {
            // $message = validation_errors();
            // get error message spesific
            $message = $this->validator->getError('upload');
            $imageUrl = '';
        } else {
            if (isset($file) && $file->isValid()) {
                // Dapatkan nama file yang diunggah
                $fileName = $file->getName();
                // Generate URL untuk file yang diunggah
                $hospital_package_name = $this->generateUniqueCharacter($fileName) . '_' . time() . '.' . $file->getClientExtension();
                $file->move('assets/website/images/hospital/package', $hospital_package_name);
                $imageUrl = base_url('assets/website/images/hospital/package/' . $hospital_package_name);
                $message = "";
            } else {
                $imageUrl = '';
            }
        }

        if ($message) {
            $result = ['url' => $imageUrl, 'error' => ['message' => $message]];
        } else {
            $result = ['url' => $imageUrl];
        }
        // Return URL gambar dalam format yang sesuai dengan kebutuhan CKEditor
        return $this->response->setJSON($result);
    }

    // create Hospital Package
    public function createHospitalPackage()
    {
        $hospital_uuid = $this->request->getVar('hospital_uuid');
        $hospital_name = $this->request->getVar('hospital_name');
        $hospital_code = $this->request->getVar('hospital_code');
        $package_title = $this->request->getVar('package_title');
        $lang_code = $this->request->getVar('lang_code');
        $lang_uuid = $this->request->getVar('lang_uuid');
        $package = $this->request->getVar('package');

        $rules = [
            'hospital_uuid' => [
                'label' => 'Hospital Uuid',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Uuid is required',
                ]
            ],
            'hospital_name' => [
                'label' => 'Hospital Name',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Name is required',
                ]
            ],
            'hospital_code' => [
                'label' => 'Hospital Code',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Code is required',
                ]
            ],
            'package_title' => [
                'label' => 'Title',
                'rules' => 'trim|required|is_unique[hospital_package_table.package_title]',
                'errors' => [
                    'required' => 'Title is required',
                ]
            ],
            'lang_code' => [
                'label' => 'Language Code',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Language Code is required',
                ]
            ],
            'lang_uuid' => [
                'label' => 'Language',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Language is required',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create. Please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Package', 'Fail to create because field invalid');
        } else {
            $data_insert = [
                'uuid' => $this->helperModel->generateUuid(),
                'hospital_uuid' => $hospital_uuid,
                'lang_uuid' => $lang_uuid,
                'package_title' => $package_title,
                'package' => $package,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ];
            $insert = $this->helperModel->insertData($data_insert, true, 'hospital_package_table');

            if ($insert) {
                $session = $this->sessionMessage('success', 'Package has been created');
                $validation = null;
                $this->generalController->logUser('Create Package', 'Package has been created');
            }
            $result['redirect'] = base_url('hospital/hospital/packages?hospital_uuid=' . $hospital_uuid . '&hospital_name=' . $hospital_name . '&hospital_code=' . $hospital_code . '&lang_code=' . $lang_code);
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    // edit Hospital Package
    public function editHospitalPackage()
    {
        $edit_hospital_uuid = $this->request->getVar('edit_hospital_uuid');
        $edit_hospital_name = $this->request->getVar('edit_hospital_name');
        $edit_hospital_code = $this->request->getVar('edit_hospital_code');
        $edit_package_title = $this->request->getVar('edit_package_title');
        $edit_lang_code = $this->request->getVar('edit_lang_code');
        $edit_lang_uuid = $this->request->getVar('edit_lang_uuid');
        $edit_package = $this->request->getVar('edit_package');
        $edit_hospital_package_uuid = $this->request->getVar('edit_hospital_package_uuid');

        $data_package = $this->hospitalModel::dataPackageByHospitalPackageUuid($edit_hospital_package_uuid);

        // dd($data_package['package_title']);
        $unique = 'trim|required|is_unique[hospital_package_table.package_title]';
        if (isset($data_package)) {
            if ($data_package['package_title'] == $edit_package_title) {
                $unique = 'trim|required';
            } else {
                $unique = 'trim|required|is_unique[hospital_package_table.package_title]';
            }
        }

        $rules = [
            'edit_hospital_uuid' => [
                'label' => 'Hospital Uuid',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Uuid is required',
                ]
            ],
            'edit_hospital_name' => [
                'label' => 'Hospital Name',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Name is required',
                ]
            ],
            'edit_hospital_code' => [
                'label' => 'Hospital Code',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Hospital Code is required',
                ]
            ],
            'edit_package_title' => [
                'label' => 'Title',
                'rules' => $unique,
                'errors' => [
                    'required' => 'Title is required',
                ]
            ],
            'edit_lang_code' => [
                'label' => 'Language Code',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Language Code is required',
                ]
            ],
            'edit_lang_uuid' => [
                'label' => 'Language',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Language is required',
                ]
            ],
        ];
        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Edit Package', 'Fail to update because field invalid');
        } else {
            $data_update = [
                'updated_at' => $this->dateTime(),
                'lang_uuid' => $edit_lang_uuid,
                'package_title' => $edit_package_title,
                'package' => $edit_package,
            ];
            $where = [
                'uuid' => $edit_hospital_package_uuid,
            ];

            $this->helperModel::updateData($where, $data_update, 'hospital_package_table');

            $session = $this->sessionMessage('success', 'Package has been updated');
            $validation = null;
            $this->generalController->logUser('Edit Package', 'Package has been updated');
            $result['redirect'] = base_url('hospital/hospital/packages?hospital_uuid=' . $edit_hospital_uuid . '&hospital_name=' . $edit_hospital_name . '&hospital_code=' . $edit_hospital_code . '&lang_code=' . $edit_lang_code);
        }
        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }
}
