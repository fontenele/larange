<?php namespace App\Http\Controllers;


class EngineController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function routes() {
        // @TODO CRUD FOR THIS
        return [
            "login" => [
                'json' => '/login',
                'url' => 'login',
                'controller' => 'js/controllers/auth/login.js',
                'template' => 'view/auth/login'
            ],
            'home' => [
                'json' => '/home',
                'url' => 'home',
                'controller' => 'js/controllers/home.js',
                'template' => 'view/home'
            ],
            'view1' => [
                'json' => '/view1',
                'url' => 'view1',
                'controller' => 'js/controllers/view1.js',
                'template' => 'view/view1'
            ],
            'admin' => [
                'json' => '/admin',
                'url' => 'admin',
                'controller' => 'js/controllers/admin.js',
                'template' => 'view/admin'
            ],
            'users' => [
                'json' => '/admin/users',
                'url' => 'users',
                'controller' => 'js/controllers/users.js',
                'template' => 'view/users'
            ]
        ];
    }

    public function view($template) {
        if(view()->exists($template)) {
            return view($template);
        }

        return '<div>Template ' . $template . ' dont exists!</div>';
    }

}