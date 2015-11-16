<?php

class KilpailuController extends BaseController{
	public static function index(){
		$kilpailut = Kilpailu::all();
		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}

	public static function show($id){
		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/kilpailu_esittely.html', array('kilpailu' => $kilpailu));
	}

	public static function create(){
		View::make('kilpailu/kilpailu_uusi.html');
	}

	

	public static function store(){
		$params = $_POST;
		$kilpailu = new Kilpailu(array(
			'nimi' => $params['nimi'],
			'paivamaara' => $params['paivamaara'],	
			'alkamisaika' => $params['alkamisaika'],
		));

		Kint::dump($params);

		$kilpailu->save();

		//Redirect::to('/kilpailu/' . $kilpailu->id, array('message' => 'Kilpailu on lisätty tietokantaan!'));
	}
}