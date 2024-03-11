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

    // Layout Website
    protected $dirLayoutWebsite = "layout/template_website";
    // Section Website
    protected $dirSectionWebsite = "bodyWebsite";

    // Layout Auth
    protected $dirLayoutAuth = "layout/template_auth";
    // Section Auth
    protected $dirSectionAuth = "bodyAuth";

    // Layout CMS
    protected $dirLayoutCms = "layout/template_cms";
    // Section CMS
    protected $dirSectionCms = "bodyCms";

    // OAuth
    protected $providers = [
        'google' => [
            'clientId'     => '668260322681-hfuvetkstlt7qk134qetp3j4pbfd7c2d.apps.googleusercontent.com',
            'clientSecret' => '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',
            'redirectUri'  => 'http://localhost:8080/redirect-google',
            'scopes'       => ['email', 'profile'],
        ],
        'facebook' => [
            'clientId'     => '1099916397702406',
            'clientSecret' => '9785e1d220e6dd70d66f41e901a50107',
            'redirectUri'  => 'http://localhost:8080/redirect-facebook',
            'graphApiVersion' => 'v19.0',
            'scopes'       => ['email', 'public_profile'],
        ],
    ];

    // GET DATA OAuth
    protected function getOauthName($user)
    {
        return $user->getName();
    }

    protected function getOauthFirstName($user)
    {
        return $user->getFirstName();
    }

    protected function getOauthLastName($user)
    {
        return $user->getLastName();
    }

    protected function getOauthEmail($user)
    {
        return $user->getEmail();
    }
    // END DATA OAuth

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

    public function dateTimeModify($request)
    {
        // FORMAT DATETIME MYSQL
        return Time::now()->modify($request)->format('Y-m-d H:i:s');
    }

    // Session Notification
    public function sessionMessage($status, $description = "")
    {
        $msg = $description;
        $icon = "";
        $title = "";
        $timer = 0;
        $showConfirmButton = false;
        $showCancelButton = false;
        switch ($status) {
            case 'success':
                $title = "Success";
                $icon = "success";
                $timer = 1500;
                $showConfirmButton = false;
                $showCancelButton = false;
                break;
            case 'error':
                $title = "Error";
                $icon = "error";
                $timer = 0;
                $showConfirmButton = true;
                $showCancelButton = false;
                break;
            case 'warning':
                $title = "Warning";
                $icon = "warning";
                $timer = 0;
                $showConfirmButton = true;
                $showCancelButton = true;
                break;
            case 'info':
                $title = "Info";
                $icon = "info";
                $timer = 0;
                $showConfirmButton = true;
                $showCancelButton = false;
                break;
            default:
                $title = "Error";
                $msg = "Sepertinya ada masalah, mohon hubungi kami";
                $icon = "error";
                $timer = 0;
                $showConfirmButton = true;
                $showCancelButton = false;
        };

        $message = "";
        if ($showConfirmButton) {
            if ($showCancelButton) {
                $message = '<script>Swal.fire({
                title: "' . $title . '",
                text: "' . $msg . '",
                icon: "' . $icon . '",
                timer: ' . $timer . ',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: "#fff",
                cancelButtonColor: "#fe2628",
              });</script>';
            } else {
                $message = '<script>Swal.fire({
                title: "' . $title . '",
                text: "' . $msg . '",
                icon: "' . $icon . '",
                timer: ' . $timer . ',
                showConfirmButton: true,
                showCancelButton: false,
                confirmButtonColor: "#fff",
                cancelButtonColor: "#fe2628",
              });</script>';
            }
        } else {
            $message = '<script>Swal.fire({
                title: "' . $title . '",
                text: "' . $msg . '",
                icon: "' . $icon . '",
                timer: ' . $timer . ',
                showConfirmButton: false,
                showCancelButton: false
              });</script>';
        }

        return $message;
    }

    // Unlink Image
    public function unlinkImage($path)
    {
        return unlink($path);
    }

    // Fungsi untuk menghasilkan 4 angka acak unik
    public function generateUniqueRandomNumbers()
    {

        // Menggabungkan angka menjadi satu string
        $uniqueId = substr(uniqid(), -4);

        // Mengambil hanya karakter numerik
        $numericOnly = preg_replace("/[^1-9]/", "", $uniqueId);

        // Pastikan panjangnya tetap empat digit dengan str_pad
        $result = str_pad($numericOnly, 4, rand(1, 9), STR_PAD_LEFT);

        return $result;
    }

    protected $timeIdle = 3600;

    public function checkIdle($view = "")
    {
        // Check if user is logged in
        if (!session()->get('email')) {
            return redirect()->to('/login');
        }

        if (session()->get('is_lockscreen') == 1) {
            return redirect()->to('/lockscreen');
        }

        // Check last activity time
        $lastActivity = session()->get('last_activity');
        $idleTime = $this->timeIdle; // = 60 minutes
        if (time() - $lastActivity >= $idleTime) {
            if (session()->get('is_master') != 0 || session()->get('is_admin') != 0) {
                return redirect()->to('/lockscreen');
            };
            // Logout user if idle time exceeded
            return redirect()->to('/logout');
        } else {
            // Update last activity time
            session()->set('last_activity', time());
        }

        return $view;
    }
}
