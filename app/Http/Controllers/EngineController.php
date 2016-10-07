<?php namespace App\Http\Controllers;


class EngineController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function config() {
        $menus = [
            'guest' => [
                'header' => 'Bem vindo, visitante!',
                'items' => [
                    ['url' => 'login', 'label' => 'Login', 'icon' => 'fa fa-link', 'acl' => ''],
                ]
            ],
            'default' => [
                'header' => 'Principal',
                'items' => [
                    ['url' => 'home', 'label' => 'Principal', 'icon' => 'fa fa-home', 'acl' => ''],
                    ['url' => 'view1', 'label' => 'Folha de Ponto', 'icon' => 'fa fa-folder-open', 'acl' => ''],
                    ['url' => 'admin', 'label' => 'Admin', 'icon' => 'fa fa-cogs', 'acl' => 'users.list'],
                ]
            ],
            'admin' => [
                'header' => 'Administração',
                'items' => [
                    ['url' => 'home', 'label' => 'Principal', 'icon' => 'fa fa-home', 'acl' => ''],
                    ['url' => 'admin', 'label' => 'Painel', 'icon' => 'fa fa-cogs', 'acl' => ''],
                    ['url' => 'roles', 'label' => 'Perfis', 'icon' => 'fa fa-sitemap', 'acl' => 'roles.list'],
                    ['url' => 'permissions', 'label' => 'Permissões', 'icon' => 'fa fa-shield', 'acl' => 'permissions.list'],
                    ['url' => 'users', 'label' => 'Usuários', 'icon' => 'fa fa-user', 'acl' => 'users.list'],
                ]
            ]
        ];
        
        $routes = [
            "login" => [
                'json' => '/login',
                'url' => 'login',
                'controller' => 'js/controllers/auth/login.js',
                'template' => 'view/auth/login',
                'menu' => ['guest', 'login'],
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

    public function view($template) {
        if(view()->exists($template)) {
            return view($template);
        }

        return '<div>Template ' . $template . ' dont exists!</div>';
    }

}