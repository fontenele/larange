<?php namespace App\Http\Controllers;

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
	public function editUser($id = '') {
		return [
		    'user' => $id ? User::find($id) : null
        ];
	}
	
	/**
	 * Salvar Usuário
	 *
	 * @return Response
	 */
	public function saveUser() {
	    try {
            $post = Input::all();
            if($post['id']) {
                $user = User::find($post['id']);
            } else {
                $user = new User;
            }
            $user->name = $post['name'];
            $user->email = $post['email'];
            $user->password = \Hash::make('secret');
            
            if(!$user->save()) {
                throw new \Exception('Erro ao salvar usuário.');
            }
            
            return [
                'user' => $user,
                'status' => 'success',
                'message' => 'Usuário salvo com sucesso.'
            ];
        }catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
	}

    /**
     * Remover Usuário
     *
     * @return Response
     */
    public function removeUser($id) {
        try {
            User::destroy($id);
            return [
                'status' => 'success',
                'message' => 'Usuário removido com sucesso.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

}
