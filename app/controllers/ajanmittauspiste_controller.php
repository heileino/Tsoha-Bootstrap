<?php
/* Luokka toimii kontrollerina kilpailun ajanmittauspisteen mallin ja näkymän välillä */
class AjanmittauspisteController extends BaseController{
	
	/* Metodi hakee kaikki parametrina saadun kilpailun kaikki ajanmittauspisteet kilpailun tietoja käsittelevältä mallilta 
	ja välittää ne ajanmittaupisteiden listauksesta vastaavalle näkymälle */
	public static function show_from_kilpailu($kilpailu_id){
		$ajanmittauspisteet = Ajanmittauspiste::all($kilpailu_id);
		View::make('ajanmittauspiste/ajanmittauspiste_lista.html', array('ajanmittauspisteet' => $ajanmittauspisteet));
	}

	/* Metodi etsii ajanmittauspistettä identifioivien parametrien avulla ajanmittauspisteen tietoja käsittelevältä mallilta
	ja välittää ne ajanmittauspisteen esittelystä vastaavalle näkymälle */
	public static function show($kilpailu_id, $id){
		$ajanmittauspiste = Ajanmittauspiste::find($kilpailu_id, $id);
		View::make('ajanmittauspiste/ajanmittauspiste_esittely.html', array('ajanmittauspiste' => $ajanmittauspiste));
	}

	/* Metodi hakee parametrina saadun kilpailun kilpailun tietoja käsittelevältä mallilta ja välittää sen tiedot uuden ajanmittauspisteen luomisesta vastaavalle näkymälle */ 
	public static function create($kilpailu_id){
		self::check_logged_in();
		$kilpailu = Kilpailu::find($kilpailu_id);
		$kirjaajat = Kirjaaja::all();
		View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('kilpailu' => $kilpailu, 'kirjaajat' => $kirjaajat));
	}

	/* Metodi vastaanottaa näkymältä kilpailun tiedot ja tallentaa ne kilpailumallin avulla tietokantaan */
	public static function store($kilpailu_id){
		self::check_logged_in();
		$params = $_POST;
		$ajanmittauspiste = new Ajanmittauspiste(array(
			'etaisyys' => $params['etaisyys'],
			'kirjaaja' => $params['kirjaaja'],
			'kilpailu' => $kilpailu_id
		));
		$kirjaajat = Kirjaaja::all();
		
		$errors = $ajanmittauspiste->errors();

		if(count($errors) > 0){
			View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('errors' => $errors, 'ajanmittauspiste' => $ajanmittauspiste, 'kirjaajat' => $kirjaajat));
		} else{
			$ajanmittauspiste->save();
			Redirect::to('/kilpailu/' . $kilpailu_id, array('message' => 'Ajanmittauspiste on lisätty onnistuneesti kilpailuun!', 'ajanmittauspiste' => $ajanmittauspiste));
		}
	}
}