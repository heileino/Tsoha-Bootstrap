<?php

class KilpailuController extends BaseController{
	public static function index(){
		$kilpailut = Kilpailu::all();
		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}

	public static function ownlist(){
		self::check_logged_in();

		$user_logged_in = self::get_user_logged_in();
		$kilpailut = Kilpailu::all_by_user($user_logged_in->id);

		View::make('kilpailu/kilpailu_omalista.html', array('kilpailut' => $kilpailut));
	}

	public static function show($id){
		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/kilpailu_esittely.html', array('kilpailu' => $kilpailu));
	}

	public static function create(){
		self::check_logged_in();
		View::make('kilpailu/kilpailu_uusi.html');
	}

	public static function edit($id){
		$kilpailu = Kilpailu::find($id);
		View::make('kilpailu/kilpailu_muokkaus.html', array('kilpailu' => $kilpailu));
	}

	public static function update($id){
		self::check_logged_in();
		$params = $_POST;
		$user = self::get_user_logged_in();
		$attributes = array(
			'id' => $id,
			'kayttaja_id' => $user->id,
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

	public static function store(){
		self::check_logged_in();
		$params = $_POST;
		$kilpailu = new Kilpailu(array(
			'nimi' => $params['nimi'],
			'paivamaara' => $params['paivamaara'],	
			'alkamisaika' => $params['alkamisaika'],
			'jarjestaja' => $params['jarjestaja']
		));
		$user_logged_in = self::get_user_logged_in();


		$kilpailu->save_by_user($user_logged_in->id);

		Redirect::to('/kilpailu', array('message' => 'Kilpailu on lisätty tietokantaan!'));
	}

	public static function destroy($id){
		$kilpailu = new Kilpailu(array('id' => $id));
		$kilpailu->destroy();
		Redirect::to('/omakilpailulista', array('message' => 'Kilpailun ' . $kilpailu->nimi . ' poisto onnistui!')); 
	}
}