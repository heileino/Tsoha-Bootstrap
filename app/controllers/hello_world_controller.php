<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function tapahtumalista(){
      View::make('suunnitelmat/tapahtumalistasivu.html');
    }

    public static function kilpailija_esittely(){
      View::make('suunnitelmat/kilpailija_esittely.html');
    }

    public static function kilpailija_muokkaus(){
      View::make('suunnitelmat/kilpailija_muokkaus.html');
    }

    public static function kilpailu(){
      View::make('suunnitelmat/kisasivu.html');
    }

    public static function kilpailulista(){
      View::make('suunnitelmat/kisalistasivu.html');
    }

  }
