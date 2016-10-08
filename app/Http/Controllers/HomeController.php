<?php namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	    $this->beforeFilter('oauth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index() {
		return view('home');
	}

	public function home() {
		return [
		    'total_funcionarios' => rand(1, 500),
		    'total_pagar' => rand(1, 500),
		    'total_horas' => rand(1, 50),
        ];
	}

    public function profileSave(Request $request) {
        $post = $request->all();
        $userId = \Session::get('user')->id;
        $user = User::find($userId);
        
        $user->email = $post['email'];
        $user->name = $post['name'];
        $user->avatar = $post['avatar'];
        $user->theme = $post['theme'];
        
        if($user->save()) {
            return [
                'user' => $user->toArray(),
                'message' => 'Conta de usuário salva com sucesso.',
                'status' => 'success',
            ];
        }
	}

	public function view1() {
		return [
		    'tela_view1' => 'Funcionou!!!',
            'students' => [
                ['name' => 'Mark Waugh', 'city' => 'New York'],
                ['name' => 'Steve Jonathan', 'city' => 'London'],
                ['name' => 'John Marcus', 'city' => 'Paris'],
                ['name' => 'Guilherme Fontenele', 'city' => 'Brasília'],
            ]
        ];
	}

}
