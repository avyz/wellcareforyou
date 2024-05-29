<?php

namespace App\Controllers\Cms\Doctor;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Cms\Doctor\DoctorModel;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\HelperModel;

class Doctor extends BaseController
{

    protected $helperModel;
    protected $doctorModel;
    protected $generalController;
    protected $menuManagementModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->doctorModel = new DoctorModel();
        $this->generalController = new General();
        $this->menuManagementModel = new MenuManagementModel();
    }

    // MENU
    // Admin
    public function dataDoctor()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];
        $lang_code = $this->request->getVar('lang_code');

        $fullData = false;
        $data = $this->doctorModel::dataDoctor($filter, $column, $orderDir, $fullData, $lang_code);

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

    public function createDoctor()
    {
        $doctor_name = $this->request->getVar('doctor_name');
        $doctor_image = $this->request->getFile('doctor_image');
        $doctor_image_name = url_title(str_replace('.', '_', $doctor_name), '_', true) . '.' . $doctor_image->getClientExtension();
        $doctor_gender = $this->request->getVar('doctor_gender');
        $doctor_phone = $this->request->getVar('doctor_phone');
        $doctor_address = $this->request->getVar('doctor_address');

        // Tag
        $doctor_language = $this->request->getVar('doctor_language');
        // $check_doctor_language = $this->request->getVar('check_doctor_language');
        $doctor_specialist = $this->request->getVar('doctor_specialist');
        // $check_doctor_specialist = $this->request->getVar('check_doctor_specialist');
        $doctor_hospital = $this->request->getVar('doctor_hospital');
        // $check_doctor_hospital = $this->request->getVar('check_doctor_hospital');
        // End

        // Education Var
        $doctor_education = $this->request->getVar('doctor_education');
        $doctor_education_location = $this->request->getVar('doctor_education_location');
        $doctor_education_year = $this->request->getVar('doctor_education_year');
        // End

        // Employment Var
        $doctor_employment = $this->request->getVar('doctor_employment');
        $doctor_employment_year = $this->request->getVar('doctor_employment_year');
        // $doctor_employment_end_year = $this->request->getVar('doctor_employment_end_year');
        // End

        $language_list = $this->menuManagementModel::languageList();

        $day = $this->dayArray();

        $rules = [
            'doctor_name' => [
                'label' => 'Doctor Name',
                'rules' => 'trim|required|is_unique[doctor_table.doctor_name]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Doctor Name is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'doctor_image' => [
                'label' => 'Doctor Photo',
                'rules' => 'trim|max_size[doctor_image,1024]|mime_in[doctor_image,image/jpg,image/jpeg,image/png, image/webp]|is_image[doctor_image]',
                'errors' => [
                    'uploaded' => 'No file on Doctor Photo',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'doctor_gender' => [
                'label' => 'Doctor Gender',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Doctor Gender is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'doctor_phone' => [
                'label' => 'Phone',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Phone is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'doctor_address' => [
                'label' => 'Address',
                'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                'errors' => [
                    'required' => 'The Address is required',
                    'min_length' => 'The Address must have at least 3 characters',
                    'regex_match' => 'No single quotes allowed',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'check_doctor_language' => [
                'label' => 'Language',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Language is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'check_doctor_specialist' => [
                'label' => 'Specialist',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Specialist is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'check_doctor_hospital' => [
                'label' => 'Hospital',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Hospital is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
        ];

        if (!empty($doctor_education)) {
            $rules['doctor_education.*'] = [
                'label' => 'Education',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The Education is required',
                    'min_length' => 'The Address must have at least 1 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['doctor_education_location.*'] = [
                'label' => 'Education Location',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The Education Location is required',
                    'min_length' => 'The Address must have at least 1 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['doctor_education_year.*'] = [
                'label' => 'Education Year',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Education Year is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }

        if (!empty($doctor_employment)) {
            $rules['doctor_employment.*'] = [
                'label' => 'Education',
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'The Education is required',
                    'min_length' => 'The Address must have at least 1 characters',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['doctor_employment_year.*'] = [
                'label' => 'Year',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'The Year is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            // $rules['doctor_employment_end_year.*'] = [
            //     'label' => 'End Year',
            //     'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
            //     'errors' => [
            //         'required' => 'The End Year is required',
            //         'regex_match' => 'Character number only',
            //         'trim' => 'Character has space in first or end letter',
            //     ]
            // ];
        }

        foreach ($language_list as $key => $d) {
            $rules['doctor_biography_' . $d['lang_code']] = [
                'label' => 'Biography',
                'rules' => 'trim|regex_match[^[^\']*$]',
                'errors' => [
                    'required' => 'The Biography is required',
                    'regex_match' => 'No single quotes allowed',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }

        foreach ($day as $d) {
            $rules['doctor_worktime_start_' . $d] = [
                'label' => 'Worktime Start ' . $d,
                'rules' => 'trim',
                'errors' => [
                    // 'required' => 'The Worktime ' . $d . ' is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
            $rules['doctor_worktime_end_' . $d] = [
                'label' => 'Worktime End ' . $d,
                'rules' => 'trim',
                'errors' => [
                    // 'required' => 'The Worktime ' . $d . ' is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }

        $session = null;
        $validation = null;

        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create. Please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Doctor', 'Fail to create because field invalid');
        } else {
            $data_doctor_insert = [
                'uuid' => $this->helperModel::generateUuid(),
                'doctor_image' => $doctor_image_name,
                'doctor_name' => $doctor_name,
                'doctor_gender' => $doctor_gender,
                'doctor_phone' => $doctor_phone,
                'doctor_address' => $doctor_address,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];

            $this->helperModel::insertData($data_doctor_insert, false, 'doctor_table');

            $doctor_image->move('assets/website/images/doctor', $doctor_image_name);

            foreach ($language_list as $key => $d) {
                $doctor_biography = $this->request->getVar('doctor_biography_' . $d['lang_code']);
                if ($doctor_biography) {
                    $data_doctor_biography = [
                        'uuid' => $this->helperModel::generateUuid(),
                        'doctor_uuid' => $data_doctor_insert['uuid'],
                        'doctor_biography' => $doctor_biography,
                        'lang_code' => $d['lang_code'],
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];
                    $this->helperModel::insertData($data_doctor_biography, false, 'doctor_biography_list_table');
                }
            }

            foreach ($doctor_language as $key => $dl) {
                $data_doctor_language = [
                    'uuid' => $this->helperModel::generateUuid(),
                    'doctor_uuid' => $data_doctor_insert['uuid'],
                    'lang_code' => $dl,
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];
                $this->helperModel::insertData($data_doctor_language, false, 'doctor_language_list_table');
            }

            foreach ($doctor_hospital as $key => $dh) {
                $data_doctor_hospital = [
                    'uuid' => $this->helperModel::generateUuid(),
                    'doctor_uuid' => $data_doctor_insert['uuid'],
                    'hospital_uuid' => $dh,
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];
                $this->helperModel::insertData($data_doctor_hospital, false, 'doctor_hospital_table');
            }

            foreach ($doctor_specialist as $key => $ds) {
                $data_doctor_specialist = [
                    'uuid' => $this->helperModel::generateUuid(),
                    'doctor_uuid' => $data_doctor_insert['uuid'],
                    'doctor_specialist_uuid' => $ds,
                    'created_at' => $this->dateTime(),
                    'updated_at' => $this->dateTime()
                ];
                $this->helperModel::insertData($data_doctor_specialist, false, 'doctor_specialist_list_table');
            }

            foreach ($day as $d) {
                $doctor_worktime_start = $this->request->getVar('doctor_worktime_start_' . $d);
                $doctor_worktime_end = $this->request->getVar('doctor_worktime_end_' . $d);
                if ($doctor_worktime_start && $doctor_worktime_end) {
                    $data_doctor_worktime = [
                        'uuid' => $this->helperModel::generateUuid(),
                        'doctor_uuid' => $data_doctor_insert['uuid'],
                        'worktime_day' => $d,
                        'worktime_start_time' => $doctor_worktime_start,
                        'worktime_end_time' => $doctor_worktime_end,
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime(),
                        'is_closed' => 0
                    ];
                } else {
                    $data_doctor_worktime = [
                        'uuid' => $this->helperModel::generateUuid(),
                        'doctor_uuid' => $data_doctor_insert['uuid'],
                        'worktime_day' => $d,
                        'worktime_start_time' => '00:00',
                        'worktime_end_time' => '00:00',
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime(),
                        'is_closed' => 1
                    ];
                }
                $this->helperModel::insertData($data_doctor_worktime, false, 'doctor_worktime_table');
            }

            if (!empty($doctor_education)) {
                foreach ($doctor_education as $key => $value) {
                    $data_doctor_education_insert = [
                        'uuid' => $this->helperModel->generateUuid(),
                        'doctor_uuid' => $data_doctor_insert['uuid'],
                        'doctor_education' => $value,
                        'doctor_education_location' => $doctor_education_location[$key],
                        'doctor_education_year' => $doctor_education_year[$key],
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime(),
                    ];
                    $this->helperModel->insertData($data_doctor_education_insert, false, 'doctor_education_table');
                }
            }

            if (!empty($doctor_employment)) {
                foreach ($doctor_employment as $key => $value) {
                    $data_doctor_employment_insert = [
                        'uuid' => $this->helperModel->generateUuid(),
                        'doctor_uuid' => $data_doctor_insert['uuid'],
                        'doctor_employment' => $value,
                        'doctor_employment_year' => $doctor_employment_year[$key],
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime(),
                    ];
                    $this->helperModel->insertData($data_doctor_employment_insert, false, 'doctor_employment_table');
                }
            }

            $session = $this->sessionMessage('success', 'Doctor ' . $doctor_name . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Doctor', 'Doctor ' . $doctor_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editDoctor()
    {
        $type = $this->request->getVar('type');
        $doctor_id = $this->request->getVar('doctor_id');
        $edit_doctor_name = $this->request->getVar('edit_doctor_name');
        $edit_doctor_image_new = $this->request->getFile('edit_doctor_image_new');
        $edit_doctor_image = $this->request->getVar('edit_doctor_image');
        $edit_doctor_gender = $this->request->getVar('edit_doctor_gender');
        $edit_doctor_phone = $this->request->getVar('edit_doctor_phone');
        $edit_doctor_address = $this->request->getVar('edit_doctor_address');

        // Tag
        $edit_doctor_language = $this->request->getVar('edit_doctor_language');
        $edit_doctor_specialist = $this->request->getVar('edit_doctor_specialist');
        $edit_doctor_hospital = $this->request->getVar('edit_doctor_hospital');
        // End

        // Education Var
        $action_type_education = $this->request->getVar('action_type_education');
        $doctor_education_id = $this->request->getVar('doctor_education_id');
        $edit_doctor_education = $this->request->getVar('edit_doctor_education');
        $edit_doctor_education_location = $this->request->getVar('edit_doctor_education_location');
        $edit_doctor_education_year = $this->request->getVar('edit_doctor_education_year');
        // End

        // Employment Var
        $action_type_employment = $this->request->getVar('action_type_employment');
        $doctor_employment_id = $this->request->getVar('doctor_employment_id');
        $edit_doctor_employment = $this->request->getVar('edit_doctor_employment');
        $edit_doctor_employment_year = $this->request->getVar('edit_doctor_employment_year');
        // End

        $language_list = $this->menuManagementModel::languageList();

        $day = $this->dayArray();

        // dd($doctor_id);
        $data_doctor = $this->doctorModel::dataDoctorById($doctor_id);
        $data_language = $this->doctorModel::dataDoctorLanguageById($doctor_id);
        $data_biography = $this->doctorModel::dataDoctorBiographyById($doctor_id);
        $data_education = $this->doctorModel::dataDoctorEducationById($doctor_id);
        $data_employment = $this->doctorModel::dataDoctorEmploymentById($doctor_id);
        $data_hospital = $this->doctorModel::dataDoctorHospitalById($doctor_id);
        $data_specialist = $this->doctorModel::dataDoctorSpecialistListById($doctor_id);
        $data_worktime = $this->doctorModel::dataDoctorWorktimeById($doctor_id);

        if ($type != 'view') {

            if ($data_doctor['doctor_name'] == $edit_doctor_name) {
                $unique = 'trim|required|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $unique = 'trim|required|is_unique[doctor_table.doctor_name]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_doctor_name' => [
                    'label' => 'Doctor Name',
                    'rules' => $unique,
                    'errors' => [
                        'required' => 'The Doctor Name is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_doctor_image_new' => [
                    'label' => 'Doctor Photo',
                    'rules' => 'trim|max_size[edit_doctor_image_new,1024]|mime_in[edit_doctor_image_new,image/jpg,image/jpeg,image/png, image/webp]|is_image[edit_doctor_image_new]',
                    'errors' => [
                        'uploaded' => 'No file on Doctor Photo',
                        'max_size' => 'Image must less than 1mb',
                        'is_image' => 'Image not valid',
                        'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                    ]
                ],
                'edit_doctor_gender' => [
                    'label' => 'Doctor Gender',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Doctor Gender is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_doctor_phone' => [
                    'label' => 'Phone',
                    'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                    'errors' => [
                        'required' => 'The Phone is required',
                        'regex_match' => 'Character number only',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_doctor_address' => [
                    'label' => 'Address',
                    'rules' => 'trim|required|min_length[3]|regex_match[^[^\']*$]',
                    'errors' => [
                        'required' => 'The Address is required',
                        'min_length' => 'The Address must have at least 3 characters',
                        'regex_match' => 'No single quotes allowed',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'check_edit_doctor_language' => [
                    'label' => 'Language',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Language is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'check_edit_doctor_specialist' => [
                    'label' => 'Specialist',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Specialist is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'check_edit_doctor_hospital' => [
                    'label' => 'Hospital',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Hospital is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
            ];

            if (!empty($edit_doctor_education)) {
                $rules['edit_doctor_education.*'] = [
                    'label' => 'Education',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The Education is required',
                        'min_length' => 'The Address must have at least 1 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_doctor_education_location.*'] = [
                    'label' => 'Education Location',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The Education Location is required',
                        'min_length' => 'The Address must have at least 1 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_doctor_education_year.*'] = [
                    'label' => 'Education Year',
                    'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                    'errors' => [
                        'required' => 'The Education Year is required',
                        'regex_match' => 'Character number only',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            if (!empty($edit_doctor_employment)) {
                $rules['edit_doctor_employment.*'] = [
                    'label' => 'Education',
                    'rules' => 'trim|required|min_length[1]',
                    'errors' => [
                        'required' => 'The Education is required',
                        'min_length' => 'The Address must have at least 1 characters',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['edit_doctor_employment_year.*'] = [
                    'label' => 'Year',
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'The Year is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            foreach ($language_list as $key => $d) {
                $rules['edit_doctor_biography_' . $d['lang_code']] = [
                    'label' => 'Biography',
                    'rules' => 'trim|regex_match[^[^\']*$]',
                    'errors' => [
                        'required' => 'The Biography is required',
                        'regex_match' => 'No single quotes allowed',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            foreach ($day as $d) {
                $rules['doctor_worktime_start_' . $d] = [
                    'label' => 'Worktime Start ' . $d,
                    'rules' => 'trim',
                    'errors' => [
                        // 'required' => 'The Worktime ' . $d . ' is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
                $rules['doctor_worktime_end_' . $d] = [
                    'label' => 'Worktime End ' . $d,
                    'rules' => 'trim',
                    'errors' => [
                        // 'required' => 'The Worktime ' . $d . ' is required',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            }

            $session = null;
            $validation = null;

            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when create. Please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Doctor', 'Fail to edit because field invalid');
            } else {
                if (!$edit_doctor_image_new->getClientExtension()) {
                    $edit_doctor_image_name = $edit_doctor_image;
                } else {
                    $edit_doctor_image_name = url_title(str_replace('.', '_', $edit_doctor_name), '_', true) . '.' . $edit_doctor_image_new->getClientExtension();
                    // $edit_doctor_image_new->move('assets/website/images/doctor', $edit_doctor_image_name);
                }

                $data_doctor_update = [
                    'doctor_name' => $edit_doctor_name,
                    'doctor_image' => $edit_doctor_image_name,
                    'doctor_gender' => $edit_doctor_gender,
                    'doctor_phone' => $edit_doctor_phone,
                    'doctor_address' => $edit_doctor_address,
                    'updated_at' => $this->dateTime()
                ];

                $where = [
                    'uuid' => $doctor_id,
                ];

                if ($edit_doctor_image_new->getClientExtension()) {
                    $this->unlinkImage('assets/website/images/doctor/' . $edit_doctor_image);
                    $edit_doctor_image_new->move('assets/website/images/doctor', $edit_doctor_image_name);
                }

                $this->helperModel::updateData($where, $data_doctor_update, 'doctor_table');

                foreach ($language_list as $key => $d) {
                    $edit_doctor_biography = $this->request->getVar('edit_doctor_biography_' . $d['lang_code']);
                    $data_biography_by_lang_code = $this->doctorModel::dataDoctorBiographyByIdAndLangCode($doctor_id, $d['lang_code']);

                    if ($data_biography_by_lang_code) {
                        if ($edit_doctor_biography) {
                            $data_doctor_biography_update = [
                                'doctor_biography' => $edit_doctor_biography,
                                'updated_at' => $this->dateTime()
                            ];

                            $where = [
                                'uuid' => $data_biography_by_lang_code['uuid'],
                            ];
                            $this->helperModel::updateData($where, $data_doctor_biography_update, 'doctor_biography_list_table');
                        } else {
                            $where = 'uuid';
                            $table = 'doctor_biography_list_table';
                            $hard_delete = true;

                            $data = [];

                            $this->helperModel::deleteData($where, $data_biography_by_lang_code['uuid'], $data, $table, $hard_delete);
                        }
                    } else {
                        if ($edit_doctor_biography) {
                            $data_doctor_biography_insert = [
                                'uuid' => $this->helperModel::generateUuid(),
                                'doctor_uuid' => $doctor_id,
                                'doctor_biography' => $edit_doctor_biography,
                                'lang_code' => $d['lang_code'],
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];
                            $this->helperModel::insertData($data_doctor_biography_insert, false, 'doctor_biography_list_table');
                        }
                    }
                }

                foreach ($data_language as $key => $dl) {
                    if (in_array($dl['lang_code'], $edit_doctor_language)) {
                        $update_data_doctor_language = [
                            'updated_at' => $this->dateTime()
                        ];
                        $where = [
                            'uuid' => $dl['uuid']
                        ];

                        $this->helperModel::updateData($where, $update_data_doctor_language, 'doctor_language_list_table');
                    } else {
                        if ($dl['uuid']) {
                            $where = 'uuid';
                            $table = 'doctor_language_list_table';
                            $hard_delete = true;

                            $data = [];

                            $this->helperModel::deleteData($where, $dl['uuid'], $data, $table, $hard_delete);
                        }
                    }
                }
                foreach ($edit_doctor_language as $key => $dl) {
                    $data_language_by_id = $this->doctorModel::dataDoctorLanguageByIdAndLangCode($doctor_id, $dl);
                    if (!$data_language_by_id) {
                        $data_doctor_language = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'doctor_uuid' => $doctor_id,
                            'lang_code' => $dl,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];
                        $this->helperModel::insertData($data_doctor_language, false, 'doctor_language_list_table');
                    }
                }

                foreach ($data_hospital as $key => $dh) {
                    if (in_array($dh['hospital_uuid'], $edit_doctor_hospital)) {
                        $update_data_doctor_hospital = [
                            'updated_at' => $this->dateTime()
                        ];
                        $where = [
                            'uuid' => $dh['uuid']
                        ];

                        $this->helperModel::updateData($where, $update_data_doctor_hospital, 'doctor_hospital_table');
                    } else {
                        if ($dh['uuid']) {
                            $where = 'uuid';
                            $table = 'doctor_hospital_table';
                            $hard_delete = true;

                            $data = [];

                            $this->helperModel::deleteData($where, $dh['uuid'], $data, $table, $hard_delete);
                        }
                    }
                }
                foreach ($edit_doctor_hospital as $key => $dh) {
                    $data_hospital_by_id = $this->doctorModel::dataDoctorHospitalByIdAndHospitalId($doctor_id, $dh);
                    if (!$data_hospital_by_id) {
                        $data_doctor_hospital = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'doctor_uuid' => $doctor_id,
                            'hospital_uuid' => $dh,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];
                        $this->helperModel::insertData($data_doctor_hospital, false, 'doctor_hospital_table');
                    }
                }

                foreach ($data_specialist as $key => $ds) {
                    if (in_array($ds['doctor_specialist_uuid'], $edit_doctor_specialist)) {
                        $update_data_doctor_specialist = [
                            'updated_at' => $this->dateTime()
                        ];
                        $where = [
                            'uuid' => $ds['uuid']
                        ];

                        $this->helperModel::updateData($where, $update_data_doctor_specialist, 'doctor_specialist_list_table');
                    } else {
                        if ($ds['uuid']) {
                            $where = 'uuid';
                            $table = 'doctor_specialist_list_table';
                            $hard_delete = true;

                            $data = [];

                            $this->helperModel::deleteData($where, $ds['uuid'], $data, $table, $hard_delete);
                        }
                    }
                }

                foreach ($edit_doctor_specialist as $key => $ds) {
                    $data_specialist_by_id = $this->doctorModel::dataDoctorSpecialistByIdAndSpecialistId($doctor_id, $ds);
                    if (!$data_specialist_by_id) {
                        $data_doctor_specialist = [
                            'uuid' => $this->helperModel::generateUuid(),
                            'doctor_uuid' => $doctor_id,
                            'doctor_specialist_uuid' => $ds,
                            'created_at' => $this->dateTime(),
                            'updated_at' => $this->dateTime()
                        ];
                        $this->helperModel::insertData($data_doctor_specialist, false, 'doctor_specialist_list_table');
                    }
                }

                // dd($data_worktime);

                if ($data_worktime) {
                    foreach ($data_worktime as $dw) {
                        $edit_doctor_worktime_start = $this->request->getVar('edit_doctor_worktime_start_' . $dw['worktime_day']);
                        $edit_doctor_worktime_end = $this->request->getVar('edit_doctor_worktime_end_' . $dw['worktime_day']);
                        if ($edit_doctor_worktime_start && $edit_doctor_worktime_end) {
                            $update_doctor_worktime = [
                                'worktime_start_time' => $edit_doctor_worktime_start,
                                'worktime_end_time' => $edit_doctor_worktime_end,
                                'updated_at' => $this->dateTime(),
                                'is_closed' => 0
                            ];
                        } else {
                            $update_doctor_worktime = [
                                'worktime_start_time' => '00:00',
                                'worktime_end_time' => '00:00',
                                'updated_at' => $this->dateTime(),
                                'is_closed' => 1
                            ];
                        }

                        $where = [
                            'uuid' => $dw['uuid'],
                        ];

                        $this->helperModel::updateData($where, $update_doctor_worktime, 'doctor_worktime_table');
                    }
                } else {
                    foreach ($day as $d) {
                        $edit_doctor_worktime_start = $this->request->getVar('edit_doctor_worktime_start_' . $d);
                        $edit_doctor_worktime_end = $this->request->getVar('edit_doctor_worktime_end_' . $d);
                        if ($edit_doctor_worktime_start && $edit_doctor_worktime_end) {
                            $data_doctor_worktime = [
                                'uuid' => $this->helperModel::generateUuid(),
                                'doctor_uuid' => $doctor_id,
                                'worktime_day' => $d,
                                'worktime_start_time' => $edit_doctor_worktime_start,
                                'worktime_end_time' => $edit_doctor_worktime_end,
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'is_closed' => 0
                            ];
                        } else {
                            $data_doctor_worktime = [
                                'uuid' => $this->helperModel::generateUuid(),
                                'doctor_uuid' => $doctor_id,
                                'worktime_day' => $d,
                                'worktime_start_time' => '00:00',
                                'worktime_end_time' => '00:00',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'is_closed' => 1
                            ];
                        }
                        $this->helperModel::insertData($data_doctor_worktime, false, 'doctor_worktime_table');
                    }
                }

                if (is_array($action_type_education)) {
                    // $data_branchs = $this->hospitalModel::dataHospitalBranch($hospital_id);
                    foreach ($action_type_education as $key => $value_arr) {
                        if ($value_arr == 'edit_value') {
                            foreach ($data_education as $key => $value_menu) {
                                if (is_array($doctor_education_id) && in_array($value_menu['uuid'], $doctor_education_id)) {
                                    $data_update = [
                                        'updated_at' => $this->dateTime(),
                                    ];

                                    $where = [
                                        'uuid' => $value_menu['uuid'],
                                    ];
                                    $this->helperModel::updateData($where, $data_update, 'doctor_education_table');
                                } else {
                                    $where = 'uuid';
                                    $table = 'doctor_education_table';
                                    $hard_delete = true;

                                    $data = [];

                                    $this->helperModel::deleteData($where, $value_menu['uuid'], $data, $table, $hard_delete);
                                }
                            }
                        }
                        $is_exist = 0;
                        if ($value_arr == 'add_value') {
                            if (empty($doctor_education_id[$key])) {
                                $data_education_by_id = $this->doctorModel::dataDoctorEducationByIdAndEducation($doctor_id, $edit_doctor_education[$key]);
                                if ($data_education_by_id) {
                                    $is_exist = $key;
                                    $validation = ['edit_doctor_education.' . $key => 'Education already exist'];
                                    $session = $this->sessionMessage('error', 'Education already exist');
                                    $this->generalController->logUser('Create Education', 'Education already exist');
                                }
                            }
                            if ($is_exist == 0) {
                                if (!empty($edit_doctor_education)) {
                                    if (empty($doctor_education_id[$key])) {
                                        $data_education_insert = [
                                            'uuid' => $this->helperModel->generateUuid(),
                                            'doctor_uuid' => $doctor_id,
                                            'doctor_education' => $edit_doctor_education[$key],
                                            'doctor_education_location' => $edit_doctor_education_location[$key],
                                            'doctor_education_year' => $edit_doctor_education_year[$key],
                                            'created_at' => $this->dateTime(),
                                            'updated_at' => $this->dateTime(),
                                        ];
                                        $this->helperModel->insertData($data_education_insert, false, 'doctor_education_table');
                                    }
                                }
                            }
                        }
                    }
                }

                if (is_array($action_type_employment)) {
                    foreach ($action_type_employment as $key => $value_arr) {
                        if ($value_arr == 'edit_value') {
                            foreach ($data_employment as $key => $value_menu) {
                                if (is_array($doctor_employment_id) && in_array($value_menu['uuid'], $doctor_employment_id)) {
                                    $data_update = [
                                        'updated_at' => $this->dateTime(),
                                    ];

                                    $where = [
                                        'uuid' => $value_menu['uuid'],
                                    ];
                                    $this->helperModel::updateData($where, $data_update, 'doctor_employment_table');
                                } else {
                                    $where = 'uuid';
                                    $table = 'doctor_employment_table';
                                    $hard_delete = true;

                                    $data = [];

                                    $this->helperModel::deleteData($where, $value_menu['uuid'], $data, $table, $hard_delete);
                                }
                            }
                            $session = $this->sessionMessage('success', 'Doctor has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Doctor', 'Doctor has been updated');
                        }
                        $is_exist = 0;
                        if ($value_arr == 'add_value') {
                            if (empty($doctor_employment_id[$key])) {
                                $data_employment_by_id = $this->doctorModel::dataDoctorEmploymentByIdAndEmployment($doctor_id, $edit_doctor_employment[$key]);
                                if ($data_employment_by_id) {
                                    $is_exist = $key;
                                    $validation = ['edit_doctor_employment.' . $key => 'Employment already exist'];
                                    $session = $this->sessionMessage('error', 'Employment already exist');
                                    $this->generalController->logUser('Create Employment', 'Employment already exist');
                                }
                            }
                            if ($is_exist == 0) {
                                if (!empty($edit_doctor_employment)) {
                                    if (empty($doctor_employment_id[$key])) {
                                        $data_employment_insert = [
                                            'uuid' => $this->helperModel->generateUuid(),
                                            'doctor_uuid' => $doctor_id,
                                            'doctor_employment' => $edit_doctor_employment[$key],
                                            'doctor_employment_year' => $edit_doctor_employment_year[$key],
                                            'created_at' => $this->dateTime(),
                                            'updated_at' => $this->dateTime(),
                                        ];
                                        $this->helperModel->insertData($data_employment_insert, false, 'doctor_employment_table');
                                        $session = $this->sessionMessage('success', 'Doctor has been updated');
                                        $validation = null;
                                        $this->generalController->logUser('Edit Doctor', 'Doctor has been updated');
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $session = $this->sessionMessage('success', 'Doctor has been updated');
                    $validation = null;
                    $this->generalController->logUser('Edit Doctor', 'Doctor has been updated');
                }
            }

            $token = csrf_hash();

            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data_doctor'] = $data_doctor;
        $result['data_language'] = $data_language;
        $result['data_biography'] = $data_biography;
        $result['data_education'] = $data_education;
        $result['data_employment'] = $data_employment;
        $result['data_hospital'] = $data_hospital;
        $result['data_specialist'] = $data_specialist;
        $result['data_worktime'] = $data_worktime;

        return $this->response->setJSON($result);
    }

    // Doctor Specialist
    public function dataDoctorSpecialist()
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
        $data = $this->doctorModel::dataDoctorSpecialist($filter, $column, $orderDir, $fullData, $lang_code);

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

    public function searchDataDoctorSpecialist()
    {
        $search = $this->request->getVar('search');
        $data = null;
        if ($search) {
            $data = $this->doctorModel::dataDoctorSpecialist($search, 'doctor_specialist_id', 'asc', false, 'en');
        }
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function getDataDoctorSpecialistForTags()
    {
        $data = $this->doctorModel::dataDoctorSpecialist('', 'doctor_specialist_id', 'asc', false, 'en');
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function createDoctorSpecialist()
    {
        // $lang_code = $this->request->getVar('lang_code');
        $specialist_name = $this->request->getVar('specialist_name');
        // $specialist_desc = $this->request->getVar('specialist_desc');

        $language_list = $this->menuManagementModel::languageList();

        $rules = [
            'specialist_name' => [
                'label' => 'Specialist Name',
                'rules' => 'trim|required|is_unique[doctor_specialist_table.specialist_name]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Specialist Name is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ]
        ];

        foreach ($language_list as $key => $d) {
            $rules['specialist_desc_' . $d['lang_code']] = [
                'label' => 'Specialist Description',
                'rules' => 'trim|regex_match[^[^\']*$]',
                'errors' => [
                    'required' => 'The Specialist Description is required',
                    'regex_match' => 'No single quotes allowed',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        };

        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $specialist_name . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Specialist', 'Fail to insert data because field invalid');
        } else {
            $data_specialist = [
                'uuid' => $this->helperModel::generateUuid(),
                'specialist_name' => ucwords($specialist_name),
                // 'specialist_desc' => $specialist_desc,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                // 'lang_code' => strtolower($lang_code),
                'specialist_code' => $this->generateUniqueCharacter($specialist_name),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data_specialist, false, 'doctor_specialist_table');

            foreach ($language_list as $key => $d) {
                $specialist_desc = $this->request->getVar('specialist_desc_' . $d['lang_code']);
                if ($specialist_desc) {
                    $data_specialist_lang = [
                        'uuid' => $this->helperModel::generateUuid(),
                        'specialist_uuid' => $data_specialist['uuid'],
                        'specialist_desc' => $specialist_desc,
                        'lang_code' => $d['lang_code'],
                        'created_at' => $this->dateTime(),
                        'updated_at' => $this->dateTime()
                    ];
                    $this->helperModel::insertData($data_specialist_lang, false, 'doctor_specialist_desc_table');
                }
            }

            // Move Image
            $session = $this->sessionMessage('success', 'Specialist ' . $specialist_name . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Specialist', 'Specialist ' . $specialist_name . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editDoctorSpecialist()
    {
        $doctor_specialist_id = $this->request->getVar('doctor_specialist_id');
        $specialist_name = $this->request->getVar('edit_specialist_name');
        // $specialist_desc = $this->request->getVar('edit_specialist_desc');
        // $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');
        $language_list = $this->menuManagementModel::languageList();
        $data['specialist'] = $this->doctorModel::dataDoctorSpecialistById($doctor_specialist_id);
        $data['specialist_desc'] = $this->doctorModel::dataDoctorSpecialistDescById($doctor_specialist_id);

        if ($type != 'view') {
            $rules = [
                'edit_specialist_name' => [
                    'label' => 'Specialist Name',
                    'rules' => 'trim|required|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                    'errors' => [
                        'required' => 'The Specialist Name is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                // 'edit_specialist_desc' => [
                //     'label' => 'Specialist Description',
                //     'rules' => 'trim|required|min_length[4]|regex_match[^[^\']*$]',
                //     'errors' => [
                //         'required' => 'The Specialist Description is required',
                //         'regex_match' => 'Character alphabet only and no space in first or end letter',
                //         'trim' => 'Character has space in first or end letter',
                //     ]
                // ],
                // 'lang_code' => [
                //     'label' => 'Language',
                //     'rules' => 'trim|required|min_length[2]',
                //     'errors' => [
                //         'required' => 'The Language is required',
                //         'regex_match' => 'Character alphabet only and no space in first or end letter',
                //         'trim' => 'Character has space in first or end letter',
                //     ]
                // ]
            ];

            foreach ($language_list as $key => $d) {
                $rules['edit_specialist_desc_' . $d['lang_code']] = [
                    'label' => 'Specialist Description',
                    'rules' => 'trim|regex_match[^[^\']*$]',
                    'errors' => [
                        'required' => 'The Specialist Description is required',
                        'regex_match' => 'No single quotes allowed',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ];
            };

            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $specialist_name . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Update Specialist', 'Fail to update data because field invalid');
            } else {
                $data_specialist = [
                    'specialist_name' => ucwords($specialist_name),
                    // 'specialist_desc' => $specialist_desc,
                    'updated_at' => $this->dateTime(),
                    // 'lang_code' => strtolower($lang_code)
                ];

                $where = [
                    'uuid' => $doctor_specialist_id,
                ];

                $this->helperModel::updateData($where, $data_specialist, 'doctor_specialist_table');

                foreach ($language_list as $key => $d) {
                    $specialist_desc = $this->request->getVar('edit_specialist_desc_' . $d['lang_code']);
                    $cek_lang_code = $this->doctorModel::dataDoctorSpecialistDescByIdAndLangCode($doctor_specialist_id, $d['lang_code']);
                    if ($specialist_desc) {
                        if (!empty($cek_lang_code)) {
                            $data_specialist_desc = [
                                'specialist_desc' => $specialist_desc,
                                'updated_at' => $this->dateTime()
                            ];
                            $where = [
                                'specialist_uuid' => $doctor_specialist_id,
                                'lang_code' => $d['lang_code']
                            ];
                            $this->helperModel::updateData($where, $data_specialist_desc, 'doctor_specialist_desc_table');
                        } else {
                            $data_specialist_desc = [
                                'uuid' => $this->helperModel::generateUuid(),
                                'specialist_uuid' => $doctor_specialist_id,
                                'specialist_desc' => $specialist_desc,
                                'lang_code' => $d['lang_code'],
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime()
                            ];
                            $this->helperModel::insertData($data_specialist_desc, false, 'doctor_specialist_desc_table');
                        }
                    }
                }

                $session = $this->sessionMessage('success', 'Specialist ' . $specialist_name . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Update Specialist', 'Specialist ' . $specialist_name . ' has been updated');
            }

            $token = csrf_hash();

            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data;

        return $this->response->setJSON($result);
    }
}
