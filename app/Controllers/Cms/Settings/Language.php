<?php

namespace App\Controllers\Cms\Settings;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Settings\LanguageModel;

class Language extends BaseController
{
    protected $languageModel;
    protected $helperModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->languageModel = new LanguageModel();
        $this->generalController = new General();
    }

    public function dataLanguage()
    {
        $draw = $this->request->getVar('draw');
        $length = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $filter = $this->request->getVar('search')['value'];
        $orderColumn = $this->request->getVar('order')[0]['column'];
        $column = $this->request->getVar('columns')[$orderColumn]['data'];
        $orderDir = $this->request->getVar('order')[0]['dir'];

        $fullData = true;
        $data = $this->languageModel::dataLanguage($filter, $column, $orderDir, $fullData);

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

    public function searchDataLanguage()
    {
        $search = $this->request->getVar('search');
        $data = null;
        if ($search) {
            $data = $this->languageModel::dataLanguage($search, 'lang_id', 'asc', false);
        }
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function getDataLanguageForTags()
    {
        $data = $this->languageModel::dataLanguage('', 'lang_id', 'asc', false);
        $result['data'] = $data;
        $result['token'] = csrf_hash();
        return $this->response->setJSON($result);
    }

    public function createLanguage()
    {
        $language = $this->request->getVar('language');
        $lang_code = $this->request->getVar('lang_code');
        $data_lang_icon = $this->request->getFile('data_lang_icon');
        $data_lang_icon_name = url_title($language, '-', true) . '.' . $data_lang_icon->getClientExtension();

        $rules = [
            'language' => [
                'label' => 'Language',
                'rules' => 'trim|required|is_unique[lang_table.language]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Language is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'data_lang_icon' => [
                'label' => 'Lang Icon',
                'rules' => 'trim|max_size[data_lang_icon,1024]|mime_in[data_lang_icon,image/jpg,image/jpeg,image/png, image/webp]|is_image[data_lang_icon]',
                'errors' => [
                    'uploaded' => 'No file on Lang Icon',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'lang_code' => [
                'label' => 'Language Code',
                'rules' => 'trim|required|is_unique[lang_table.lang_code]|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]',
                'errors' => [
                    'required' => 'The Language Code is required',
                    'regex_match' => 'Character alphabet only and no space in first or end letter',
                    'trim' => 'Character has space in first or end letter',
                ]
            ]
        ];

        $session = null;
        $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $language . " please check your input again");
            $validation = validation_errors();
            $this->generalController->logUser('Create Language', 'Fail to insert data because field invalid');
        } else {
            $data_lang = [
                'uuid' => $this->helperModel::generateUuid(),
                'lang_code' => strtolower($lang_code),
                'language' => ucwords($language),
                'lang_icon' => $data_lang_icon_name,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'is_active' => 1
            ];
            $this->helperModel::insertData($data_lang, false, 'lang_table');

            // Move Image
            $data_lang_icon->move('assets/website/images/lang', $data_lang_icon_name);
            $session = $this->sessionMessage('success', 'Language ' . $language . ' has been created');
            $validation = null;
            $this->generalController->logUser('Create Language', 'Language ' . $language . ' has been created');
        }

        $token = csrf_hash();

        $result['notification'] = $session;
        $result['validation'] = $validation;
        $result['token'] = $token;

        return $this->response->setJSON($result);
    }

    public function editLanguage()
    {
        $edit_language = $this->request->getVar('edit_language');
        $type = $this->request->getVar('type');
        $lang_id = $this->request->getVar('lang_id');
        $edit_lang_code = $this->request->getVar('edit_lang_code');
        $edit_data_lang_icon = $this->request->getFile('edit_data_lang_icon');
        // $match_value_lang_icon = $this->request->getVar('match_value_lang_icon');

        $edit_old_lang_icon = $this->request->getVar('edit_old_lang_icon');
        // if (!$edit_data_lang_icon) {
        //     $edit_data_lang_icon = $edit_old_lang_icon;
        // }
        $data_lang = $this->languageModel::dataLanguageByLangUuid($lang_id);

        $edit_data_lang_icon_name = null;

        if ($type != 'view') {
            $token = csrf_hash();

            // if (isset($match_value_lang_icon) != isset($edit_old_lang_icon)) {
            // } else {
            //     $edit_data_lang_icon_name = $edit_old_lang_icon;
            // };
            // dd($edit_data_lang_icon_name);
            $value_language = "";
            if ($data_lang['language'] == $edit_language) {
                $value_language = 'trim|required|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value_language = 'trim|required|is_unique[lang_table.language]|min_length[4]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $value_lang_code = "";
            if ($data_lang['lang_code'] == $edit_lang_code) {
                $value_lang_code = 'trim|required|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            } else {
                $value_lang_code = 'trim|required|is_unique[lang_table.lang_code]|min_length[2]|regex_match[/^[A-Za-z]+(?: [A-Za-z]+)*$/]';
            }

            $rules = [
                'edit_language' => [
                    'label' => 'Language',
                    'rules' => $value_language,
                    'errors' => [
                        'required' => 'The Language is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ],
                'edit_data_lang_icon' => [
                    'label' => 'Lang Icon',
                    'rules' => 'trim|max_size[edit_data_lang_icon,1024]|mime_in[edit_data_lang_icon,image/jpg,image/jpeg,image/png, image/webp]|is_image[edit_data_lang_icon]',
                    'errors' => [
                        'uploaded' => 'No file on Lang Icon',
                        'max_size' => 'Image must less than 1mb',
                        'is_image' => 'Image not valid',
                        'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                    ]
                ],
                'edit_lang_code' => [
                    'label' => 'Language Code',
                    'rules' => $value_lang_code,
                    'errors' => [
                        'required' => 'The Language Code is required',
                        'regex_match' => 'Character alphabet only and no space in first or end letter',
                        'trim' => 'Character has space in first or end letter',
                    ]
                ]
            ];

            $session = null;
            $validation = null;
            if (!$this->validate($rules)) {
                $session = $this->sessionMessage('error', "Oops, something went wrong when update " . $edit_language . " please check your input again");
                $validation = validation_errors();
                $this->generalController->logUser('Edit Language', 'Fail to update because field invalid');
                // session()->setFlashdata('notif', $session);
                // return redirect()->back()->withInput();
            } else {
                if ($edit_data_lang_icon->getClientExtension()) {
                    $edit_data_lang_icon_name = 'flag-icon-' . url_title($edit_language, '-', true) . '.' . $edit_data_lang_icon->getClientExtension();
                } else {
                    $edit_data_lang_icon_name = $edit_old_lang_icon;
                }
                $data_role_input = [
                    'lang_code' => $edit_lang_code,
                    'language' => ucwords($edit_language),
                    'lang_icon' => $edit_data_lang_icon_name,
                    'updated_at' => $this->dateTime(),
                ];

                $where = [
                    'uuid' => $lang_id,
                ];
                $this->helperModel::updateData($where, $data_role_input, 'lang_table');

                if (!$edit_data_lang_icon->getClientExtension()) {
                    // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
                    $edit_data_lang_icon_name = $edit_old_lang_icon;
                } else {
                    // Random Name
                    $this->unlinkImage('assets/website/images/lang/' . $edit_old_lang_icon);
                    // Move Image
                    $edit_data_lang_icon->move('assets/website/images/lang', $edit_data_lang_icon_name);
                }

                $session = $this->sessionMessage('success', 'Language ' . $data_lang['language'] . ' has been updated');
                $validation = null;
                $this->generalController->logUser('Edit Language', 'Language ' . $data_lang['language'] . ' has been updated');
                // session()->setFlashdata('notif', $session);
                // dd("masuk");
                // return redirect()->back();
            }
            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data'] = $data_lang;

        return $this->response->setJSON($result);
    }
}
