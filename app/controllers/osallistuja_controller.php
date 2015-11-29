<?php

class OsallistujaController extends BaseController{
	public static function show($id){
		$osallistujat = Osallistuja::all_return_names($id);
		View::make('kilpailu/kilpailu_lahtolista.html', array('osallistujat' => $osallistujat));
	}
}