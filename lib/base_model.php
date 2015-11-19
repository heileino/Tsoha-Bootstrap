<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

    public function validate_string_length($string, $length){
      $errors = array();
      if($string == '' || $string == null){
       $errors[] = 'Merkkijono ei saa olla tyhjä!';
      } else if(strlen($string) < $length){
        $errors[] = 'Liian lyhyt merkkijono!';
      }

      return $errors;
    }

    public function validate_year($input){
      $errors = array();
      if(!is_numeric($input)){
        $errors[] = 'Vuosiluvun täytyy sisältää ainoastaan numeroita!';
      } else if($input < 1900 || $input > date('Y')){
        $errors[] = 'Vuosiluku ei ollut kelvollinen';
      }
      return $errors;
    }

    public function validate_country_abbreviation($string){
      $errors = array();
      if(!preg_match('/^[A-Z][A-Z]{1,2}/', $string)){
        $errors[]  = 'Virheellinen maatunnus!';
      }

      return $errors;
    }

  }
