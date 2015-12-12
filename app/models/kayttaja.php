<?php

/* Luokka määrittää järjestelmään rekisteröidyn käyttäjän ominaisuudet ja palvelut*/
class Kayttaja extends BaseModel{

	public $id, $nimi, $tunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($tunnus, $salasana){
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
		$query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
		$row = $query->fetch();


		if($row){
			$kayttaja = new Kayttaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $kayttaja;
		} else{
			return null;
		}
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$kayttaja = new Kayttaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $kayttaja;
		}

		return null;
	}	
}