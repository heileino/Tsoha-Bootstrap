<?php

/* Luokka toimii kontrollerina kirjaajan mallin ja näkymän välillä */
class KirjaajaController extends BaseController{
	
	/* Metodi ohjaa kirjaajan kirjautumisnäkymään */
	public static function login(){
		View::make('kirjaaja/kirjaaja_login.html');
	}

	/* Metodi luo uuden Kirjaaja-olion kirjautumisesta vastaavan näkymän lomaketietojen avulla
	ja ohjaa onnistuneen kirjautumisen jälkeen kirjaajan tulosmuokkaussivulle */
	public static function handle_login(){
		$params = $_POST;
		$kirjaaja = Kirjaaja::authenticate($params['tunnus'], $params['salasana']);

		if(!$kirjaaja){
			View::make('kirjaaja/kirjaaja_login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
		} else{
			$_SESSION['kirjaaja'] = $kirjaaja->id;

			Redirect::to('/omakirjaaja', array('message' => 'Tervetuloa takaisin ' . $kirjaaja->nimi . '!'));
		}
	}

	/* Metodi kirjaa kirjaajan ulos ja ohjaa järjestelmän sen jälkeen alkusivua ylläpitävään näkymään */
	public static function logout(){
		$_SESSION['kirjaaja'] = null;
		Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui!'));
	}

	public static function show(){
		$kirjaaja = self::get_kirjaaja_logged_in();
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kirjaaja($kirjaaja->id);
		View::make('kirjaaja/kirjaaja_esittely.html', array('ajanmittauspisteet' => $ajanmittauspisteet));
	}

}
