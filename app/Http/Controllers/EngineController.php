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
                'controller' => 'js/controllers/admin/admin.js',
                'template' => 'view/admin/admin'
            ],
            
            'users/edit/:id' => [
                'json' => '/admin/users/edit/:id',
                'url' => 'users/edit/:id',
                'controller' => 'js/controllers/admin/users-edit.js',
                'template' => 'view/admin/users-edit'
            ],
            'users/edit' => [
                'json' => '/admin/users/edit',
                'url' => 'users/edit',
                'controller' => 'js/controllers/admin/users-edit.js',
                'template' => 'view/admin/users-edit'
            ],
            'users' => [
                'json' => '/admin/users',
                'url' => 'users',
                'controller' => 'js/controllers/admin/users.js',
                'template' => 'view/admin/users'
            ],
            
            'roles/edit/:id' => [
                'json' => '/admin/roles/edit/:id',
                'url' => 'roles/edit/edit/:id',
                'controller' => 'js/controllers/admin/roles-edit.js',
                'template' => 'view/admin/roles-edit'
            ],
            'roles/edit' => [
                'json' => '/admin/roles/edit',
                'url' => 'roles/edit',
                'controller' => 'js/controllers/admin/roles-edit.js',
                'template' => 'view/admin/roles-edit'
            ],
            'roles' => [
                'json' => '/admin/roles',
                'url' => 'roles',
                'controller' => 'js/controllers/admin/roles.js',
                'template' => 'view/admin/roles'
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