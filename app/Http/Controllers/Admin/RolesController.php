<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permissions;
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
        $result = Roles::paginate($itemsPerPage, null, null, $page)->toArray();
        
        foreach ($result['data'] as &$data) {
            $data['permissions'] = Roles::find($data['id'])->permissions->count();
        }
        
        return [
            'list' => $result
        ];
    }

    public function permissions($id) {
        $permissions = Permissions::all()->toArray();
        $permissionsParsed = [];
        
        foreach ($permissions as $permission) {
            $name = explode('.', $permission['name'])[0];
            if(!isset($permissionsParsed[$name])) {
                $permissionsParsed[$name] = [
                    'name' => $name,
                    'items' => []
                ];
            }
            $permissionsParsed[$name]['items'][] = $permission;
        }
        
        $role = Roles::find($id);
        
        $actives = $role->permissions()->getResults()->toArray();
        $activesParsed = [];
        foreach ($actives as $active) {
            $activesParsed[$active['name']] = $active;
        }
            
        return [
            'role' => $role->toArray(),
            'list' => $permissionsParsed,
            'actives' => $activesParsed
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

    public function savePermissions($id, Request $request) {
        $roles = [];
        foreach ($request->get('items') as $item) {
            $roles[] = preg_replace(["/active\[/", "/\]/"], "",  $item['name']);
        }
        
        $role = Roles::find($id)->permissions()->sync($roles);
        return [
            'status' => 'success',
            'message' => 'Permissões salvas com sucesso.'
        ];
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
