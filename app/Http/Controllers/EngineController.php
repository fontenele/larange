<?php namespace App\Http\Controllers;


class EngineController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function routes() {
        // @TODO CRUD FOR THIS
        return [
            "login" => [
                'json' => 'login',
                'url' => 'login',
                'controller' => 'js/controllers/auth/login.js',
                'template' => 'view/auth/login'
            ],
            'home' => [
                'json' => 'home',
                'url' => 'home',
                'controller' => 'js/controllers/home.js',
                'template' => 'view/home'
            ],
            'view1' => [
                'json' => 'view1',
                'url' => 'view1',
                'controller' => '',
                'template' => ''
            ],
            'admin' => [
                'json' => 'admin',
                'url' => 'admin',
                'controller' => '',
                'template' => ''
            ],
            'users' => [
                'json' => 'users',
                'url' => 'users',
                'controller' => '',
                'template' => ''
            ]
        ];
    }

    public function view($template) {
        if(view()->exists($template)) {
            return view($template);
        }

        return '<div>Template ' . $template . ' dont exists!</div>';
    }

    public function js($file) {
        dd($file);
        header("Content-type: text/javascript");

        $module = implode('/', explode('|', $module));
        $js = public_path() . "/js/controllers/{$module}";

        if($file) {
            $js.= "/{$file}";
        }

        if(file_exists($js)) {
            print file_get_contents($js);
        } else {
            echo 'console.log("JS file ' . $js . ' dont exists!")';
        }
        exit(0);
    }


}