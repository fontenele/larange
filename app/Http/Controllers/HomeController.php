<?php namespace App\Http\Controllers;

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
		$this->middleware('guest');
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
