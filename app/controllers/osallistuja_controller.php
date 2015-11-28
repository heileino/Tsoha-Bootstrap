<?php

class OsallistujaController extends BaseController{
	public static function listaa($id){
		$osallistujat = Osallistuja::all($id);
		View::make('kilpailu/kilpailu_lahtolista.html', array('osallistujat' => $osallistujat));
	}
}