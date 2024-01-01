<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;

use App\Models\People\PeopleModel;

class People extends BaseController
{
    protected $peopleModel;
    public function __construct()
    {
        $this->peopleModel = new PeopleModel();
    }

    public function index()
    {
        // Model People
        $dataPeople = $this->peopleModel;

        $perPage = 6;
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;

        $search = $this->request->getVar('q');

        // Service untuk membuat pagination
        $pager = service('pager');

        $data = [
            'title' => "People",
            'layout' => $this->dirLayout,
            'section' => $this->dirSection,
            'data' => $dataPeople->dataPeople($perPage, $offset, $search, true),
            'pager' => $pager->makeLinks($currentPage, $perPage, count($dataPeople->dataPeople($perPage, $offset, $search, false)), 'default_pagination'),
            'offset' => $offset
        ];

        return view('pages/people', $data);
    }
}
