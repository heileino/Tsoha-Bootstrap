<?php

class KilpailijaController extends BaseController{
	

	public static function kilpailijalista(){
		$kilpailijat = Kilpailija::all();
		View::make('kilpailija/kilpailijat_lista.html', array('kilpailijat' => $kilpailijat));
	}

	public static function kilpailijaesittely($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/kilpailija_esittely.html', array('attributes' => $kilpailija));
	}

	public static function store(){
		$params = $_POST;
		$attributes = array(
			'nimi' => $params['nimi'],
			'seura' => $params['seura'],
			'kansallisuus' => $params['kansallisuus'],
			'syntymavuosi' => $params['syntymavuosi']
		);

		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();

		if(count($errors) == 0){
			$kilpailija->save();
			Redirect::to('/kilpailija', array('message' => 'Kilpailijan tiedot on lisätty tietokantaan!'));
		} else{
			View::make('kilpailija/kilpailija_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
		}
		
	}

	public static function create(){
		View::make('kilpailija/kilpailija_uusi.html');
	}

	public static function edit($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/kilpailija_muokkaus.html', array('attributes' => $kilpailija));
	}

	public static function update($id){
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'seura' => $params['seura'],
			'kansallisuus' => $params['kansallisuus'],
			'syntymavuosi' => $params['syntymavuosi']
		);
		
		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();
		

		if(count($errors) > 0){
			View::make('kilpailija/kilpailija_muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
		} else{
			$kilpailija->update();
			Redirect::to('/kilpailija/' . $kilpailija->id, array('message' => 'Kilpailijan tietoja on muokattu onnistuneesti!')); 
		}
		
	}

	public static function destroy($id){
		$kilpailija = new Kilpailija(array('id' => $id));
		$kilpailija->destroy();

		Redirect::to('/kilpailija', array('message' => 'Kilpailijan poisto onnistui!'));
	}
}