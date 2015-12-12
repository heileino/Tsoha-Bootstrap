<?php
/* Luokka toimii kontrollerina ajanmittauspisteen tuloksen mallin ja näkymän välillä */
class TulosController extends BaseController{
	/* Metodi */
	public static function show($kilpailu_id){
		$tulokset = Tulos::all($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kilpailu($kilpailu_id);
		View::make('tulos/tulos_etusivu.html', array('tulokset' => $tulokset, 'kilpailu' => $kilpailu, 'ajanmittauspisteet' => $ajanmittauspisteet));
	}
	/* Metodi hakee tulostietonäkymälle tietoja ajanottopisteen tulosten näyttämistä varten */
	public static function show_ajanottopiste_data($kilpailu_id){
		if(!empty($_POST)){
			$params = $_POST;
		$kilpailu = Kilpailu::find($kilpailu_id);
		$piste_id = $params['ajanmittauspiste'];
		$ajanmittauspiste = Ajanmittauspiste::find($kilpailu_id, $piste_id); // näkymän otsikointia varten
		$tuloksia = Tulos::all_from_ajanmittauspiste($kilpailu_id, $piste_id);
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kilpailu($kilpailu_id);

		View::make('tulos/tulos_etusivu.html', array('mittauspiste'=> $ajanmittauspiste, 'tuloksia' => $tuloksia, 'kilpailu' => $kilpailu, 'ajanmittauspisteet' => $ajanmittauspisteet));
	} else{
		Redirect::to('/kilpailu/' .$kilpailu_id. '/tulokset');
	}
		
	}

	/* Metodi hakee kilpailun ja kilpailijan tietoja mallilta ja tarjoaa niitä uuden tuloksen kirjaamisesta vastaavalle näkymälle */
	public static function create($kilpailu_id, $ajanmittauspiste_id){
		self::check_logged_in(); // TARKASTETTAVA KIRJAAJAN KIRJAUTUMINEN!
		$kilpailu = Kilpailu::find($kilpailu_id);
		$kilpailijat = Kilpailija::all();
		View::make('tulos/tulos_uusi.html', array('kilpailu' => $kilpailu, 'kilpailijat' => $kilpailijat));
	}
	/* Metodi vastaanottaa näkymältä uuden tuloskirjauksen tiedot ja tallentaa ne tulosmallin avulla tietokantaan */
	public static function store($kilpailu_id, $ajanmittauspiste_id){
		self::check_logged_in(); // TARKASTETTAVA KIRJAAJAN KIRJAUTUMINEN!
		$params = $_POST;
		$tulos = new Tulos(array(
			'kilpailija' => $params['kilpailija'],
			'kilpailu' => $kilpailu_id,
			'ajanmittauspiste' => $ajanmittauspiste_id,	
			'aika' => $params['aika']
		));
		
		$errors = $tulos->errors();

		if(count($errors) > 0){
			View::make('tulos/tulos_uusi.html', array('errors' => $errors, 'kilpailija' => $kilpailija_id, 'kilpailu' => $kilpailu_id, 'ajanmittauspiste' => $ajanmittauspiste));
		} else{
			$tulos->save();
			Redirect::to('/kilpailu/' .$kilpailu_id. '/tulokset', array('message' => 'Tulos on lisätty onnistuneesti!'));
		}

	}

}