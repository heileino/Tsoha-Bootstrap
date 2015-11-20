<?php

class JarjestajaController extends BaseController{
	public static function login(){
		View::make('jarjestaja/login.html');
	}
	public static function handle_login(){
		$params = $_POST;

		$jarjestaja = Jarjestaja::authenticate($params['tunnus'], $params['salasana']);

		if(!$jarjestaja){
			View::make('jarjestaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
		} else{
			$_SESSION['jarjestaja'] = $jarjestaja->id;

			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $jarjestaja->nimi . '!'));
		}
	}
}