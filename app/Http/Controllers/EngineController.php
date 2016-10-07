<?php namespace App\Http\Controllers;


class EngineController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function config() {
        $menus = [
            'guest' => [
            ],
            'default' => [
                ['url' => 'home', 'label' => 'Principal'],
                ['url' => 'view1', 'label' => 'Folha de Ponto'],
                ['url' => 'admin', 'label' => 'Admin'],
            ],
            'admin' => [
                ['url' => 'home', 'label' => 'Principal'],
                ['url' => 'admin', 'label' => 'Painel'],
                ['url' => 'roles', 'label' => 'Roles'],
                ['url' => 'permissions', 'label' => 'Permissions'],
                ['url' => 'users', 'label' => 'Users'],
            ]
        ];
        
        $routes = [
            "login" => [
                'json' => '/login',
                'url' => 'login',
                'controller' => 'js/controllers/auth/login.js',
                'template' => 'view/auth/login',
                'menu' => ['guest', ''],
            ],
            'home' => [
                'json' => '/home',
                'url' => 'home',
                'controller' => 'js/controllers/home.js',
                'template' => 'view/home',
                'menu' => ['default', 'home'],
            ],
            'view1' => [
                'json' => '/view1',
                'url' => 'view1',
                'controller' => 'js/controllers/view1.js',
                'template' => 'view/view1',
                'menu' => ['default', 'view1'],
            ],
            // Admin Module
            'admin' => [
                'json' => '/admin',
                'url' => 'admin',
                'controller' => 'js/controllers/admin/admin.js',
                'template' => 'view/admin/admin',
                'menu' => ['admin', 'admin'],
            ],
            // Users
            'users/edit/:id' => [
                'json' => '/admin/users/edit/:id',
                'url' => 'users/edit/:id',
                'controller' => 'js/controllers/admin/users-edit.js',
                'template' => 'view/admin/users-edit',
                'menu' => ['admin', 'users'],
            ],
            'users/edit' => [
                'json' => '/admin/users/edit',
                'url' => 'users/edit',
                'controller' => 'js/controllers/admin/users-edit.js',
                'template' => 'view/admin/users-edit',
                'menu' => ['admin', 'users'],
            ],
            'users' => [
                'json' => '/admin/users',
                'url' => 'users',
                'controller' => 'js/controllers/admin/users.js',
                'template' => 'view/admin/users',
                'menu' => ['admin', 'users'],
            ],
            // Roles
            'roles/edit/:id' => [
                'json' => '/admin/roles/edit/:id',
                'url' => 'roles/edit/edit/:id',
                'controller' => 'js/controllers/admin/roles-edit.js',
                'template' => 'view/admin/roles-edit',
                'menu' => ['admin', 'roles'],
            ],
            'roles/edit' => [
                'json' => '/admin/roles/edit',
                'url' => 'roles/edit',
                'controller' => 'js/controllers/admin/roles-edit.js',
                'template' => 'view/admin/roles-edit',
                'menu' => ['admin', 'roles'],
            ],
            'roles' => [
                'json' => '/admin/roles',
                'url' => 'roles',
                'controller' => 'js/controllers/admin/roles.js',
                'template' => 'view/admin/roles',
                'menu' => ['admin', 'roles'],
            ],
            'roles/:id/permissions' => [
                'json' => '/admin/roles/:id/permissions',
                'url' => 'roles/:id/permissions',
                'controller' => 'js/controllers/admin/roles-permissions.js',
                'template' => 'view/admin/roles-permissions',
                'menu' => ['admin', 'roles'],
            ],
            // Permissions
            'permissions/edit/:id' => [
                'json' => '/admin/permissions/edit/:id',
                'url' => 'permissions/edit/:id',
                'controller' => 'js/controllers/admin/permissions-edit.js',
                'template' => 'view/admin/permissions-edit',
                'menu' => ['admin', 'permissions'],
            ],
            'permissions/edit' => [
                'json' => '/admin/permissions/edit',
                'url' => 'permissions/edit',
                'controller' => 'js/controllers/admin/permissions-edit.js',
                'template' => 'view/admin/permissions-edit',
                'menu' => ['admin', 'permissions'],
            ],
            'permissions' => [
                'json' => '/admin/permissions',
                'url' => 'permissions',
                'controller' => 'js/controllers/admin/permissions.js',
                'template' => 'view/admin/permissions',
                'menu' => ['admin', 'permissions'],
            ],
            
        ];
        
        return ['routes' => $routes, 'menus' => $menus];
    }

    public function menus() {
        return [
            'guest' => [
            ],
            'logged' => [
                ['url' => 'home', 'label' => 'Home'],
                ['url' => 'view1', 'label' => 'View1'],
                ['url' => 'admin', 'label' => 'Admin'],
            ],
            'admin' => [
                ['url' => 'admin', 'label' => 'Painel'],
                ['url' => 'roles', 'label' => 'Roles'],
                ['url' => 'permissions', 'label' => 'Permissions'],
                ['url' => 'users', 'label' => 'Users'],
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