<?php

class KilpailijaController extends BaseController{
	public static function kilpailijalista(){
		$kilpailijat = Kilpailija::kaikki();
		View::make('kilpailija/kilpailijat_lista.html', array('kilpailijat' => $kilpailijat));
	}

	public static function kilpailijaesittely($id){
		$kilpailija = Kilpailija::etsi($id);
		View::make('kilpailija/kilpailija_esittely.html', array('kilpailija' => $kilpailija));
	}

	public static function tallenna(){
		$parametrit = $_POST;
		$kilpailija = new Kilpailija(array(
			'nimi' => $parametrit['nimi'],
			'seura' => $parametrit['seura'],
			'kansallisuus' => $parametrit['kansallisuus'],
			'syntymavuosi' => $parametrit['syntymavuosi']
		));

		Kint::dump($parametrit);


		$kilpailija->talleta();

		//Redirect::to('/kilpailija/' . $kilpailija->id, array('message' => 'Kilpailija lisätty tietokantaan!'));
	}

	public static function luoUusi(){
		View::make('kilpailija/uusi_kilpailija.html');
	}
}