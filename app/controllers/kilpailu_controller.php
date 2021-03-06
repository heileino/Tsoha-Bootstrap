<?php
/* Luokka toimii kontrollerina kilpailun mallien ja näkymien välillä */
class KilpailuController extends BaseController{
	/* Metodi kerää kaikki järjestelmän kilpailut ja tarjoaa ne kilpailujen listauksesta vastaavalle näkymälle */
	public static function index(){
		$kilpailut = Kilpailu::all();
		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}
    /* Metodi kerää kaikki kirjautuneen käyttäjän kilpailut ja tarjoaa ne käyttäjän omien kilpailujen listauksesta vastaavalle näkymälle */
	public static function ownlist(){
		self::check_logged_in();
		$kayttaja = self::get_user_logged_in();
		$kilpailut = Kilpailu::all_by_user($kayttaja->id);
		View::make('kilpailu/kilpailu_omalista.html', array('kilpailut' => $kilpailut));
	}

	public static function show($id){
		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/kilpailu_esittely.html', array('kilpailu' => $kilpailu));
	}
	/* Metodi tarkistaa käyttäjän kirjautumisen ja ohjaa uuden kilpailun luomisesta vastaavaan näkymään */
	public static function create(){
		self::check_logged_in();
		View::make('kilpailu/kilpailu_uusi.html');
	}
	/* Metodi tallentaa kilpailun tallennuksesta vastaavalta näkymältä saadut uuden kilpailun tiedot tietokantaan kilpailunmallin kautta */
	public static function store(){
		self::check_logged_in();
		$params = $_POST;
		$kayttaja = self::get_user_logged_in();
		$kilpailu = new Kilpailu(array(
			'nimi' => $params['nimi'],
			'kayttaja' => $kayttaja->id,
			'paivamaara' => $params['paivamaara'],	
			'alkamisaika' => $params['alkamisaika'],
			'jarjestaja' => $params['jarjestaja']
		));
		
		$errors = $kilpailu->errors();

		if(count($errors) > 0){
			View::make('kilpailu/kilpailu_uusi.html', array('errors' => $errors, 'kilpailu' => $kilpailu));
		} else{
			$kilpailu->save();
			Redirect::to('/omakilpailulista', array('message' => 'Kilpailu on lisätty tietokantaan!'));
		}
		
	}

	public static function edit($id){
		self::check_logged_in();
		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/kilpailu_muokkaus.html', array('kilpailu' => $kilpailu));
	}
	/* Metodi saa kilpailutietojen päivitysnäkymän lomaketiedot, jotka se tarkistuttaa ja päivityttää tiedot mallin avulla tietokantaan 
	tai palauttaa virheilmoituksineen takaisin päivitysnäkymään */
	public static function update($id){
		self::check_logged_in();
		$params = $_POST;
		$user = self::get_user_logged_in();
		$attributes = array(
			'id' => $id,
			'kayttaja' => $user->id,
			'nimi' => $params['nimi'],
			'jarjestaja' => $params['jarjestaja'],
			'paivamaara' => $params['paivamaara'],
			'alkamisaika' => $params['alkamisaika']
		);
		
		$kilpailu = new Kilpailu($attributes);
		$errors = $kilpailu->errors();
		

		if(count($errors) > 0){
			View::make('kilpailu/kilpailu_muokkaus.html', array('errors' => $errors, 'kilpailu' => $kilpailu));
		} else{
			$kilpailu->update();
			Redirect::to('/omakilpailulista', array('message' => 'Kilpailutietojen muokkaus kohteessa ' . $kilpailu->nimi .' onnistui!')); 
		}
	}

	

	/* Metodi vastaanottaa tunnuksen kilpailusta joka halutaan poistaa, hakee kyseisen kilpailun ilmentymän ja pyytää kilpailun mallia poistamaan kyseinen kilpailu tietokannasta */
	public static function destroy($id){
		$kilpailu = Kilpailu::find($id);//new Kilpailu(array('id' => $id));
		$kilpailu->destroy();
		Redirect::to('/omakilpailulista', array('message' => 'Kilpailun ' . $kilpailu->nimi . ' poisto onnistui!')); 
	}
}