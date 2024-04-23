<?php

namespace App\Controllers\Cms\Doctor;

use App\Controllers\BaseController;
use App\Controllers\Cms\General\General;
use App\Models\Cms\Doctor\DoctorModel;
use App\Models\HelperModel;

class Doctor extends BaseController
{

    protected $helperModel;
    protected $doctorModel;
    protected $generalController;
    public function __construct()
    {
        $this->helperModel = new HelperModel();
        $this->doctorModel = new DoctorModel();
        $this->generalController = new General();
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

        $fullData = true;
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
}
