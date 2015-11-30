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

    public function validate_string_length($message, $string, $length){
      $errors = array();
      if($string == '' || $string == null){
       $errors[] = 'Merkkijono ei saa olla tyhjä!';
      } else if(strlen($string) < $length){
        $errors[] = $message . ' pituuden tulee olla vähintään ' . $length . ' merkkiä!';
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

    public function validate_date_format($input){
      $errors = array();
      $validator = new Valitron\Validator(array('input' => $input));
      $validator->rule('date', 'input');
      if(!$validator->validate()){
        $errors[] = 'Päivämäärä ei ollut sopiva!';
      }

      return $errors;
    }

    public function validate_time_format($input){
      $errors = array();
      if(!preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $input)){
        $errors[] = 'Aikamuoto ei ollut sopiva. Syötä aika muodossa "hh:mm"';
      }

      return $errors;
    }

    public function validate_distance($input){
      $errors = array();
      $validator = new Valitron\Validator(array('input' => $input));
      $validator->rule('numeric', 'input');
      if(!$validator->validate()){
        $errors[] = 'Etäisyys ei ollut sopiva!';
      }

      return $errors;
    }


  }
