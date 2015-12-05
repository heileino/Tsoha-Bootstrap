<?php

class AjanmittauspisteController extends BaseController{
	
	// Metodi hakee kaikki parametrina saadun kilpailun kaikki ajanmittauspisteet kilpailun tietoja käsittelevältä mallilta 
	// ja välittää ne ajanmittaupisteiden listauksesta vastaavalle näkymälle 
	public static function list_by_kilpailu($kilpailu_id){
		$ajanmittauspisteet = Ajanmittauspiste::all($kilpailu_id);
		View::make('ajanmittauspiste/ajanmittauspiste_lista.html', array('ajanmittauspisteet' => $ajanmittauspisteet));
	}

	// Metodi etsii ajanmittauspistettä identifioivien parametrien avulla ajanmittauspisteen tietoja käsittelevältä mallilta
	// ja välittää ne ajanmittauspisteen esittelystä vastaavalle näkymälle
	public static function show($kilpailu_id, $id){
		$ajanmittauspiste = Ajanmittauspiste::find($kilpailu_id, $id);
		View::make('ajanmittauspiste/ajanmittauspiste_esittely.html', array('ajanmittauspiste' => $ajanmittauspiste));
	}

	// Metodi hakee parametrina saadun kilpailun kilpailun tietoja käsittelevältä mallilta ja välittää sen tiedot uuden ajanmittauspisteen luomisesta vastaavalle näkymälle  
	public static function create($kilpailu_id){
		self::check_logged_in();
		$kilpailu = Kilpailu::find($kilpailu_id);
		$kirjaajat = Kirjaaja::all();
		View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('kilpailu' => $kilpailu, 'kirjaajat' => $kirjaajat));
	}

	// Metodi luo uuden ajanmittaupiste-ilmentymän attribuuteilla, jotka se saa parametrina ja uuden ajanmittauspisteen luomisesta vastaavan näkymän lomakkeesta. 
	// Uuden ajanmittaupiste-ilmentymän avulla sen attribuuttien tiedot tallennetaan ajanmittauspisteen tietoja käsittelevän mallin avulla tietokantaan.
	public static function store($kilpailu_id){
		self::check_logged_in();
		//$kilpailu = Kilpailu::find($id);
		$params = $_POST;
		//$user_logged_in = self::get_user_logged_in();
		$ajanmittauspiste = new Ajanmittauspiste(array(
			'etaisyys' => $params['etaisyys'],
			'kirjaaja' => $params['kirjaaja'],
			'kilpailu' => $kilpailu_id
		));
		
		$errors = $ajanmittauspiste->errors();

		if(count($errors) > 0){
			View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('errors' => $errors, 'ajanmittauspiste' => $ajanmittauspiste));
		} else{
			$ajanmittauspiste->save();
			Redirect::to('/kilpailu/' . $kilpailu_id . '/ajanmittauspisteet', array('message' => 'Ajanmittauspiste on lisätty onnistuneesti kilpailuun!', 'ajanmittauspiste' => $ajanmittauspiste));
		}

	}
}