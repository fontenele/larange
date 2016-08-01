<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;

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
//		$this->middleware('auth');
		$this->middleware('jwt.auth');
//		$this->middleware('jwt.refresh');
        // RefreshToken.php:40
        // $resp = Response::make($response, 200)->header('Authorization', 'Bearer 2213213');
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
		    'tela_home' => 'Fontenele' . rand(1, 500),
            'message' => 'Bem vindo!!!'
        ];
	}

	public function view1(Response $response) {
//        $token = \JWTAuth::getToken();
//        $newToken = \JWTAuth::refresh($token);
//	    $response->setContent([
//	        'teste' => 123
//        ]);//->header('Authorization', $newToken);
//        return $response;
//        dd($response->getContent());
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
