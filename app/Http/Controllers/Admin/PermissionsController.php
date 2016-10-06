<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PermissionsController extends Controller {

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
        $result = Permissions::paginate($itemsPerPage, null, null, $page);
        
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
            'item' => $id ? Permissions::find($id) : null
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
                $item = Permissions::find($post['id']);
            } else {
                $item = new Permissions;
            }
            $item->name = $post['name'];
            $item->label = $post['label'];

            if(!$item->save()) {
                throw new \Exception('Erro ao salvar Permissão.');
            }

            return [
                'item' => $item,
                'status' => 'success',
                'message' => 'Permissão salvo com sucesso.'
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
            Permissions::destroy($id);
            return [
                'status' => 'success',
                'message' => 'Permissão removida com sucesso.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
