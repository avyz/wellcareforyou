<?php

namespace App\Controllers\Cms\General;

use App\Controllers\BaseController;
use App\Models\Cms\MenuManagement\MenuManagementModel;
use App\Models\Cms\UserManagement\UserManagementModel;
use App\Models\Cms\Settings\LanguageModel;
use App\Models\Cms\Settings\CountryModel;
use App\Models\Cms\Pages\PagesModel;
use App\Models\Cms\Pages\GroupPagesModel;
use App\Models\Cms\Users\UsersModel;
use App\Models\Cms\Hospital\HospitalModel;
use App\Models\Cms\Doctor\DoctorModel;
use App\Models\Cms\Settings\MiscModel;
use App\Models\HelperModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use App\Filters\CanViewFilters;

class General extends BaseController
{

    protected $helperModel;
    protected $menuManagementModel;
    protected $userManagementModel;
    protected $userModel;
    protected $languageModel;
    protected $countryModel;
    protected $pagesModel;
    protected $groupPagesModel;
    protected $hospitalModel;
    protected $doctorModel;
    protected $miscModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->menuManagementModel = new MenuManagementModel();
        $this->userManagementModel = new UserManagementModel();
        $this->userModel = new UsersModel();
        $this->languageModel = new LanguageModel();
        $this->countryModel = new CountryModel();
        $this->pagesModel = new PagesModel();
        $this->groupPagesModel = new GroupPagesModel();
        $this->hospitalModel = new HospitalModel();
        $this->doctorModel = new doctorModel();
        $this->miscModel = new miscModel();
    }

    public function generalView(...$params)
    {
        $uri = service('uri');
        $dataParams = $params[0];
        // dd($this->helperModel::generateUuid());
        if ($dataParams['data']['dataMenu']) {

            // $lang_code = $this->request->getVar('lang');
            $role_id = session()->get('role_id');

            $filter = new CanViewFilters();

            $request = service('request');
            $response = $filter->before($request);

            if ($response instanceof \CodeIgniter\HTTP\ResponseInterface) {
                return $response;
            }

            // dd($dataParams);
            // $language_for_user = $this->request->getVar('language');
            // dd($language_for_user);
            // if (session()->get('is_master') == 1) {
            //     $dataParams['lang_code'] == $language_for_user;
            // } else {
            //     $dataParams['lang_code'] == 'en';
            // }

            $data = [
                'layout' => $this->dirLayoutCms,
                'section' => $this->dirSectionCms,
                'idleTime' => $this->timeIdle,
                'sidebar' => $this->menuManagementModel::sidebar($role_id, $dataParams['lang_code']),
                'dataMenu' => $dataParams['data']['dataMenu'],
                'breadcrumbs' => $this->menuManagementModel::breadCrumbsBySlug(),
                'language_row' => $this->menuManagementModel::languageByLangCode($dataParams['lang_code']),
                'language_list' => $this->menuManagementModel::languageList(),
                'country_list' => $this->countryModel::countryList(),
            ];

            if (session()->get('is_master') == 0) {
                $data['misc'] = $this->miscModel::dataMisc($dataParams['lang_code_website']);
                $data['navbar'] = $this->pagesModel::dataArrayPageNavbarByLangCode($dataParams['lang_code_website']);
                $data['lang_code'] = $this->menuManagementModel::languageByLangCode($dataParams['lang_code_website'])['lang_code'];
                $data['data']['type'] = 'view';
            }

            $path = '';
            $title = null;
            if ($data['dataMenu']) {
                if (count($data['dataMenu']['sidebar']) == 0) {
                    $menu_url = $data['dataMenu']['menu']['menu_url'];
                    $path = $menu_url . '/' . 'body';
                    $title = $data['dataMenu']['menu']['menu_name'];
                } else {
                    $menu_url = $data['dataMenu']['sidebar'][0]['menu_children_url'];
                    $path = $menu_url;
                    if ($data['dataMenu']['sidebar'][0]['menu_children_name'] != $data['dataMenu']['menu']['menu_name']) {
                        $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $data['dataMenu']['sidebar'][0]['menu_children_name'];
                    } else {
                        $title = $data['dataMenu']['menu']['menu_name'];
                    }
                }


                if ($menu_url == $uri->getPath()) {
                    session()->set('last_url', $menu_url);
                    $data['title'] = $title;
                    // dd($data);

                    $this->logUser('Access ' . $title, 'Access ' . $title . ' page successfully');

                    return $this->checkIdle(view('cms' . $path, $data));
                } else {
                    $this->logUser('Access not found', 'Page ' . $uri->getPath() . ' is not found');

                    throw new \CodeIgniter\Exceptions\PageNotFoundException("Not Found");
                }
            }
            $this->logUser('Access menu', 'User try to access ' . $uri->getPath() . ' , but is not found, user redirected to home');

            return redirect()->to('/login');
        } else {
            // dd($dataParams);
            if (is_array($dataParams) && isset($dataParams)) {

                if ($uri->getPath() == '/') {
                    $segment_uri = '/';
                } else {
                    $segment_uri = '/' . $uri->getSegment(1);
                }

                $data = [
                    'layout' => $this->dirLayoutWebsite,
                    'section' => $this->dirSectionWebsite,
                    'idleTime' => $this->timeIdle,
                    // 'title' => $dataParams['title'],
                    'misc' => $this->miscModel::dataMisc($dataParams['lang_code_website']),
                    'navbar' => $this->pagesModel::dataArrayPageNavbarByLangCode($dataParams['lang_code_website']),
                    'page_navbar' => $this->pagesModel::dataPageNavbarByLangCode($dataParams['lang_code_website'], $segment_uri),
                    'language_list' => $this->menuManagementModel::languageList(),
                    'language_row' => $this->menuManagementModel::languageByLangCode($dataParams['lang_code_website']),
                    'country_list' => $this->countryModel::countryList()
                ];

                // dd($dataParams['lang_code_website']);
                // dd($data['page_navbar']);

                if (isset($dataParams['data']) && isset($data['page_navbar'])) {
                    $page_table = $this->pagesModel->dataPagesWebsiteByNavbarId($dataParams['data']['nid'], $data['language_row']['lang_code']);

                    $arr_page_section = [];
                    $arr_pages = [];
                    foreach ($page_table as $keyp => $value) {
                        $section = $keyp + 1;
                        $page_section = $this->pagesModel->dataPagesSectionWebsiteByNavbarId($dataParams['data']['nid'], $data['language_row']['lang_code'], $section);
                        if ($page_section) {
                            $arr_page_section[] =  [
                                'uuid' => $page_section['uuid'],
                                'navbar_uuid' => $page_section['navbar_uuid'],
                                'section' => $page_section['section'],
                                'title' => $page_section['title'],
                                'optional_title' => $page_section['optional_title'],
                                'subtitle' => $page_section['subtitle'],
                                'page_image' => $page_section['page_image'],
                                'paragraph' => $page_section['paragraph'],
                                'lang_code' => $page_section['lang_code'],
                                'button' => $this->pagesModel->dataPagesButtonWebsiteByPageId($page_section['uuid']),
                                'grid' => [],
                                'image' => [],
                            ];



                            $grid = $this->pagesModel->dataPagesGridWebsiteByPageId($page_section['uuid']);
                            // $arr_grid_urutan = [];
                            if ($grid) {
                                foreach ($grid as $key => $value) {
                                    $arr_page_section[$keyp]['grid'][] = [
                                        'uuid' => $value['uuid'],
                                        'page_uuid' => $value['page_uuid'],
                                        'image' => $value['image'],
                                        'title' => $value['title'],
                                        'paragraph' => $value['paragraph'],
                                        'urutan' => $value['urutan'],
                                    ];
                                };
                            }

                            $image = $this->pagesModel->dataPagesImageWebsiteByPageId($page_section['uuid']);
                            // $arr_image_urutan = [];
                            if ($image) {
                                foreach ($image as $key => $value) {
                                    $arr_page_section[$keyp]['image'][] = [
                                        'uuid' => $value['uuid'],
                                        'page_uuid' => $value['page_uuid'],
                                        'title' => $value['title'],
                                        'page_image' => $value['page_image'],
                                        'page_image_urutan' => $value['page_image_urutan']
                                    ];
                                };
                            }
                        }
                    };
                    // d($arr_page_section);
                    // die;

                    $arr_page_section = array_values($arr_page_section);
                    $data['page'] = $arr_page_section;
                    $data['data'] = $dataParams['data'];
                    $data['lang_code'] = $data['language_row']['lang_code'];
                    $data['title'] = $data['page_navbar']['navbar_management_name'];
                    // $path = $dataParams['data']['path'];
                    // $breadcrumbs = [
                    //     [
                    //         'segment' => $data['page_navbar']['navbar_management_name'],
                    //         'url' => 'javascript:void(0)',
                    //         'is_active' => '0'
                    //     ]
                    // ];

                    // if ($dataParams['data']['arr_breadcrumbs']) {
                    //     foreach ($dataParams['data']['arr_breadcrumbs'] as $key => $value) {
                    //         $breadcrumbs[] = [
                    //             'segment' => $value['segment'],
                    //             'url' => $value['url'],
                    //             'is_active' => $value['is_active']
                    //         ];
                    //     }
                    // }

                    // dd("masuk");

                    $data['breadcrumbs'] = $this->menuManagementModel::breadCrumbsBySlug();

                    // dd($data);

                    $this->logUser('Access ' . $data['title'], 'Access ' . $data['title'] . ' page successfully');
                    if (session()->get('role_id')) {
                        return $this->checkIdle(view('website/' . $data['page_navbar']['to_page'] . '/body', $data));
                    } else {
                        return view('website/' . $data['page_navbar']['to_page'] . '/body', $data);
                    }
                }
            }
            $this->logUser('Access page', 'User try to access a page but is not found, user redirected to home');

            throw new \CodeIgniter\Exceptions\PageNotFoundException("Not Found");
        }
    }

    public function links(...$params)
    {
        // dd($this->helperModel::generateUuid());
        $dataParams = $params[0];
        $uri = service('uri');
        if (is_array($dataParams) && isset($dataParams)) {
            $role_id = session()->get('role_id');
            $lang_code = $dataParams['lang_code'];
            $data = [
                'layout' => $this->dirLayoutCms,
                'section' => $this->dirSectionCms,
                'idleTime' => $this->timeIdle,
                'sidebar' => $this->menuManagementModel::sidebar($role_id, $lang_code),
                'dataMenu' => $this->menuManagementModel::menuAksesBySlug($uri->getSegment(1), $lang_code, $role_id),
                'breadcrumbs' => $this->menuManagementModel::breadCrumbsBySlug(),
                'language_row' => $this->menuManagementModel::languageByLangCode($lang_code),
                'language_list' => $this->menuManagementModel::languageList(),
                'country_list' => $this->countryModel::countryList()
            ];

            if (isset($dataParams['data'])) {
                $data['data'] = $dataParams['data'];
            }

            if (session()->get('is_master') == 0) {
                $data['misc'] = $this->miscModel::dataMisc($dataParams['lang_code_website']);
                $data['navbar'] = $this->pagesModel::dataArrayPageNavbarByLangCode($dataParams['lang_code_website']);
                $data['lang_code'] = $this->menuManagementModel::languageByLangCode($dataParams['lang_code_website'])['lang_code'];
                $data['data']['type'] = 'view';
            }

            // dd($uri->getSegment(1));

            $title = null;
            if (isset($data['dataMenu']['sidebar'])) {
                if (count($data['dataMenu']['sidebar']) == 0) {
                    $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $dataParams['title'];
                } else {
                    if ($dataParams['title'] != '') {
                        if ($data['dataMenu']['sidebar'][0]['menu_children_name'] != $data['dataMenu']['menu']['menu_name']) {
                            $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $data['dataMenu']['sidebar'][0]['menu_children_name'] . ' | ' . $dataParams['title'];
                        } else {
                            $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $dataParams['title'];
                        }
                    } else {
                        if ($data['dataMenu']['sidebar'][0]['menu_children_name'] != $data['dataMenu']['menu']['menu_name']) {
                            $title = $data['dataMenu']['menu']['menu_name'] . ' | ' . $data['dataMenu']['sidebar'][0]['menu_children_name'];
                        } else {
                            $title = $data['dataMenu']['menu']['menu_name'];
                        }
                    }
                }
            }

            $data['title'] = $title;

            $this->logUser('Access ' . $title, 'Access ' . $title . ' page successfully');

            // dd('cms' . $uri->getPath(), $data);
            session()->set('last_url', $uri->getPath());
            return $this->checkIdle(view('cms' . $uri->getPath(), $data));
        }
        $this->logUser('Access page', 'User try to access ' . $uri->getPath() . ' , but is not found, user redirected to home');

        throw new \CodeIgniter\Exceptions\PageNotFoundException("Not Found");
    }

    public function linksWebsite(...$params)
    {
        $dataParams = $params[0];
        // dd($dataParams);
        $uri = service('uri');
        if (is_array($dataParams) && isset($dataParams)) {

            if ($uri->getPath() == '/') {
                $segment_uri = '/';
            } else {
                $segment_uri = '/' . $uri->getSegment(1);
            }

            $data = [
                'layout' => $this->dirLayoutWebsite,
                'section' => $this->dirSectionWebsite,
                'idleTime' => $this->timeIdle,
                // 'title' => $dataParams['title'],
                'misc' => $this->miscModel::dataMisc($dataParams['lang_code']),
                'navbar' => $this->pagesModel::dataArrayPageNavbarByLangCode($dataParams['lang_code']),
                'page_navbar' => $this->pagesModel::dataPageNavbarByLangCode($dataParams['lang_code'], $segment_uri),
                'language_list' => $this->menuManagementModel::languageList(),
                'language_row' => $this->menuManagementModel::languageByLangCode($dataParams['lang_code']),
                'country_list' => $this->countryModel::countryList()
            ];

            // dd($dataParams['lang_code']);
            // dd($data['navbar']);

            if (isset($dataParams['data']) && isset($data['page_navbar'])) {
                $page_table = $this->pagesModel->dataPagesWebsiteByNavbarId($dataParams['data']['nid'], $data['language_row']['lang_code']);

                $arr_page_section = [];
                foreach ($page_table as $keyp => $value) {
                    $section = $keyp + 1;
                    $page_section = $this->pagesModel->dataPagesSectionWebsiteByNavbarId($dataParams['data']['nid'], $data['language_row']['lang_code'], $section);
                    if ($page_section) {

                        $arr_page_section = [
                            $keyp => [
                                'uuid' => $page_section['uuid'],
                                'navbar_uuid' => $page_section['navbar_uuid'],
                                'section' => $page_section['section'],
                                'title' => $page_section['title'],
                                'optional_title' => $page_section['optional_title'],
                                'subtitle' => $page_section['subtitle'],
                                'paragraph' => $page_section['paragraph'],
                                'lang_code' => $page_section['lang_code'],
                                'button' => $this->pagesModel->dataPagesButtonWebsiteByPageId($page_section['uuid']),
                                'grid' => [],
                                'image' => [],
                            ],
                        ];

                        $grid = $this->pagesModel->dataPagesGridWebsiteByPageId($page_section['uuid']);
                        // $arr_grid_urutan = [];
                        if ($grid) {
                            foreach ($grid as $key => $value) {
                                $arr_page_section[$keyp]['grid'][] = [
                                    'uuid' => $value['uuid'],
                                    'page_uuid' => $value['page_uuid'],
                                    'image' => $value['image'],
                                    'title' => $value['title'],
                                    'paragraph' => $value['paragraph'],
                                    'urutan' => $value['urutan'],
                                ];
                            };
                        }

                        $image = $this->pagesModel->dataPagesImageWebsiteByPageId($page_section['uuid']);
                        // $arr_image_urutan = [];
                        if ($image) {
                            foreach ($image as $key => $value) {
                                $arr_page_section[$keyp]['image'][] = [
                                    'uuid' => $value['uuid'],
                                    'page_uuid' => $value['page_uuid'],
                                    'title' => $value['title'],
                                    'page_image' => $value['page_image'],
                                    'page_image_urutan' => $value['page_image_urutan']
                                ];
                            };
                        }
                    }
                };

                $arr_page_section = array_values($arr_page_section);
                $data['page'] = $arr_page_section;
                $data['data'] = $dataParams['data'];
                $data['lang_code'] = $dataParams['lang_code'];
                $data['title'] = $data['page_navbar']['navbar_management_name'];

                $data['breadcrumbs'] = $this->menuManagementModel::breadCrumbsBySlug();

                $this->logUser('Access ' . $data['title'], 'Access ' . $data['title'] . ' page successfully');
                if (session()->get('role_id')) {
                    return $this->checkIdle(view('website/' . $data['page_navbar']['to_page'] . '/body', $data));
                } else {
                    return view('website/' . $data['page_navbar']['to_page'] . '/body', $data);
                }
            }
        }
        $this->logUser('Access page', 'User try to access a page but is not found, user redirected to home');

        throw new \CodeIgniter\Exceptions\PageNotFoundException("Not Found");
    }

    public function logUser($activity, $description = '')
    {
        $dataUser = null;
        if (session()->get('email')) {
            $dataUser = $this->userModel::dataUsersByEmail(session()->get('email'));
        }

        if ($dataUser) {
            $data_insert = [
                'user_id' => $dataUser['user_id'],
                'role_id' => $dataUser['role_id'],
                'activity' => $activity,
                'description' => $description,
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime()
            ];

            $throw_id = false;
            $table_name = 'log_table';

            $this->helperModel::insertData($data_insert, $throw_id, $table_name);
        }
    }

    // DELETE MENU
    public function delMenu($segment, $table_name, $uuid)
    {
        $id = $uuid;
        $is_active = null;
        $message = '';
        if ($segment == 'deactivate') {
            $is_active = 0;
            $message = "deactivated";
        } else if ($segment == 'activate') {
            $is_active = 1;
            $message = "activated";
        } else {
            $is_active = 1;
            $message = "deleted";
        }

        // if ($message == 'deleted') {
        //     $data_update = [
        //         'is_deleted' => $is_active,
        //         'updated_at' => $this->dateTime(),
        //     ];
        // } else {
        $data_update = [
            $message == 'deleted' ? 'is_deleted' : 'is_active' => $is_active,
            'updated_at' => $this->dateTime(),
        ];
        // }

        $columns_id = 'uuid';
        $this->helperModel::deleteData($columns_id, $id, $data_update, $table_name . '_table', false);

        $session = $this->sessionMessage('success', "data has been " . $message);
        $token = csrf_hash();

        $result['notification'] = $session;
        $result['token'] = $token;

        $this->logUser('Delete ' . $table_name, 'Delete ' . $table_name . ' with id ' . $id . ' successfully');
        return $this->response->setJSON($result);
    }

    public function dtActionButtons()
    {
        $columnName = $this->request->getVar('columnName');
        $modelName = $this->request->getVar('modelName');
        $methodName = $this->request->getVar('methodName');
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
        $data = $this->$methodName::$modelName('', $columnName, 'asc', $fullData, $lang_code);

        // dd($data);

        switch ($buttons) {
            case 'print':

                $totalData = count($data);

                $response = [
                    'draw' => $draw,
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalData,
                    'data' => $data

                ];
                $this->logUser('Print', 'Print data ' . $modelName);
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
                $this->logUser('Export Excel', 'Export data ' . $modelName);
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
                $this->logUser('Export CSV', 'Export data ' . $modelName);
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
                $this->logUser('Print', 'Print data ' . $modelName);
                return $this->response->setJSON($response);
        }
    }
}
