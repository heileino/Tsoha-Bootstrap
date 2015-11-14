<?php

  class HelloWorldController extends BaseController{
    
    
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    
    public static function sandbox(){
      // Testaa koodiasi täällä
      //View::make('helloworld.html');
      $kisa1 = Kilpailu::etsi(1);
      $kisat = Kilpailu::kaikki();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
      Kint::dump($kisat);
      Kint::dump($kisa1);

      $kilpailija1 = Kilpailija::etsi(1);
      $kilpailijat = Kilpailija::kaikki();
      Kint::dump($kilpailijat);
      Kint::dump($kilpailija1);
    }

    public static function kisalista_esittely(){
      View::make('suunnitelmat/kisalistasivu.html');
    }

    public static function kisalista_muokkaus(){
      View::make('suunnitelmat/kisalista_muokkaus.html');
    }

    public static function kilpailija_esittely(){
      View::make('suunnitelmat/kilpailija_esittely.html');
    }

    public static function kilpailija_muokkaus(){
      View::make('suunnitelmat/kilpailija_muokkaus.html');
    }

    public static function kilpailu_lopputulosesittely(){
      View::make('suunnitelmat/kisasivu_lopputulokset.html');
    }

    public static function kilpailu_muokkaus(){
      View::make('suunnitelmat/kisa_muokkaus.html');
    }

    public static function kilpailija_valiaika1(){
      View::make('suunnitelmat/kilpailija_kisaraportti_valiaika1.html');
    }

    public static function kilpailu_lahtolista(){
      View::make('suunnitelmat/lahtolista.html');
    }

    public static function kilpailijat_lista(){
      View::make('suunnitelmat/kilpailijat_lista.html');
    }
    
  }
