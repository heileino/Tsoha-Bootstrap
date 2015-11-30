<?php

class OsallistujaController extends BaseController{
	public static function show($id){
		$osallistujat = Osallistuja::all_return_names($id);
		View::make('osallistuja/osallistuja_lista.html', array('osallistujat' => $osallistujat));
	}
}