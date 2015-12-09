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
		$ajanmittauspiste = $params['ajanmittauspiste'];
		$tuloksia = Tulos::all_from_ajanmittauspiste($kilpailu_id, $ajanmittauspiste);	

		View::make('tulos/tulos_etusivu.html', array('tuloksia' => $tuloksia, 'kilpailu' => $kilpailu, 'mittauspiste' => $ajan2mittauspiste));

	}
}