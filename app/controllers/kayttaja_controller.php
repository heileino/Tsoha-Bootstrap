<?php
/* Luokka toimii kontrollerina käyttäjän mallin ja näkymän välillä */
class KayttajaController extends BaseController{
	
	/* Metodi ohjaa kirjautumisnäkymään */
	public static function login(){
		View::make('kayttaja/login.html');
	}

	/* Metodi vastaanottaa kayttajan kirjautumisnäkymästä kirjautumistiedot, tarkistaa kirjautumisen onnistumisen ja joko ilmoittaa näkymälle kirjautumisen epäonnistumisesta 
	tai luo uuden käyttäjäsession näkymän käytettäväksi */
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

	/* Metodi kirjaa käyttäjän ulos ja ohjaa sen jälkeen alkusivua ylläpitävään näkymään */
	public static function logout(){
		$_SESSION['kayttaja'] = null;
		Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui!'));
	}
}