<?php

namespace App\Controllers\Cms\Settings;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\HelperModel;
use App\Models\Cms\Settings\MiscModel;
use App\Models\Cms\Pages\PagesModel;

class Misc extends BaseController
{
    protected $helperModel;
    protected $generalController;
    protected $miscModel;
    protected $pagesModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->miscModel = new MiscModel();
        $this->pagesModel = new PagesModel();
        $this->generalController = new General();
    }

    public function viewDataMisc()
    {
        $title = '';
        $lang_code = $this->request->getVar('lang_code');
        $misc = $this->miscModel::dataMisc($lang_code);
        $data_navbar = $this->pagesModel::dataPages('', 'navbar_management_id', 'ASC', false);

        $result['lang_code'] = $lang_code;
        $result['misc'] = $misc;
        $result['data_navbar'] = $data_navbar;

        $passData = $this->dataArrayForMethodLinks($title, $result);

        return  $this->generalController->links($passData);
    }

    public function createMisc()
    {
        $misc_default_language = $this->request->getVar('misc_default_language');
        $misc_logo = $this->request->getFile('misc_logo');
        $misc_logo_white = $this->request->getFile('misc_logo_white');
        $misc_logo_old = $this->request->getVar('misc_logo_old');
        $misc_logo_name = 'logo_' . $misc_default_language . '.' . $misc_logo->getClientExtension();
        $misc_logo_white_old = $this->request->getVar('misc_logo_white_old');
        $misc_logo_white_name = 'logo_white_' . $misc_default_language . '.' . $misc_logo_white->getClientExtension();
        $misc_emergency_number = $this->request->getVar('misc_emergency_number');
        $misc_fulltime_number = $this->request->getVar('misc_fulltime_number');
        $misc_email = $this->request->getVar('misc_email');
        $misc_footer_desc = $this->request->getVar('misc_footer_desc');
        $misc_work_days = $this->request->getVar('misc_work_days');
        $misc_work_time = $this->request->getVar('misc_work_time');
        $misc_address = $this->request->getVar('misc_address');
        $misc_facebook = $this->request->getVar('misc_facebook');
        $misc_twitter = $this->request->getVar('misc_twitter');
        $misc_instagram = $this->request->getVar('misc_instagram');
        $misc_navbar_management_uuid = $this->request->getVar('misc_navbar_management_uuid');
        $misc_navbar_management_name = $this->request->getVar('misc_navbar_management_name');

        $data_misc = $this->miscModel::dataMisc($misc_default_language);

        $values = '';
        if ($data_misc) {
            $values = 'trim|required';
            // $values_logo = ;
            // $values_logo_white = 'trim|max_size[misc_logo_white,1024]|mime_in[misc_logo_white,image/jpg,image/jpeg,image/png, image/webp]|is_image[misc_logo_white]';
        } else {
            $values = 'trim|required|is_unique[setting_misc_table.lang_code]';
            // $values_logo = 'trim|max_size[misc_logo,1024]|mime_in[misc_logo,image/jpg,image/jpeg,image/png, image/webp]|is_image[misc_logo]';
            // $values_logo_white = 'trim|max_size[misc_logo_white,1024]|mime_in[misc_logo_white,image/jpg,image/jpeg,image/png, image/webp]|is_image[misc_logo_white]';
        }

        $rules = [
            'misc_default_language' => [
                'label' => 'Language',
                'rules' => $values,
                'errors' => [
                    'required' => 'The Language is required',
                    'is_unique' => 'The Language is already exist',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_logo' => [
                'label' => 'Logo Header',
                'rules' => 'trim|max_size[misc_logo,1024]|mime_in[misc_logo,image/jpg,image/jpeg,image/png, image/webp]|is_image[misc_logo]',
                'errors' => [
                    'uploaded' => 'No file on Logo Header',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'misc_logo_white' => [
                'label' => 'Logo Footer',
                'rules' => 'trim|max_size[misc_logo_white,1024]|mime_in[misc_logo_white,image/jpg,image/jpeg,image/png, image/webp]|is_image[misc_logo_white]',
                'errors' => [
                    'uploaded' => 'No file on Logo Footer',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp'
                ]
            ],
            'misc_emergency_number' => [
                'label' => 'Emergency Number',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Emergency Number is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_fulltime_number' => [
                'label' => '24 Hours Number',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The 24 Hours Number is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_email' => [
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'The Email is required',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_footer_desc' => [
                'label' => 'Footer Description',
                'rules' => 'trim|required|min_length[50]|regex_match[/^[A-Za-z&0-9]+(?: [A-Za-z&0-9]+)*$/]',
                'errors' => [
                    'required' => 'The Footer Description is required',
                    'regex_match' => 'No quotes symbol and any simbol except &',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_work_days' => [
                'label' => 'Work Days',
                'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z&0-9]+(?: [A-Za-z&0-9]+)*$/]',
                'errors' => [
                    'required' => 'The Work Days is required',
                    'regex_match' => 'No quotes symbol and any simbol except &',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_work_time' => [
                'label' => 'Work Time',
                'rules' => 'trim|required|min_length[3]|regex_match[/^[A-Za-z&0-9]+(?: [A-Za-z&0-9]+)*$/]',
                'errors' => [
                    'required' => 'The Work Time is required',
                    'regex_match' => 'No quotes symbol and any simbol except &',
                    'trim' => 'Character has space in first or end letter',
                ]
            ],
            'misc_address' => [
                'label' => 'Address',
                'rules' => 'trim|required|min_length[10]|regex_match[/^[A-Za-z&0-9]+(?: [A-Za-z&0-9]+)*$/]',
                'errors' => [
                    'required' => 'The Address is required',
                    'regex_match' => 'No quotes symbol and any simbol except &',
                    'trim' => 'Character has space in first or end letter',
                ]
            ]
        ];

        foreach ($misc_navbar_management_uuid as $key => $value) {

            $rules['misc_whatsapp_' . $misc_navbar_management_name[$key]] = [
                'label' => 'Whatsapp',
                'rules' => 'trim|required|regex_match[/^[0-9]+$/]',
                'errors' => [
                    'required' => 'The Whatsapp is required',
                    'regex_match' => 'Character number only',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];

            $rules['misc_meta_desc_' . $misc_navbar_management_name[$key]] = [
                'label' => 'Meta Description',
                'rules' => 'trim|required|min_length[50]|regex_match[/^[A-Za-z&0-9]+(?: [A-Za-z&0-9]+)*$/]',
                'errors' => [
                    'required' => 'The Meta Description is required',
                    'regex_match' => 'No quotes symbol and any simbol except &',
                    'trim' => 'Character has space in first or end letter',
                ]
            ];
        }

        $session = null;
        // $validation = null;
        if (!$this->validate($rules)) {
            $session = $this->sessionMessage('error', "Oops, something went wrong when create " . $misc_default_language . " please check your input again");
            // $validation = validation_errors();
            $this->generalController->logUser('Create Language', 'Fail to insert data because field invalid');
            session()->getFlashdata('notif', $session);
            return redirect()->to('/setting/misc?lang_code=' . $misc_default_language)->withInput();
        }

        if (!$data_misc) {
            $data_misc_insert = [
                'uuid' => $this->helperModel::generateUuid(),
                'lang_code' => $misc_default_language,
                'misc_logo' => $misc_logo_name,
                'misc_logo_white' => $misc_logo_white_name,
                'misc_emergency_number' => $misc_emergency_number,
                'misc_fulltime_number' => $misc_fulltime_number,
                'footer_desc' => $misc_footer_desc,
                'work_days' => $misc_work_days,
                'work_time' => $misc_work_time,
                'address' => $misc_address,
                'email' => $misc_email,
                'facebook_link' => $misc_facebook,
                'twitter_link' => $misc_twitter,
                'instagram_link' => $misc_instagram,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];

            $this->helperModel::insertData($data_misc_insert, false, 'setting_misc_table');

            $misc_logo->move('assets/website/images', $misc_logo_name);
            $misc_logo_white->move('assets/website/images', $misc_logo_white_name);
        } else {
            $data_misc_update = [
                'misc_logo' => $misc_logo_name,
                'misc_logo_white' => $misc_logo_white_name,
                'misc_emergency_number' => $misc_emergency_number,
                'misc_fulltime_number' => $misc_fulltime_number,
                'footer_desc' => $misc_footer_desc,
                'work_days' => $misc_work_days,
                'work_time' => $misc_work_time,
                'address' => $misc_address,
                'email' => $misc_email,
                'facebook_link' => $misc_facebook,
                'twitter_link' => $misc_twitter,
                'instagram_link' => $misc_instagram,
                'updated_at' => $this->dateTime()
            ];

            $where = [
                'lang_code' => $misc_default_language,
            ];
            $this->helperModel::updateData($where, $data_misc_update, 'setting_misc_table');

            if ($misc_logo->getError() == 4) {
                // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
                $misc_logo_name = $misc_logo_old;
            } else {
                if ($misc_logo_old != 'logo_icon.png') {
                    // Random Name
                    $this->unlinkImage('assets/website/images/' . $misc_logo_old);
                    // Move Image
                    $misc_logo->move('assets/website/images', $misc_logo_name);
                } else {
                    // Move Image
                    $misc_logo->move('assets/website/images', $misc_logo_name);
                }
            }

            if ($misc_logo_white->getError() == 4) {
                // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
                $misc_logo_white_name = $misc_logo_white_old;
            } else {
                if ($misc_logo_white_old != 'logo_white.png') {
                    // Random Name
                    $this->unlinkImage('assets/website/images/' . $misc_logo_white_old);
                    // Move Image
                    $misc_logo_white->move('assets/website/images', $misc_logo_white_name);
                } else {
                    // Move Image
                    $misc_logo_white->move('assets/website/images', $misc_logo_white_name);
                }
            }
        }

        foreach ($misc_navbar_management_uuid as $key => $value) {
            $data_navbar_update = [
                'navbar_management_whatsapp' => $this->request->getVar('misc_whatsapp_' . $misc_navbar_management_name[$key]),
                'navbar_management_meta_desc' => $this->request->getVar('misc_meta_desc_' . $misc_navbar_management_name[$key]),
                'updated_at' => $this->dateTime()
            ];

            $where = [
                'lang_code' => $misc_default_language,
                'uuid' => $value,
            ];
            $this->helperModel::updateData($where, $data_navbar_update, 'page_navbar_table');
        }

        return redirect()->to('/setting/misc?lang_code=' . $misc_default_language);
    }
}
