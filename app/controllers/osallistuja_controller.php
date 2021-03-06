<?php

/* Luokka toimii kontrollerina kilpailun osallistujan mallin ja näkymän välillä */
class OsallistujaController extends BaseController{
	public static function show($kilpailu_id){
		$osallistujat = Osallistuja::all_kilpailija_data($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		View::make('osallistuja/osallistuja_lista.html', array('osallistujat' => $osallistujat, 'kilpailu' => $kilpailu));
	}

	// Metodi palauttaa kutsujalle parametrina saatua kilpailun tunnusta vastaavan kilpailun tiedot sekä taulukot kaikista osallistujista ja kilpailijoista
	public static function editlist($kilpailu_id){
		$osallistujat = Osallistuja::all_kilpailija_data($kilpailu_id);
		$osallistuvat_kilpailijat = Osallistuja::all_kilpailija_id($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		$kilpailijat = Kilpailija::all();
		View::make('osallistuja/osallistuja_listamuokkaus.html', array('osallistujat' => $osallistujat, 'kilpailu' => $kilpailu, 'kilpailijat' => $kilpailijat, 'osallistuvat' => $osallistuvat_kilpailijat));
	}
	// Metodi palauttaa kaikki ne kilpailijat, jotka eivät ole osallistujina parametrina saatuun kilpailuun
	public static function show_not_osallistuja($kilpailu_id){
		$ei_osallistujat = Osallistuja::all_not_osallistuja($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		View::make('osallistuja/osallistuja_lisaa.html', array('ei_osallistujat' => $ei_osallistujat, 'kilpailu' => $kilpailu));
	}

	// Metodi tallentaa parametrina saadun kilpailun osallistujiksi osallistujien lisäyksestä vastaavan näkymän lomakkeessa valitut kilpailijat.
	public static function store($kilpailu_id){
		$params = $_POST['uudet_osallistujat'];
		
		foreach($params as $kilpailija){
			$attributes = array(
			'kilpailu' => $kilpailu_id,
			'kilpailija' => $kilpailija
			);

			$osallistuja = new Osallistuja($attributes);
		
			$osallistuja->save();
		}
		
		Redirect::to('/kilpailu/' . $kilpailu_id . '/osallistujat', array('message' => 'Osallistuja lisätty onnistuneesti!')); 
	}
}