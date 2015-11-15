<?php

class KilpailijaController extends BaseController{
	

	public static function kilpailijalista(){
		$kilpailijat = Kilpailija::all();
		View::make('kilpailija/kilpailijat_lista.html', array('kilpailijat' => $kilpailijat));
	}

	public static function kilpailijaesittely($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/kilpailija_esittely.html', array('kilpailija' => $kilpailija));
	}

	public static function store(){
		$params = $_POST;
		$kilpailija = new Kilpailija(array(
			'nimi' => $params['nimi'],
			'seura' => $params['seura'],
			'kansallisuus' => $params['kansallisuus'],
			'syntymavuosi' => $params['syntymavuosi']
		));

		$kilpailija->save();

		Redirect::to('/kilpailija', array('message' => 'Kilpailijan tiedot on lisätty tietokantaan!'));
	}

	public static function create(){
		View::make('kilpailija/uusi_kilpailija.html');
	}

	public static function muokkaa($id){
		$kilpailija = Kilpailija::etsi($id);
		View::make('kilpailija/kilpailija_muokkaus.html', array('kilpailija' => $kilpailija));
	}

	public static function paivita($id){
		$parametrit = $_POST;

		$attribuutit = array(
			'id' => $id,
			'nimi' => $parametrit['nimi'],
			'seura' => $parametrit['seura'],
			'kansallisuus' => $parametrit['kansallisuus'],
			'syntymavuosi' => $parametrit['syntymavuosi']
		);
		// HUOM! muista lisätä errorit myöhemmin
		$kilpailija = new Kilpailija($attribuutit);
		$kilpailija->paivita();

		Redirect::to('/kilpailija/' . $kilpailija->id, array('message' => 'Kilpailijan tietoja on muokattu onnistuneesti!'));
		
	}

	public static function poista($id){
		$kilpailija = new Kilpailija(array('id' => $id));
		$kilpailija->poista();

		Redirect::to('/kilpailija', array('message' => 'Kilpailijan tiedot on poistettu onnistuneesti tietokannasta!'));
	}
}