<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use App\Models\Pages\PagesModel;

class Pages extends BaseController
{

    protected $pagesModel;
    public function __construct()
    {
        $this->pagesModel = new PagesModel();
    }

    public function index()
    {

        $data = [
            'title' => "Home",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection
        ];

        return view('pages/body', $data);
    }

    public function about()
    {
        $data = [
            'title' => "About",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => "Contact",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection
        ];

        return view('pages/contact', $data);
    }

    public function comics()
    {
        // Model Comics
        $dataComics = $this->pagesModel::dataComics();

        $data = [
            'title' => "Comics",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection,
            'data' => $dataComics
        ];

        return view('pages/comics', $data);
    }

    public function detail($slug)
    {
        $dataComics = $this->pagesModel::dataComics($slug);
        $data = [
            'title' => "Detail",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection,
            'data' => $dataComics
        ];

        if (!$dataComics) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page $slug is not found");
        }

        return view('pages/detail', $data);
    }

    public function view($type, $slug = false)
    {

        $dataComics = $this->pagesModel::dataComics($slug);
        $data = [
            'title' => ucfirst($type),
            'layout' => $this->dirLayout,
            'section' => $this->dirSection,
            'data' => $dataComics
        ];

        if ((!$slug && $type == 'Edit') || !$dataComics) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page $type is not found");
        }

        return view('pages/view', $data);
    }

    public function save()
    {

        $rules = [
            'comic_name' => [
                'label' => 'Comic Name',
                'rules' => 'required|is_unique[comics.comic_name]'
            ],
            'author' => [
                'label' => 'Author',
                'rules' => 'required'
            ],
            'publisher' => [
                'label' => 'Publisher',
                'rules' => 'required'
            ],
            'cover' => [
                'label' => 'Cover',
                'rules' => 'max_size[cover,1024]|mime_in[cover,image/jpg,image/jpeg,image/png]|is_image[cover]',
                'errors' => [
                    'uploaded' => 'No file on {field}',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg'
                ]
            ]
        ];


        // VALIDASI FORM
        if (!$this->validate($rules)) {
            // Redirect ke halaman sebelumnya bersama dengan input lama nya.
            return redirect()->back()->withInput();
        }

        // Take Image
        $coverFile = $this->request->getFile('cover');

        // Cek jika tidak ada gambar yang di upload
        if ($coverFile->getError() == 4) {
            $coverName = 'default.png';
        } else {
            // Random Name
            $coverName = $coverFile->getRandomName();

            // Move Image
            $coverFile->move('assets/img', $coverName);
            // Get name image
            // $coverName = $coverFile->getName();
        }



        $data = [
            'comic_name' => $this->request->getVar('comic_name'),
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $coverName,
            'status' => $this->request->getVar('status'),
            'slug' => url_title($this->request->getVar('comic_name'), '-', true),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ];

        $throw_id = false;
        $insert = $this->pagesModel::insertData($data, $throw_id, 'comics');

        $icon = "";
        if ($insert) {
            $icon = "success";
        } else {
            $icon = "error";
        }

        session()->setFlashdata("notif", $this->sessionMessage($icon, $data['comic_name'], 'disimpan'));

        return redirect()->to("/comics");
    }

    public function edit()
    {

        $dataComics = $this->pagesModel::dataComics($this->request->getVar('slug'));

        $value = "";
        if ($dataComics['comic_name'] == $this->request->getVar('comic_name')) {
            $value = 'required';
        } else {
            $value = 'required|is_unique[comics.comic_name]';
        }

        $rules = [
            'comic_name' => [
                'label' => 'Comic Name',
                'rules' => $value
            ],
            'author' => [
                'label' => 'Author',
                'rules' => 'required'
            ],
            'publisher' => [
                'label' => 'Publisher',
                'rules' => 'required'
            ],
            'cover' => [
                'label' => 'Cover',
                'rules' => 'max_size[cover,1024]|mime_in[cover,image/jpg,image/jpeg,image/png]|is_image[cover]',
                'errors' => [
                    'uploaded' => 'No file on {field}',
                    'max_size' => 'Image must less than 1mb',
                    'is_image' => 'Image not valid',
                    'mime_in' => 'Your file must be *.png, *.jpeg, *.jpg'
                ]
            ]
        ];

        // VALIDASI FORM
        if (!$this->validate($rules)) {
            // Redirect ke halaman sebelumnya bersama dengan input lama nya.
            return redirect()->back()->withInput();
        }

        // Cover lama
        $coverLama = $this->request->getVar('coverLama');

        // Take Image
        $coverFile = $this->request->getFile('cover');


        // Cek jika tidak ada gambar yang di upload
        if ($coverFile->getError() == 4) {
            // Jika nama file gambar sebelum dan sesudah sama, masukkan file lama
            $coverName = $coverLama;
        } else {
            $coverName = $coverFile->getRandomName();
            if ($coverLama != 'default.png') {
                // Random Name
                $this->unlinkImage('assets/img/' . $coverLama);
                // Move Image
                $coverFile->move('assets/img', $coverName);
            } else {
                // Move Image
                $coverFile->move('assets/img', $coverName);
            }

            // Get name image
            // $coverName = $coverFile->getName();
        }

        $data = [
            'comic_name' => $this->request->getVar('comic_name'),
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'cover' => $coverName,
            'status' => $this->request->getVar('status') ? 1 : 0,
            'updated_at' => $this->dateTime()
        ];

        $column = [
            'slug' => url_title($this->request->getVar('comic_name'), '-', true)
        ];

        $insert = $this->pagesModel::updateData($column, $data, 'comics');

        $icon = "";
        if ($insert) {
            $icon = "success";
        } else {
            $icon = "error";
        }

        session()->setFlashdata("notif", $this->sessionMessage($icon, $data['comic_name'], 'diubah'));

        return redirect()->to("/comics");
    }


    public function delete($id, $comic_name)
    {
        $column_id = 'id';
        $table = 'comics';
        $hard_delete = true;

        $data = [
            'is_delete' => 1,
            'deleted_at' => $this->dateTime()
        ];

        $dataComics = $this->pagesModel::dataComics(url_title($comic_name, '-', true));

        // Unlink image
        if ($dataComics['cover'] != 'default.png') {
            $this->unlinkImage('assets/img/' . $dataComics['cover']);
        }

        $delete = $this->pagesModel::deleteData($column_id, $id, $data, $table, $hard_delete);

        $icon = "";
        if ($delete) {
            $icon = "success";
        } else {
            $icon = "error";
        }

        session()->setFlashdata("notif", $this->sessionMessage($icon, $comic_name, 'dihapus'));

        return redirect()->to("/comics");
    }
}
