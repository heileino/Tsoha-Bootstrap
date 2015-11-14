<?php

class KilpailuController extends BaseController{
	public static function index(){
		$kilpailut = Kilpailu::kaikki();
		View::make('kilpailu/index.html', array('kilpailut' => $kilpailut));
	}
}