<?php namespace App\Http\Controllers;

use App\Permissions;
use App\Roles;
use App\User;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->beforeFilter('oauth');
    }

	/**
	 * Painel administrativo
	 *
	 * @return Response
	 */
	public function home() {
		return [
            'total' => [
                'users' => User::all()->count(),
                'roles' => Roles::all()->count(),
                'permissions' => Permissions::all()->count(),
            ]
        ];
	}

}
