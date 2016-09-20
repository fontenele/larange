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
            'users/edit/:id' => [
                'json' => '/admin/users/edit/:id',
                'url' => 'users/edit/:id',
                'controller' => 'js/controllers/users-edit.js',
                'template' => 'view/users-edit'
            ],
            'users/edit' => [
                'json' => '/admin/users/edit',
                'url' => 'users/edit',
                'controller' => 'js/controllers/users-edit.js',
                'template' => 'view/users-edit'
            ],
            'users' => [
                'json' => '/admin/users',
                'url' => 'users',
                'controller' => 'js/controllers/users.js',
                'template' => 'view/users'
            ],
            'groups/edit/:id' => [
                'json' => '/admin/groups/:id',
                'url' => 'groups/edit',
                'controller' => 'js/controllers/groups-edit.js',
                'template' => 'view/groups-edit'
            ],
            'groups' => [
                'json' => '/admin/groups',
                'url' => 'groups',
                'controller' => 'js/controllers/groups.js',
                'template' => 'view/groups'
            ],
        ];
    }

    public function view($template) {
        if(view()->exists($template)) {
            return view($template);
        }

        return '<div>Template ' . $template . ' dont exists!</div>';
    }

}