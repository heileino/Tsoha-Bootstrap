<?php

/* Luokka määrittää ajanmittauspisteen ominaisuudet ja palvelut */
class Kirjaaja extends BaseModel{

	public $id, $nimi, $tunnus, $salasana;

	/* Kirjaaja-luokan Konstruktori */
	public function __construct($attributes){
		parent::__construct($attributes);
	}

	/* Metodi palauttaa listan kaikista tietokannassa olevista kirjaajista */
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

	/* Metodi palauttaa kirjaajan ilmentymän, mikäli parametrina saadut tunnus ja salasana täsmäävät tietokannan kirjaajatietoihin */
	public static function authenticate($tunnus, $salasana){
		$query = DB::connection()->prepare('SELECT * FROM Kirjaaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
		$query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
		$row = $query->fetch();


		if($row){
			$kirjaaja = new Kayttaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $kirjaaja;
		} 
			
		return null;
		
	}

	/* Metodi palauttaa mahdollisen kirjaajan tiedot tietokannasta, mikäli se vastaa parametrina saatua kirjaajatunnusta */
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kirjaaja WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$kirjaaja = new Kirjaaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $kirjaaja;
		}

		return null;
	}	

	
}