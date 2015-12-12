<?php

class TulosController extends BaseController{
	
	public static function show($kilpailu_id){
		$tulokset = Tulos::all($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kilpailu($kilpailu_id);
		View::make('tulos/tulos_etusivu.html', array('tulokset' => $tulokset, 'kilpailu' => $kilpailu, 'ajanmittauspisteet' => $ajanmittauspisteet));
	}

	public static function show_ajanottopiste_data($kilpailu_id){
		$params = $_POST;
		$kilpailu = Kilpailu::find($kilpailu_id);
		$piste_id = $params['ajanmittauspiste'];
		$ajanmittauspiste = Ajanmittauspiste::find($kilpailu_id, $piste_id); // näkymän otsikointia varten
		$tuloksia = Tulos::all_from_ajanmittauspiste($kilpailu_id, $piste_id);
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kilpailu($kilpailu_id);

		View::make('tulos/tulos_etusivu.html', array('mittauspiste'=> $ajanmittauspiste, 'tuloksia' => $tuloksia, 'kilpailu' => $kilpailu, 'ajanmittauspisteet' => $ajanmittauspisteet));
	}

	public static function create($kilpailu_id, $ajanmittauspiste_id){
		self::check_logged_in(); // VAIHDETTAVA KIRJAAJAN TARKISTUKSEKSI!
		$kilpailu = Kilpailu::find($kilpailu_id);
		$kilpailijat = Kilpailija::all();
		View::make('tulos/tulos_uusi.html', array('kilpailu' => $kilpailu, 'kilpailijat' => $kilpailijat));
	}

	public static function store($kilpailu_id, $ajanmittauspiste_id){
		self::check_logged_in(); // VAIHDETTAVA KIRJAAJAN TARKISTUKSEKSI!
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
			Redirect::to('tulos/tulos_etusivu.html', array('message' => 'Kilpailu on lisätty tietokantaan!'));
		}

	}

	public static function update(){

	}


}