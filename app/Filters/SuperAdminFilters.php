<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SuperAdminFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Periksa apakah pengguna adalah admin, jika tidak, redirect atau tampilkan pesan error
        if (session()->get('is_master') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page is not found");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
