<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller  {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->beforeFilter('oauth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index() {
        $itemsPerPage = Input::get('perpage') ? Input::get('perpage') : 10;
        $page = Input::get('page') ? Input::get('page') : 1;
        $result = User::paginate($itemsPerPage, null, null, $page);

        foreach ($result->items() as &$item) {
            $item->total_roles = $item->roles->count();
        }
        
        return [
            'list' => $result->toArray()
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null) {
        return [
            'item' => $id ? User::find($id) : null
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        try {
            $post = $request->all();
            if($post['id']) {
                $item = User::find($post['id']);
            } else {
                $item = new User;
            }
            $item->name = $post['name'];
            $item->email = $post['email'];
            $item->password = \Hash::make('secret');

            if(!$item->save()) {
                throw new \Exception('Erro ao salvar Usuário.');
            }

            return [
                'user' => $item,
                'status' => 'success',
                'message' => 'Usuário salvo com sucesso.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
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