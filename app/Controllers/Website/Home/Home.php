<?php

namespace App\Controllers\Website\Home;

use App\Controllers\BaseController;
use App\Models\Website\Home\HomeModel;
use App\Controllers\Cms\General\General;
use App\Models\Cms\MenuManagement\MenuManagementModel;

class Home extends BaseController
{

    protected $homeModel;
    protected $generalController;
    protected $menuManagementModel;
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->generalController = new General();
        $this->menuManagementModel = new MenuManagementModel();
    }

    public function home()
    {
        return redirect()->to(base_url());
    }

    public function index()
    {

        // $uri = service('uri');
        // $route_path = $uri->getRoutePath();
        // dd($route_path);
        // session()->set('menu', $route_path);
        // $title = 'Home';
        // $type = $this->request->getVar('type');
        // $nid = $this->request->getVar('nid');
        // $language = $this->request->getVar('language');
        // // $path_url = $uri->getPath();
        // // dd($uri);
        // // $path = 'website/about/body';

        // $result['type'] = $type;
        // $result['nid'] = $nid;
        // // $result['path'] = $path;
        // // $result['arr_breadcrumbs'] = [];

        // $passData = $this->dataArrayForMethodLinks($title, $result, true);

        // return  $this->generalController->linksWebsite($passData);

        // session()->set('menu', 'home');

        $title = 'Home';
        $type = $this->request->getVar('type');
        $nid = $this->request->getVar('nid');
        // $language = $this->request->getVar('language');
        // dd($title);
        // $uri = service('uri');
        // $path_url = $uri->getPath();
        // $path = 'website/home/body';

        // $result['title'] = $title;
        $result['type'] = $type;
        $result['nid'] = $nid;
        // $result['path'] = $path;
        // $result['arr_breadcrumbs'] = [];

        $passData = $this->dataArrayForMethodLinks($title, $result, true);

        return  $this->generalController->linksWebsite($passData);

        // $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        // $data = [
        //     'title' => $this->setTitle('Home'),
        //     'metaDescription' => $this->setMetaDescription($description),
        //     'layout' => $this->dirLayoutWebsite,
        //     'section' => $this->dirSectionWebsite
        // ];

        // return view('website/home/body', $data);
    }

    public function general()
    {

        $uri = service('uri');
        // $route_path = $uri->getRoutePath();
        // dd($route_path);
        // session()->set('menu', $route_path);
        $title = '';
        $type = $this->request->getVar('type');
        $nid = $this->request->getVar('nid');
        // $language = $this->request->getVar('language');
        $lang_code = $this->request->getVar('lang');
        $role_id = session()->get('role_id');
        $dataMenu = $this->menuManagementModel::menuAksesBySlug($uri->getSegment(1), $lang_code, $role_id);
        // $path_url = $uri->getPath();
        // dd("masuk");
        // $path = 'website/about/body';

        $result['type'] = $type;
        $result['nid'] = $nid;
        $result['dataMenu'] = $dataMenu;
        // $result['path'] = $path;
        // $result['arr_breadcrumbs'] = [];
        $is_website = false;

        if ($dataMenu) {
            $is_website == false;
        } else {
            $is_website == true;
        }

        $passData = $this->dataArrayForMethodLinks($title, $result, $is_website);

        return  $this->generalController->generalView($passData);

        // session()->set('menu', 'home');

        // $title = 'Home';
        // $type = $this->request->getVar('type');
        // $nid = $this->request->getVar('nid');
        // $language = $this->request->getVar('language');
        // $uri = service('uri');
        // $path_url = $uri->getPath();
        // $path = 'website/home/body';

        // $result['title'] = $title;
        // $result['type'] = $type;
        // $result['nid'] = $nid;
        // $result['path'] = $path;
        // $result['arr_breadcrumbs'] = [];

        // $passData = $this->dataArrayForMethodLinks($title, $result, true);

        // return  $this->generalController->linksWebsite($passData);

        // $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        // $data = [
        //     'title' => $this->setTitle('Home'),
        //     'metaDescription' => $this->setMetaDescription($description),
        //     'layout' => $this->dirLayoutWebsite,
        //     'section' => $this->dirSectionWebsite
        // ];

        // return view('website/home/body', $data);
    }

    public function terms()
    {
        session()->set('menu', 'home');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Terms and Conditions'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/home/terms-conditions', $data);
    }

    public function privacy()
    {
        session()->set('menu', 'home');
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente inventore natus, ullam explicabo accusantium dicta.";
        $data = [
            'title' => $this->setTitle('Terms and Conditions'),
            'metaDescription' => $this->setMetaDescription($description),
            'layout' => $this->dirLayoutWebsite,
            'section' => $this->dirSectionWebsite
        ];

        return view('website/home/privacy-policy', $data);
    }
}
