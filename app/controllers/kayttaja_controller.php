<?php

class KayttajaController extends BaseController{
	public static function login(){
		View::make('kayttaja/login.html');
	}
	public static function handle_login(){
		$params = $_POST;

		$kayttaja = Kayttaja::authenticate($params['tunnus'], $params['salasana']);

		if(!$kayttaja){
			View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
		} else{
			$_SESSION['kayttaja'] = $kayttaja->id;

			Redirect::to('/omakilpailulista', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
		}
	}

	public static function logout(){
		$_SESSION['kayttaja'] = null;
		Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui!'));
	}
}