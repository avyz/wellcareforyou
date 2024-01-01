<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    // Layout Var
    protected $dirLayoutWebsite = "layout/template_website";
    // Section Var
    protected $dirSectionWebsite = "bodyWebsite";

    // meta description
    public function setTitle($title)
    {
        return $title;
    }

    // meta description
    public function setMetaDescription($description)
    {
        return $description;
    }

    // created_at time
    public function dateTime()
    {
        // FORMAT DATETIME MYSQL
        return Time::now()->format('Y-m-d H:i:s');
    }

    // Session Notification
    public function sessionMessage($status, $categories, $type)
    {
        $msg = "";
        $icon = "";
        $title = "";
        $timer = 0;
        $showConfirmButton = false;
        switch ($status) {
            case 'success':
                $title = "Success";
                $msg = "$categories berhasil $type";
                $icon = "success";
                $timer = 1500;
                $showConfirmButton = false;
                break;
            case 'error':
                $title = "Error";
                $msg = "$categories gagal $type";
                $icon = "error";
                $timer = 0;
                $showConfirmButton = true;
                break;
            case 'default':
                $title = "Error";
                $msg = "Sepertinya ada masalah, mohon hubungi kami";
                $icon = "error";
                $timer = 0;
                $showConfirmButton = true;
                break;
        };

        $message = "";
        if ($showConfirmButton) {
            $message = '<script>Swal.fire({
                title: "' . $title . '",
                text: "' . $msg . '",
                icon: "' . $icon . '",
                timer: ' . $timer . ',
                showConfirmButton: true
              });</script>';
        } else {
            $message = '<script>Swal.fire({
                title: "' . $title . '",
                text: "' . $msg . '",
                icon: "' . $icon . '",
                timer: ' . $timer . ',
                showConfirmButton: false
              });</script>';
        }

        return $message;
    }

    // Unlink Image
    public function unlinkImage($path)
    {
        return unlink($path);
    }
}
