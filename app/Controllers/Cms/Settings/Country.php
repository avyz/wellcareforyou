<?php

namespace App\Controllers\Cms\Settings;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Settings\CountryModel;

class Country extends BaseController
{
    protected $countryModel;
    protected $helperModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->countryModel = new CountryModel();
        $this->generalController = new General();
    }

    public function dataCountry()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->countryModel::dataCountry($filter, $column, $orderDir, $fullData);

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

    public function searchDataCountry()
    {
        $search = $this->request->getVar('search');
        $data = null;
        if ($search) {
            $data = $this->countryModel::dataCountry($search, 'country_id', 'asc', false);
        }
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function getDataCountryForTags()
    {
        $data = $this->countryModel::dataCountry('', 'country_id', 'asc', false);
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function createCountry()
    {
        $country = $this->request->getVar('country');
        $country_code = $this->request->getVar('country_code');
        $data_country_icon = $this->request->getFile('data_country_icon');
        $data_country_icon_name = 'flag-icon-' . url_title($country, '-', true) . '.' . $data_country_icon->getClientExtension();

        $rules = [
            'country' => [
                'label' => 'Country',
                'rules' => 'trim|required|is_unique[country_table.country]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Country is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'data_country_icon' => [
                'label' => 'Country Icon',
                'rules' => 'trim|max_size[data_country_icon,1024]|mime_in[data_country_icon,image/jpg,image/jpeg,image/png, image/webp]|is_image[data_country_icon]',
                'errors' => [
                    'uploaded' => 'No file on Country Icon',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'country_code' => [
                'label' => 'Country Code',
                'rules' => 'trim|required|is_unique[country_table.country_code]|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Country Code is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ]
        ];

        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $country . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Country', 'Fail to insert data because field invalid');
        } else {
            $data_country = [
                'uuid' => $this->helperModel::generateUuid(),
                'country_code' => strtolower($country_code),
                'country' => ucwords($country),
                'country_icon' => $data_country_icon_name,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data_country, false, 'country_table');

            // Move Image
            $data_country_icon->move('assets/website/images/country', $data_country_icon_name);
            $session = $this->sessionMessage('success', 'Country ' . $country . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Country', 'Country ' . $country . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editCountry()
    {
        $edit_country = $this->request->getVar('edit_country');
        $type = $this->request->getVar('type');
        $country_id = $this->request->getVar('country_id');
        $edit_country_code = $this->request->getVar('edit_country_code');
        $edit_data_country_icon = $this->request->getFile('edit_data_country_icon');
        // $match_value_country_icon = $this->request->getVar('match_value_country_icon');

        $edit_old_country_icon = $this->request->getVar('edit_old_country_icon');
        // if (!$edit_data_country_icon) {
        //     $edit_data_country_icon = $edit_old_country_icon;
        // }
        $data_country = $this->countryModel::dataCountryByCountryUuid($country_id);

        $edit_data_country_icon_name = null;

        if ($type != 'view') {
            $token = csrf_hash();

            // if (isset($match_value_country_icon) != isset($edit_old_country_icon)) {
            // } else {
            //     $edit_data_country_icon_name = $edit_old_country_icon;
            // };
            // dd($edit_data_country_icon_name);
            $value_country = "";
            if ($data_country['country'] == $edit_country) {
                $value_country = 'trim|required|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value_country = 'trim|required|is_unique[country_table.country]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $value_country_code = "";
            if ($data_country['country_code'] == $edit_country_code) {
                $value_country_code = 'trim|required|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value_country_code = 'trim|required|is_unique[country_table.country_code]|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_country' => [
                    'label' => 'Country',
                    'rules' => $value_country,
                    'errors' => [
                        'required' => 'The Country is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_data_country_icon' => [
                    'label' => 'Country Icon',
                    'rules' => 'trim|max_size[edit_data_country_icon,1024]|mime_in[edit_data_country_icon,image/jpg,image/jpeg,image/png, image/webp]|is_image[edit_data_country_icon]',
                    'errors' => [
                        'uploaded' => 'No file on Country Icon',
                        'max_size' => 'Image must less than 1mb',
                        'is_image' => 'Image not valid',
                        'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                    ]
                ],
                'edit_country_code' => [
                    'label' => 'Country Code',
                    'rules' => $value_country_code,
                    'errors' => [
                        'required' => 'The Country Code is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ]
            ];

            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_country . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Country', 'Fail to update because field invalid');
                // session()->setFlashdata('notif', $session);
                // return redirect()->back()->withInput();
            } else {
                if ($edit_data_country_icon->getClientExtension()) {
                    $edit_data_country_icon_name = 'flag-icon-' . url_title($edit_country, '-', true) . '.' . $edit_data_country_icon->getClientExtension();
                } else {
                    $edit_data_country_icon_name = $edit_old_country_icon;
                }
                $data_role_input = [
                    'country_code' => $edit_country_code,
                    'country' => ucwords($edit_country),
                    'country_icon' => $edit_data_country_icon_name,
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $country_id,
                ];
                $this->helperModel::updateData($where, $data_role_input, 'country_table');

                if (!$edit_data_country_icon->getClientExtension()) {
                    // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
                    $edit_data_country_icon_name = $edit_old_country_icon;
                } else {
                    // Random Name
                    $this->unlinkImage('assets/website/images/country/' . $edit_old_country_icon);
                    // Move Image
                    $edit_data_country_icon->move('assets/website/images/country', $edit_data_country_icon_name);
                }

                $session = $this->sessionMessage('success', 'Country ' . $data_country['country'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit Country', 'Country ' . $data_country['country'] . ' has been updated');
                // session()->setFlashdata('notif', $session);
                // dd("masuk");
                // return redirect()->back();
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data_country;

        return $this->response->setJSON($result);
    }
}
