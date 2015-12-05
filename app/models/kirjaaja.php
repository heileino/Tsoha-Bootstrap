<?php

class Kirjaaja extends BaseModel{

	public $id, $nimi, $tunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
		// tähän validaattorit
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kirjaaja');
		$query->execute();
		$rows = $query->fetchAll();
		$kirjaajat = array();

		foreach ($rows as $row) {
			$kirjaajat[] = new Kirjaaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));
		}

		return $kirjaajat;
	}

	
}