<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      if(isset($_SESSION['kayttaja'])){
        $kayttaja_id = $_SESSION['kayttaja'];
        $kayttaja = Kayttaja::find($kayttaja_id);
        return $kayttaja;
      }

      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
      if(!isset($_SESSION['kayttaja'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }     
    }

    public static function check_kirjaaja_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
      if(!isset($_SESSION['kirjaaja'])){
        Redirect::to('/kirjaajalogin', array('message' => 'Kirjaudu ensin sisään!'));
      }     
    }

    public static function get_kirjaaja_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      if(isset($_SESSION['kirjaaja'])){
        $kirjaaja_id = $_SESSION['kirjaaja'];
        $kirjaaja = Kirjaaja::find($kirjaaja_id);
        return $kirjaaja;
      }

      return null;
    }

  }
