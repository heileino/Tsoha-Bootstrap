<?php

/* Luokka määrittää toimitsijaroolin ominaisuudet ja palvelut */
class Toimitsija extends BaseModel{

public $kilpailu, $kirjaaja;
	
	/* Luokan konstruktori */
	public function __construct($attributes){
		parent::__construct($attributes);
	}

	/* Metodi palauttaa listan kaikista toimitsijarooli-ilmentymistä */
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Toimitsija');
		$query->execute();
		$rows = $query->fetchAll();
		$toimitsijat = array();

		foreach ($rows as $row) {
			$toimitsijat[] = new Toimitsija(array(
				'kilpailu' => $row['kilpailu'],
				'kirjaaja' => $row['kirjaaja']
			));
		}

		return $toimitsijat;
	}

}