<?php

class OsallistujaController extends BaseController{
	public static function show($kilpailu_id){
		$osallistujat = Osallistuja::all_return_names($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		View::make('osallistuja/osallistuja_lista.html', array('osallistujat' => $osallistujat, 'kilpailu' => $kilpailu));
	}

	public static function editlist($kilpailu_id){
		$osallistujat = Osallistuja::all_return_names($kilpailu_id);
		$kilpailu = Kilpailu::find($kilpailu_id);
		View::make('osallistuja/osallistuja_listamuokkaus.html', array('osallistujat' => $osallistujat, 'kilpailu' => $kilpailu));
	}
}