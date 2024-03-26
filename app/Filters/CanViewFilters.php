<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Cms\MenuManagement\MenuManagementModel;

class CanViewFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $menuManagement = new MenuManagementModel();
        // Mengambil nilai dari meta tag dengan nama 'lang'
        $lang_code = $request->getServer('HTTP_META_LANGUAGE');
        $role_id = session()->get('role_id');
        $uri = service('uri');
        $data = $menuManagement::menuAksesBySlug($uri->getSegment(1), $lang_code, $role_id);

        $canView = 0;
        if ($data) {
            if (count($data['sidebar']) == 0) {
                $canView = $data['menu']['view'];
            } else {
                $canView = $data['sidebar'][0]['view'];
            }
        }

        if ($canView == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // Periksa apakah pengguna adalah admin, jika tidak, redirect atau tampilkan pesan error
        // if (session()->get('view') != 1) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is session end / not found");
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
