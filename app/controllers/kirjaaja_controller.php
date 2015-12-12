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
		$kayttaja = Kirjaaja::authenticate($params['tunnus'], $params['salasana']);

		if(!$kirjaaja){
			View::make('kirjaaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
		} else{
			$_SESSION['kirjaaja'] = $kirjaaja->id;

			Redirect::to('/kilpailu', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
		}
	}

	/* Metodi kirjaa kirjaajan ulos ja ohjaa järjestelmän sen jälkeen alkusivua ylläpitävään näkymään */
	public static function logout(){
		$_SESSION['kirjaaja'] = null;
		Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui!'));
	}

}
