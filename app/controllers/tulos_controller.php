<?php

class TulosController extends BaseController{
	public static function show($kilpailu_id){
		$tulokset = Tulos::all($kilpailu_id);
		View::make('tulos/tulos_etusivu.html', array('tulokset' => $tulokset));
	}
}