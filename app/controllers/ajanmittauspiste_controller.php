<?php

class AjanmittauspisteController extends BaseController{
	public static function create($kilpailu_id){
		self::check_logged_in();
		$kilpailu = Kilpailu::find($kilpailu_id);
		
		//$kirjaaja = Kirjaaja:all();
		View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('kilpailu' => $kilpailu)); //LISÄTÄÄN VIELÄ LUETTELO KIRJAAJISTA
	}

	public static function store($kilpailu_id){
		self::check_logged_in();
		$kilpailu = Kilpailu::find($id);
		$params = $_POST;
		//$user_logged_in = self::get_user_logged_in();
		$ajanmittauspiste = new Ajanmittauspiste(array(
			'etaisyys' => $params['etaisyys'],
			'kirjaaja' => $params['kirjaaja'],
			'kilpailu' => $kilpailu->id
		));
		
		$errors = $ajanmittauspiste->errors();

		if(count($errors) > 0){
			View::make('ajanmittauspiste/ajanmittauspiste_uusi.html', array('errors' => $errors, 'ajanmittauspiste' => $ajanmittauspiste));
		} else{
			$ajanmittauspiste->save();
			Redirect::to('/kilpailu/' . $kilpailu_id, array('message' => 'Ajanmittauspiste on lisätty onnistuneesti kilpailuun!', 'ajanmittauspiste' => $ajanmittauspiste));
		}

	}
}