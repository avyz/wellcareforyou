<?php

namespace App\Controllers\Website\About;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Website\About\AboutModel;
use App\Models\Cms\Pages\PagesModel;
use App\Models\HelperModel;

class About extends BaseController
{

    protected $helperModel;
    protected $generalController;
    protected $aboutModel;
    protected $pagesModel;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->generalController = new General();
        $this->aboutModel = new AboutModel();
        $this->pagesModel = new PagesModel();
    }

    public function index()
    {
        $title = 'About Us';
        $type = $this->request->getVar('type');
        $nid = $this->request->getVar('nid');
        $language = $this->request->getVar('language');
        $uri = service('uri');
        $path_url = $uri->getPath();
        $path = 'website/about/body';

        $result['type'] = $type;
        $result['nid'] = $nid;
        $result['path'] = $path;
        $result['arr_breadcrumbs'] = [];
        // $result['arr_breadcrumbs'] = [
        //     [
        //         'segment' => ucwords($title),
        //         'url' => $path_url . '?language=' . $language,
        //         'is_active' => '1'
        //     ],
        // ];

        $passData = $this->dataArrayForMethodLinks($title, $result, true);

        return  $this->generalController->linksWebsite($passData);
    }

    public function editContentAbout()
    {
        $section = $this->request->getVar('section');
        $navbar_uuid = $this->request->getVar('navbar_uuid');
        $page_uuid = $this->request->getVar('page_uuid');
        $lang_code = $this->request->getVar('lang_code');
        $type = $this->request->getVar('type');


        $data_page = null;
        $data_grid = null;
        $data_image = null;

        if ($page_uuid) {
            $data_page = $this->pagesModel->getPageTableByPageUuid($page_uuid, $section);
            $data_grid = $this->pagesModel->dataPagesGridWebsiteByPageId($page_uuid);
            $data_image = $this->pagesModel->dataPagesImageWebsiteByPageId($page_uuid);
        }

        // dd($page_uuid);

        if ($type != 'view') {

            switch ($section) {
                case '1':
                    $section_one_about_title = $this->request->getVar('section_one_about_title');
                    $section_one_about_optional_title = $this->request->getVar('section_one_about_optional_title');
                    $section_one_about_subtitle = $this->request->getVar('section_one_about_subtitle');
                    $section_one_about_paragraph = $this->request->getVar('section_one_about_paragraph');

                    // Grid
                    $section_one_about_grid_urutan = $this->request->getVar('section_one_about_grid_urutan');
                    $section_one_about_grid_title = $this->request->getVar('section_one_about_grid_title');
                    $section_one_about_grid_paragraph = $this->request->getVar('section_one_about_grid_paragraph');
                    $section_one_about_grid_image = $this->request->getVar('section_one_about_grid_image');

                    // Image
                    $section_one_about_image_urutan = $this->request->getVar('section_one_about_image_urutan');
                    $section_one_about_image = $this->request->getVar('section_one_about_image');
                    $files = $this->request->getFiles();
                    $section_one_about_image_new = $files['section_one_about_image_new'];

                    $rules = [
                        'section_one_about_title' => [
                            'label' => 'Title 1',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title 1 is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_one_about_optional_title' => [
                            'label' => 'Title 2',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title 2 is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_one_about_subtitle' => [
                            'label' => 'Subtitle',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Subtitle is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_one_about_paragraph' => [
                            'label' => 'Paragraph',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'required' => 'The Paragraph is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                    ];

                    if ($section_one_about_grid_urutan != null) {
                        $rules['section_one_about_grid_title.*'] = [
                            'label' => 'Title Grid',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                        $rules['section_one_about_grid_paragraph.*'] = [
                            'label' => 'Paragraph Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'regex_match' => 'No single quotes allowed in this field',
                                'required' => 'The Paragraph Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                        $rules['section_one_about_grid_image.*'] = [
                            'label' => 'Icon Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'regex_match' => 'No single quotes allowed in this field',
                                'required' => 'The Icon Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                    }

                    if ($section_one_about_image_urutan != null) {
                        foreach ($section_one_about_image_new as $key => $images) {
                            // $is_upload = '';

                            if ($key == 0) {
                                $image_size = '625,800';
                            } else if ($key == 1) {
                                $image_size = '445,445';
                            } else if ($key == 2) {
                                $image_size = '1120,550';
                            }

                            if ($page_uuid) {
                                $is_upload = 'max_size[section_one_about_image_new.' . $key . ',1024]|mime_in[section_one_about_image_new.' . $key . ',image/jpg,image/jpeg,image/png,image/webp]|is_image[section_one_about_image_new.' . $key . ']|check_image_dimensions[section_one_about_image_new.' . $key . ',' . $image_size . ']';
                            } else {
                                $is_upload = 'uploaded[section_one_about_image_new.' . $key . ']|max_size[section_one_about_image_new.' . $key . ',1024]|mime_in[section_one_about_image_new.' . $key . ',image/jpg,image/jpeg,image/png,image/webp]|is_image[section_one_about_image_new.' . $key . ']|check_image_dimensions[section_one_about_image_new.' . $key . ',' . $image_size . ']';
                            }

                            $rules['section_one_about_image_new.' . $key] = [
                                'label' => 'Image',
                                'rules' => $is_upload,
                                'errors' => [
                                    'uploaded' => 'The Image is required',
                                    'max_size' => 'Image must be less than 1MB',
                                    'is_image' => 'Image is not valid',
                                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp',
                                    'check_image_dimensions' => 'Image dimensions must be ' . explode(',', $image_size)[0] . 'px' . ' x ' . explode(',', $image_size)[1] . 'px'
                                ]
                            ];
                        }
                    }

                    // dd($rules);
                    // die;

                    $session = null;
                    $validation = null;

                    if (!$this->validate($rules)) {
                        $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                        $validation = validation_errors();
                        $this->generalController->logUser('Update Section 1', 'Fail to update because field invalid');
                    } else {
                        if (!$data_page) {
                            $data = [
                                'uuid' => $this->helperModel->generateUuid(),
                                'navbar_uuid' => $navbar_uuid,
                                'section' => $section,
                                'title' => $section_one_about_title,
                                'subtitle' => $section_one_about_subtitle,
                                'paragraph' => $section_one_about_paragraph,
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'lang_code' => $lang_code,
                                'optional_title' => $section_one_about_optional_title,
                            ];
                            $insert = $this->helperModel->insertData($data, true, 'page_table');
                        } else {
                            $data_update = [
                                'title' => $section_one_about_title,
                                'subtitle' => $section_one_about_subtitle,
                                'paragraph' => $section_one_about_paragraph,
                                'optional_title' => $section_one_about_optional_title,
                                'updated_at' => $this->dateTime(),
                            ];
                            $where = [
                                'uuid' => $page_uuid
                            ];
                            $insert = $this->helperModel::updateData($where, $data_update, 'page_table');
                        }

                        if ($insert) {
                            if (!$data_grid) {
                                foreach ($section_one_about_grid_urutan as $key => $value) {
                                    $data_grid_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'image' => $section_one_about_grid_image[$key],
                                        'title' => $section_one_about_grid_title[$key],
                                        'paragraph' => $section_one_about_grid_paragraph[$key],
                                        'urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                }
                            } else {
                                foreach ($data_grid as $key => $value) {
                                    $data_grid_update = [
                                        'image' => $section_one_about_grid_image[$key],
                                        'title' => $section_one_about_grid_title[$key],
                                        'paragraph' => $section_one_about_grid_paragraph[$key],
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $where = [
                                        'uuid' => $value['uuid']
                                    ];
                                    $this->helperModel::updateData($where, $data_grid_update, 'page_grid_table');
                                }
                            }

                            if (!$data_image) {
                                foreach ($section_one_about_image_new as $key => $image) {
                                    $value = $key + 1;
                                    if ($image->getClientExtension()) {
                                        $section_one_about_image_name = $lang_code . '_about_image_' . $value . '.' . $image->getClientExtension();
                                    } else {
                                        $section_one_about_image_name = $section_one_about_image[$key];
                                    }
                                    $data_image_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'page_image' => $section_one_about_image_name,
                                        'page_image_urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];

                                    $this->helperModel->insertData($data_image_insert, false, 'page_image_table');

                                    if ($image->getClientExtension()) {
                                        // $this->unlinkImage('assets/website/images/about/' . $section_one_about_image_name);
                                        $image->move('assets/website/images/about', $section_one_about_image_name);
                                    }
                                }
                            } else {
                                foreach ($section_one_about_image_new as $key => $image) {
                                    $urutan = $key + 1;
                                    if ($image->getClientExtension()) {
                                        $section_one_about_image_name = $lang_code . '_about_image_' . $urutan . '.' . $image->getClientExtension();
                                    } else {
                                        $section_one_about_image_name = $section_one_about_image[$key];
                                    }
                                    $data_image_update = [
                                        'page_image' => $section_one_about_image_name,
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $where = [
                                        'uuid' => $data_image[$key]['uuid']
                                    ];
                                    $this->helperModel::updateData($where, $data_image_update, 'page_image_table');
                                    if ($image->getClientExtension()) {
                                        $image_name = $lang_code . '_about_image_' . $urutan;
                                        if ($image_name == $this->removeExtension($data_image[$key]['page_image'])) {
                                            $this->unlinkImage('assets/website/images/about/' . $section_one_about_image[$key]);
                                        }
                                        $image->move('assets/website/images/about', $section_one_about_image_name);
                                    }
                                }
                            }
                            $session = $this->sessionMessage('success', 'Section 1 has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Section 1', 'Section 1 has been updated');
                        }
                    }
                    break;
                case '2':
                    $section_two_about_grid_urutan = $this->request->getVar('section_two_about_grid_urutan');
                    $section_two_about_grid_title = $this->request->getVar('section_two_about_grid_title');
                    $section_two_about_grid_paragraph = $this->request->getVar('section_two_about_grid_paragraph');

                    if ($section_two_about_grid_urutan != null) {
                        $rules['section_two_about_grid_title.*'] = [
                            'label' => 'Title Grid',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                        $rules['section_two_about_grid_paragraph.*'] = [
                            'label' => 'Paragraph Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'regex_match' => 'No single quotes allowed in this field',
                                'required' => 'The Paragraph Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                    }

                    $session = null;
                    $validation = null;

                    if (!$this->validate($rules)) {
                        $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                        $validation = validation_errors();
                        $this->generalController->logUser('Update Section 2', 'Fail to update because field invalid');
                    } else {
                        if (!$data_page) {
                            $data = [
                                'uuid' => $this->helperModel->generateUuid(),
                                'navbar_uuid' => $navbar_uuid,
                                'section' => $section,
                                'title' => '',
                                'subtitle' => '',
                                'paragraph' => '',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'lang_code' => $lang_code,
                                'optional_title' => '',
                            ];
                            $insert = $this->helperModel->insertData($data, true, 'page_table');
                        } else {
                            $data_update = [
                                'title' => '',
                                'subtitle' => '',
                                'paragraph' => '',
                                'optional_title' => '',
                                'updated_at' => $this->dateTime(),
                            ];
                            $where = [
                                'uuid' => $page_uuid
                            ];
                            $insert = $this->helperModel::updateData($where, $data_update, 'page_table');
                        }

                        if ($insert) {
                            if (!$data_grid) {
                                foreach ($section_two_about_grid_urutan as $key => $value) {
                                    $data_grid_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'image' => '',
                                        'title' => $section_two_about_grid_title[$key],
                                        'paragraph' => $section_two_about_grid_paragraph[$key],
                                        'urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                }
                            } else {
                                foreach ($data_grid as $key => $value) {
                                    $data_grid_update = [
                                        'title' => $section_two_about_grid_title[$key],
                                        'paragraph' => $section_two_about_grid_paragraph[$key],
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $where = [
                                        'uuid' => $value['uuid']
                                    ];
                                    $this->helperModel::updateData($where, $data_grid_update, 'page_grid_table');
                                }
                            }

                            $session = $this->sessionMessage('success', 'Section 2 has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Section 2', 'Section 2 has been updated');
                        }
                    }
                    break;
                case '3':
                    $section_three_about_title = $this->request->getVar('section_three_about_title');
                    $section_three_about_subtitle = $this->request->getVar('section_three_about_subtitle');

                    $section_three_about_grid_urutan = $this->request->getVar('section_three_about_grid_urutan');
                    $section_three_about_grid_title = $this->request->getVar('section_three_about_grid_title');
                    $section_three_about_grid_image = $this->request->getVar('section_three_about_grid_image');

                    if ($section_three_about_grid_urutan != null) {
                        $rules['section_three_about_grid_title.*'] = [
                            'label' => 'Title Grid',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                        $rules['section_three_about_grid_image.*'] = [
                            'label' => 'Icon Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'regex_match' => 'No single quotes allowed in this field',
                                'required' => 'The Icon Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                    }

                    $session = null;
                    $validation = null;

                    if (!$this->validate($rules)) {
                        $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                        $validation = validation_errors();
                        $this->generalController->logUser('Update Section 3', 'Fail to update because field invalid');
                    } else {
                        if (!$data_page) {
                            $data = [
                                'uuid' => $this->helperModel->generateUuid(),
                                'navbar_uuid' => $navbar_uuid,
                                'section' => $section,
                                'title' => $section_three_about_title,
                                'subtitle' => $section_three_about_subtitle,
                                'paragraph' => '',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'lang_code' => $lang_code,
                                'optional_title' => '',
                            ];
                            $insert = $this->helperModel->insertData($data, true, 'page_table');
                        } else {
                            $data_update = [
                                'title' => $section_three_about_title,
                                'subtitle' => $section_three_about_subtitle,
                                'paragraph' => '',
                                'optional_title' => '',
                                'updated_at' => $this->dateTime(),
                            ];
                            $where = [
                                'uuid' => $page_uuid
                            ];
                            $insert = $this->helperModel::updateData($where, $data_update, 'page_table');
                        }

                        if ($insert) {
                            if (!$data_grid) {
                                foreach ($section_three_about_grid_urutan as $key => $value) {
                                    $data_grid_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'title' => $section_three_about_grid_title[$key],
                                        'image' => $section_three_about_grid_image[$key],
                                        'paragraph' => '',
                                        'urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                }
                            } else {
                                foreach ($data_grid as $key => $value) {
                                    $data_grid_update = [
                                        'title' => $section_three_about_grid_title[$key],
                                        'image' => $section_three_about_grid_image[$key],
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $where = [
                                        'uuid' => $value['uuid']
                                    ];
                                    $this->helperModel::updateData($where, $data_grid_update, 'page_grid_table');
                                }
                            }

                            $session = $this->sessionMessage('success', 'Section 3 has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Section 3', 'Section 3 has been updated');
                        }
                    }
                    break;
                case '4':
                    $section_four_about_title = $this->request->getVar('section_four_about_title');
                    $section_four_about_optional_title = $this->request->getVar('section_four_about_optional_title');
                    $section_four_about_subtitle = $this->request->getVar('section_four_about_subtitle');
                    $section_four_about_paragraph = $this->request->getVar('section_four_about_paragraph');

                    $section_four_about_image_new = $this->request->getFile('section_four_about_image_new');
                    $section_four_about_image = $this->request->getVar('section_four_about_image');

                    // dd($section_four_about_image_new->getName());

                    $section_four_about_grid_urutan = $this->request->getVar('section_four_about_grid_urutan');
                    $section_four_about_grid_title = $this->request->getVar('section_four_about_grid_title');
                    $section_four_about_grid_paragraph = $this->request->getVar('section_four_about_grid_paragraph');

                    if ($page_uuid) {
                        $is_upload = 'max_size[section_four_about_image_new,1024]|mime_in[section_four_about_image_new,image/jpg,image/jpeg,image/png,image/webp]|is_image[section_four_about_image_new]|check_image_dimensions[section_four_about_image_new,860,860]';
                    } else {
                        $is_upload = 'uploaded[section_four_about_image_new]|max_size[section_four_about_image_new,1024]|mime_in[section_four_about_image_new,image/jpg,image/jpeg,image/png,image/webp]|is_image[section_four_about_image_new]|check_image_dimensions[section_four_about_image_new,860,860]';
                    }

                    $rules = [
                        'section_four_about_title' => [
                            'label' => 'Title 1',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title 1 is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_four_about_optional_title' => [
                            'label' => 'Title 2',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title 2 is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_four_about_subtitle' => [
                            'label' => 'Subtitle',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Subtitle is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_four_about_paragraph' => [
                            'label' => 'Paragraph',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'required' => 'The Paragraph is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ],
                        'section_four_about_image_new' => [
                            'label' => 'Image',
                            'rules' => $is_upload,
                            'errors' => [
                                'uploaded' => 'The Image is required',
                                'max_size' => 'Image must be less than 1MB',
                                'is_image' => 'Image is not valid',
                                'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp',
                                'check_image_dimensions' => 'Image dimensions must be 860px x 860px'
                            ]
                        ],
                    ];

                    if ($section_four_about_grid_urutan != null) {
                        $rules['section_four_about_grid_title.*'] = [
                            'label' => 'Title Grid',
                            'rules' => 'trim|required',
                            'errors' => [
                                'required' => 'The Title Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                        $rules['section_four_about_grid_paragraph.*'] = [
                            'label' => 'Paragraph Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'regex_match' => 'No single quotes allowed in this field',
                                'required' => 'The Paragraph Grid is required',
                                'trim' => 'Character has space in first or end letter',
                            ]
                        ];
                    }


                    $session = null;
                    $validation = null;

                    if (!$this->validate($rules)) {
                        $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                        $validation = validation_errors();
                        $this->generalController->logUser('Update Section 4', 'Fail to update because field invalid');
                    } else {
                        if (!$data_page) {

                            if ($section_four_about_image_new->getClientExtension()) {
                                $section_four_about_image_name = $lang_code . '_about_main_image.' . $section_four_about_image_new->getClientExtension();
                            } else {
                                $section_four_about_image_name = $section_four_about_image;
                            }

                            $data = [
                                'uuid' => $this->helperModel->generateUuid(),
                                'navbar_uuid' => $navbar_uuid,
                                'section' => $section,
                                'title' => $section_four_about_title,
                                'subtitle' => $section_four_about_subtitle,
                                'paragraph' => $section_four_about_paragraph,
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'lang_code' => $lang_code,
                                'optional_title' => $section_four_about_optional_title,
                                'page_image' => $section_four_about_image_name,
                            ];
                            $insert = $this->helperModel->insertData($data, true, 'page_table');
                            $section_four_about_image_new->move('assets/website/images/about', $section_four_about_image_name);
                        } else {

                            if ($section_four_about_image_new->getClientExtension()) {
                                $section_four_about_image_name = $lang_code . '_about_main_image.' . $section_four_about_image_new->getClientExtension();
                            } else {
                                $section_four_about_image_name = $section_four_about_image;
                            }

                            $data_update = [
                                'title' => $section_four_about_title,
                                'subtitle' => $section_four_about_subtitle,
                                'paragraph' => $section_four_about_paragraph,
                                'optional_title' => $section_four_about_optional_title,
                                'updated_at' => $this->dateTime(),
                                'page_image' => $section_four_about_image_name,
                            ];
                            $where = [
                                'uuid' => $page_uuid
                            ];
                            $insert = $this->helperModel::updateData($where, $data_update, 'page_table');

                            if ($section_four_about_image_new->getClientExtension()) {
                                // if ($section_four_about_image_name == $data_page['page_image']) {
                                // }
                                $this->unlinkImage('assets/website/images/about/' . $section_four_about_image);
                                $section_four_about_image_new->move('assets/website/images/about', $section_four_about_image_name);
                            }
                        }

                        if ($insert) {
                            if (!$data_grid) {
                                foreach ($section_four_about_grid_urutan as $key => $value) {
                                    $data_grid_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'title' => $section_four_about_grid_title[$key],
                                        'image' => '',
                                        'paragraph' => $section_four_about_grid_paragraph[$key],
                                        'urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                }
                            } else {
                                foreach ($data_grid as $key => $value) {
                                    $data_grid_update = [
                                        'title' => $section_four_about_grid_title[$key],
                                        'paragraph' => $section_four_about_grid_paragraph[$key],
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $where = [
                                        'uuid' => $value['uuid']
                                    ];
                                    $this->helperModel::updateData($where, $data_grid_update, 'page_grid_table');
                                }
                            }

                            $session = $this->sessionMessage('success', 'Section 4 has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Section 4', 'Section 4 has been updated');
                        }
                    }
                    break;
                case '5':
                    $section_five_about_title = $this->request->getVar('section_five_about_title');
                    $section_five_about_subtitle = $this->request->getVar('section_five_about_subtitle');

                    // Grid
                    $section_five_about_grid_urutan = $this->request->getVar('section_five_about_grid_urutan');
                    $section_five_about_grid_title = $this->request->getVar('section_five_about_grid_title');
                    $files = $this->request->getFiles();
                    $section_five_about_grid_image_new = $files['section_five_about_grid_image_new'];
                    $section_five_about_grid_image = $this->request->getVar('section_five_about_grid_image');

                    $rules = [
                        'section_five_about_title' => [
                            'label' => 'Title',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'required' => 'The Title is required',
                                'trim' => 'Character has space in first or end letter',
                                'regex_match' => 'No single quotes allowed in this field',
                            ]
                        ],
                        'section_five_about_subtitle' => [
                            'label' => 'Subtitle',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'required' => 'The Subtitle is required',
                                'trim' => 'Character has space in first or end letter',
                                'regex_match' => 'No single quotes allowed in this field',
                            ]
                        ],
                    ];

                    if ($section_five_about_grid_urutan != null) {
                        $rules['section_five_about_grid_title.*'] = [
                            'label' => 'Title Grid',
                            'rules' => 'trim|required|regex_match[^[^\']*$]',
                            'errors' => [
                                'required' => 'The Title Grid is required',
                                'trim' => 'Character has space in first or end letter',
                                'regex_match' => 'No single quotes allowed in this field',
                            ]
                        ];
                        foreach ($section_five_about_grid_image_new as $key => $images) {
                            $is_upload = '';
                            if ($page_uuid) {
                                $is_upload = 'max_size[section_five_about_grid_image_new.' . $key . ',1024]|mime_in[section_five_about_grid_image_new.' . $key . ',image/jpg,image/jpeg,image/png,image/webp,image/svg+xml]|is_image[section_five_about_grid_image_new.' . $key . ']';
                            } else {
                                $is_upload = 'uploaded[section_five_about_grid_image_new.' . $key . ']|max_size[section_five_about_grid_image_new.' . $key . ',1024]|mime_in[section_five_about_grid_image_new.' . $key . ',image/jpg,image/jpeg,image/png,image/webp,image/svg+xml]|is_image[section_five_about_grid_image_new.' . $key . ']';
                            }

                            $rules['section_five_about_grid_image_new.' . $key] = [
                                'label' => 'Icon Grid',
                                'rules' => $is_upload,
                                'errors' => [
                                    'uploaded' => 'The Icon Grid is required',
                                    'max_size' => 'Image must be less than 1MB',
                                    'is_image' => 'Image is not valid',
                                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg, *.webp, *.svg',
                                ]
                            ];
                        }
                    }

                    $session = null;
                    $validation = null;

                    if (!$this->validate($rules)) {
                        $session = $this->sessionMessage('error', "Oops, something went wrong when update. Please check your input again");
                        $validation = validation_errors();
                        $this->generalController->logUser('Update Section 5', 'Fail to update because field invalid');
                    } else {
                        if (!$data_page) {
                            $data = [
                                'uuid' => $this->helperModel->generateUuid(),
                                'navbar_uuid' => $navbar_uuid,
                                'section' => $section,
                                'title' => $section_five_about_title,
                                'subtitle' => $section_five_about_subtitle,
                                'paragraph' => '',
                                'created_at' => $this->dateTime(),
                                'updated_at' => $this->dateTime(),
                                'lang_code' => $lang_code,
                                'optional_title' => '',
                            ];
                            $insert = $this->helperModel->insertData($data, true, 'page_table');
                        } else {
                            $data_update = [
                                'title' => $section_five_about_title,
                                'subtitle' => $section_five_about_subtitle,
                                'paragraph' => '',
                                'optional_title' => '',
                                'updated_at' => $this->dateTime(),
                            ];
                            $where = [
                                'uuid' => $page_uuid
                            ];
                            $insert = $this->helperModel::updateData($where, $data_update, 'page_table');
                        }

                        if ($insert) {
                            if (!$data_grid) {
                                foreach ($section_five_about_grid_image_new as $key => $image) {
                                    $value = $key + 1;
                                    if ($image->getClientExtension()) {
                                        $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $value . '.' . $image->getClientExtension();
                                    } else {
                                        $section_five_about_grid_image_name = $section_five_about_grid_image[$key];
                                    }
                                    $data_grid_insert = [
                                        'uuid' => $this->helperModel->generateUuid(),
                                        'page_uuid' => $data['uuid'],
                                        'title' => $section_five_about_grid_title[$key],
                                        'image' => $section_five_about_grid_image_name,
                                        'paragraph' => '',
                                        'urutan' => $value,
                                        'created_at' => $this->dateTime(),
                                        'updated_at' => $this->dateTime(),
                                    ];
                                    $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                    if ($image->getClientExtension()) {
                                        $image->move('assets/website/images/about/icon', $section_five_about_grid_image_name);
                                    }
                                }
                            } else {
                                $imageDeleted = [];
                                foreach ($data_grid as $key => $value) {
                                    // if (in_array($value['image'], $section_five_about_grid_image_new)) {
                                    //     if ($section_five_about_grid_image_new[$key]->getClientExtension()) {
                                    //         $urutan = $key + 1;
                                    //         $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $urutan . '.' . $section_five_about_grid_image_new[$key]->getClientExtension();
                                    //     } else {
                                    //         $section_five_about_grid_image_name = $section_five_about_grid_image[$key];
                                    //     }

                                    //     $data_grid_update = [
                                    //         'title' => $section_five_about_grid_title[$key],
                                    //         'image' => $section_five_about_grid_image_name,
                                    //         'updated_at' => $this->dateTime(),
                                    //     ];
                                    //     $where = [
                                    //         'uuid' => $value['uuid']
                                    //     ];
                                    //     $this->helperModel::updateData($where, $data_grid_update, 'page_grid_table');
                                    //     if ($section_five_about_grid_image_new[$key]->getClientExtension()) {
                                    //         $this->unlinkImage('assets/website/images/about/icon/' . $section_five_about_grid_image[$key]);
                                    //         $section_five_about_grid_image_new[$key]->move('assets/website/images/about/icon', $section_five_about_grid_image_name);
                                    //     };
                                    // } else {
                                    // $this->helperModel::deleteData('uuid', $value['uuid'], [], 'page_grid_table', true);
                                    if (!in_array($value['image'], $section_five_about_grid_image)) {
                                        $imageDeleted[] = [
                                            'index' => $key,
                                            'image' => $value['image']
                                        ];
                                        // Mengonversi indeks menjadi integer dan mengurutkan array berdasarkan indeks
                                        usort($imageDeleted, function ($a, $b) {
                                            return intval($a['index']) <=> intval($b['index']);
                                        });
                                        // $this->unlinkImage('assets/website/images/about/icon/' . $value['image']);
                                    }

                                    foreach ($imageDeleted as $index => $valueImage) {
                                        if (in_array($value['image'], $valueImage)) {
                                            // d($valueImage['image']);
                                            $deletedImageName = $valueImage['image'];
                                            $imagePath = 'assets/website/images/about/icon/' . $deletedImageName;
                                            // Periksa apakah file ada sebelum mencoba menghapusnya
                                            if (file_exists($imagePath)) {
                                                $this->unlinkImage($imagePath);
                                            }
                                            $deletedImageUuid = $data_grid[$valueImage['index']]['uuid'];
                                            $where = ['uuid' => $deletedImageUuid];
                                            $this->helperModel::deleteData('uuid', $deletedImageUuid, [], 'page_grid_table', true);
                                        };
                                    }

                                    // $oldImagePath = 'assets/website/images/about/icon/' . $value['image'];
                                    // if (file_exists($oldImagePath)) {
                                    //     rename($oldImagePath, 'assets/website/images/about/icon/' . $value['image']);
                                    // }
                                }
                                // die;

                                // Memperbarui urutan dan nama file gambar-gambar yang tersisa
                                $newIndex = 1;
                                foreach ($section_five_about_grid_image_new as $key => $sfa) {
                                    // Jika gambar tidak dihapus, lanjutkan proses
                                    if ($section_five_about_grid_image[$key]) {
                                        if (!in_array($key, $imageDeleted)) {
                                            // Periksa apakah gambar sudah ada di database berdasarkan urutan
                                            // if (isset($data_grid[$key])) {

                                            // Menggunakan regex untuk mengekstrak angka
                                            preg_match('/_(\d+)\./', $section_five_about_grid_image[$key], $matches);

                                            // Angka yang diekstrak
                                            $number = ((int)$matches[1] - 1);

                                            // Gambar sudah ada, lakukan pembaruan
                                            $data_page_grid_by_id = $data_grid[$number];
                                            if ($sfa->getClientExtension()) {
                                                $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . $sfa->getClientExtension();
                                            } else {
                                                $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . pathinfo($data_page_grid_by_id['image'], PATHINFO_EXTENSION);
                                            }
                                            // d($section_five_about_grid_image_name);

                                            $data_grid_update = [
                                                'title' => $section_five_about_grid_title[$key],
                                                'image' => $section_five_about_grid_image_name,
                                                'urutan' => $newIndex,
                                                'updated_at' => $this->dateTime(),
                                            ];
                                            $where = ['uuid' => $data_page_grid_by_id['uuid']];
                                            $this->helperModel->updateData($where, $data_grid_update, 'page_grid_table');

                                            if ($sfa->getClientExtension()) {
                                                $imagePath = 'assets/website/images/about/icon/' . $section_five_about_grid_image_name;

                                                // Periksa apakah file ada sebelum mencoba menghapusnya
                                                if (file_exists($imagePath)) {
                                                    $this->unlinkImage($imagePath);
                                                }
                                                $sfa->move('assets/website/images/about/icon', $section_five_about_grid_image_name);
                                            } else {
                                                $directory = 'assets/website/images/about/icon';

                                                // if (is_dir($directory)) {
                                                //     if ($handle = opendir($directory)) {

                                                //         // Loop melalui file di dalam direktori
                                                //         while (false !== ($file = readdir($handle))) {
                                                //             // Lewati "." dan ".."
                                                //             if ($file != "." && $file != "..") {
                                                //                 // Dapatkan path penuh file asli
                                                //                 $oldFilePath = $directory . '/' . $file;

                                                //                 // Buat nama file baru sesuai kebutuhan
                                                //                 // Misalnya, kita ingin mengganti nama file dengan menambahkan prefix "new_"
                                                //                 // $newFileName = 'new_' . $file;

                                                //                 if ($sfa->getClientExtension()) {
                                                //                     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . $sfa->getClientExtension();
                                                //                 } else {
                                                //                     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . pathinfo($data_page_grid_by_id['image'], PATHINFO_EXTENSION);
                                                //                 }

                                                //                 // Path penuh untuk file baru
                                                //                 $newFilePath = $directory . '/' . $section_five_about_grid_image_name;

                                                //                 // Ganti nama file
                                                //                 rename($oldFilePath, $newFilePath);
                                                //             }
                                                //         }

                                                //         // Tutup direktori setelah selesai
                                                //         closedir($handle);
                                                //     }
                                                // }
                                                // dd($number);
                                                // if ($sfa->getClientExtension()) {
                                                //     $section_five_about_grid_image_new_name = $lang_code . '_about_grid_image_' . ($key + 1) . '.' . $sfa->getClientExtension();
                                                // } else {
                                                //     $section_five_about_grid_image_new_name = $lang_code . '_about_grid_image_' . ($key + 1) . '.' . pathinfo($data_page_grid_by_id['image'], PATHINFO_EXTENSION);
                                                // }
                                                // $oldImagePath = 'assets/website/images/about/icon/' . $section_five_about_grid_image_name;
                                                // if (file_exists($oldImagePath)) {
                                                //     rename($oldImagePath, 'assets/website/images/about/icon/' . $section_five_about_grid_image_new_name);
                                                // }
                                            }
                                            // }

                                            $newIndex++;
                                        }
                                    }
                                }
                                // die;

                                // Menambahkan data baru yang belum ada di database
                                foreach ($section_five_about_grid_image_new as $key => $sfa) {
                                    // d($imageDeleted[1]);
                                    $value = $key + 1;
                                    // if ($sfa->getClientExtension()) {
                                    //     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $value . '.' . $sfa->getClientExtension();
                                    // } else {
                                    //     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $value . '.' . pathinfo($section_five_about_grid_image[$key], PATHINFO_EXTENSION);
                                    // }
                                    $data_page_grid_by_id = $this->pagesModel::dataPagesGridWebsiteByPageIdAndUrutan($page_uuid, $value);
                                    // dd($sfa->getName());
                                    if (!$data_page_grid_by_id && !in_array($key, $imageDeleted)) {
                                        // dd($section_five_about_grid_image_name);
                                        $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $value . '.' . ($sfa->getClientExtension() ?: pathinfo($section_five_about_grid_image[$key], PATHINFO_EXTENSION));

                                        $data_grid_insert = [
                                            'uuid' => $this->helperModel->generateUuid(),
                                            'page_uuid' => $page_uuid,
                                            'title' => $section_five_about_grid_title[$key],
                                            'image' => $section_five_about_grid_image_name,
                                            'paragraph' => '',
                                            'urutan' => $value,
                                            'created_at' => $this->dateTime(),
                                            'updated_at' => $this->dateTime(),
                                        ];
                                        $this->helperModel->insertData($data_grid_insert, false, 'page_grid_table');
                                        if ($sfa->getClientExtension()) {
                                            // if ($section_five_about_grid_image[$key]) {
                                            //     $this->unlinkImage('assets/website/images/about/icon/' . $section_five_about_grid_image[$key]);
                                            // }
                                            $sfa->move('assets/website/images/about/icon', $section_five_about_grid_image_name);
                                        }

                                        $newIndex++;
                                    }
                                }

                                $directory = 'assets/website/images/about/icon';

                                if (is_dir($directory)) {
                                    if ($handle = opendir($directory)) {

                                        // Loop melalui file di dalam direktori
                                        $i = 0;
                                        while (false !== ($file = readdir($handle))) {
                                            // Lewati "." dan ".."
                                            if ($file != "." && $file != "..") {
                                                $i++;
                                                // Dapatkan path penuh file asli
                                                $oldFilePath = $directory . '/' . $file;

                                                // Buat nama file baru sesuai kebutuhan
                                                // Misalnya, kita ingin mengganti nama file dengan menambahkan prefix "new_"
                                                // $newFileName = 'new_' . $file;

                                                // d(pathinfo($file, PATHINFO_EXTENSION));

                                                // if ($sfa->getClientExtension()) {
                                                //     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . $sfa->getClientExtension();
                                                // } else {
                                                //     $section_five_about_grid_image_name = $lang_code . '_about_grid_image_' . $newIndex . '.' . pathinfo($data_page_grid_by_id['image'], PATHINFO_EXTENSION);
                                                // }

                                                // Path penuh untuk file baru
                                                $section_five_about_grid_image_new_name = $lang_code . '_about_grid_image_' . $i . '.' . pathinfo($file, PATHINFO_EXTENSION);
                                                $newFilePath = $directory . '/' . $section_five_about_grid_image_new_name;

                                                // Ganti nama file
                                                rename($oldFilePath, $newFilePath);
                                            }
                                        }

                                        // Tutup direktori setelah selesai
                                        closedir($handle);
                                    }
                                }
                                // die;
                            }

                            $session = $this->sessionMessage('success', 'Section 5 has been updated');
                            $validation = null;
                            $this->generalController->logUser('Edit Section 5', 'Section 5 has been updated');
                        }
                    }
                    break;
                default:
                    $session = $this->sessionMessage('error', 'Something went wrong when update.');
                    $validation = null;
                    $this->generalController->logUser('Edit Section ' . $section, 'Section ' . $section . ' fail to updated');
                    break;
            }
            $token = csrf_hash();

            $result['notification'] = $session;
            $result['validation'] = $validation;
            $result['token'] = $token;
        }

        $result['data_page'] = $data_page;
        $result['data_grid'] = $data_grid;
        $result['data_image'] = $data_image;

        return $this->response->setJSON($result);
    }
}
