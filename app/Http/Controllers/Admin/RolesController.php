<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RolesController extends Controller {

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
        $itemsPerPage = Input::get('perpage') ? Input::get('perpage') : 2;
        $page = Input::get('page') ? Input::get('page') : 1;
        $result = Roles::paginate($itemsPerPage, null, null, $page);
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
            'item' => $id ? Roles::find($id) : null
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
                $item = Roles::find($post['id']);
            } else {
                $item = new Roles;
            }
            $item->name = $post['name'];
            $item->label = $post['label'];

            if(!$item->save()) {
                throw new \Exception('Erro ao salvar Perfil.');
            }

            return [
                'item' => $item,
                'status' => 'success',
                'message' => 'Perfil salvo com sucesso.'
            ];
        }catch (\Exception $e) {
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
            Roles::destroy($id);
            return [
                'status' => 'success',
                'message' => 'Perfil removido com sucesso.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
