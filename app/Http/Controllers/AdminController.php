<?php namespace App\Http\Controllers;

use App\User;

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

        ];
	}

	/**
	 * Usuários
	 *
	 * @return Response
	 */
	public function users() {
		return [
            'list_items' => User::all()->toArray()
        ];
	}

	/**
	 * Editar Usuário
	 *
	 * @return Response
	 */
	public function editUser() {
		return [
//            'user' => User::all()->toArray()
        ];
	}

}
