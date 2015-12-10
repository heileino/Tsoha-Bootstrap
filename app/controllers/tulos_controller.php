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
		$ajanmittauspiste = Ajanmittauspiste::find($kilpailu_id, $piste_id); // näkymän ajanmittauspisteen otsikointia varten
		$tuloksia = Tulos::all_from_ajanmittauspiste($kilpailu_id, $piste_id);
		$ajanmittauspisteet = Ajanmittauspiste::all_from_kilpailu($kilpailu_id);

		View::make('tulos/tulos_etusivu.html', array('mittauspiste'=> $ajanmittauspiste, 'tuloksia' => $tuloksia, 'kilpailu' => $kilpailu, 'ajanmittauspisteet' => $ajanmittauspisteet));
	}
}