<?php

/* Luokka määrittää kilpailun osallistujan ominaisuudet ja palvelut */
class Osallistuja extends BaseModel{
	public $kilpailu, $kilpailija;

	/* Osallistuja-luokan konstruktori */
	public function __construct($attributes){
		parent::__construct($attributes);
		// $this->validators = array();
	}
	/* Metodi palauttaa kaikki parametrina saadun kilpailutunnuksen määrittämän kilpailun osallistujat */
	public static function all($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Osallistuja WHERE Osallistuja.kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$osallistuja = array();

		foreach($rows as $row){
			$osallistujat[] = new Osallistuja(array(
				'kilpailu' => $kilpailu_id,
				'kilpailija' => $row['kilpailija']
			));
		}

		return $osallistujat;
	}
	/* Metodi palauttaa kaikki paramerina saatua kilpailutunnusta vastaavan kilpailun osallistujien kilpailijatiedot */
	public static function all_kilpailija_data($kilpailu_id){
		$query = DB::connection()->prepare('SELECT Kilpailija.id as kilpailija_id, Kilpailija.nimi as kilpailija_nimi, Kilpailija.seura as kilpailija_seura, Kilpailija.kansallisuus as kilpailija_kansallisuus FROM Osallistuja INNER JOIN Kilpailija ON Osallistuja.kilpailija = Kilpailija.id WHERE osallistuja.kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$osallistujat = array();

		foreach($rows as $row){
			$osallistujat[] = array(
				'kilpailu' => $kilpailu_id,
				'kilpailija_id' => $row['kilpailija_id'],		
				'kilpailija_nimi' => $row['kilpailija_nimi'],
				'kilpailija_seura' => $row['kilpailija_seura'],
				'kilpailija_kansallisuus' => $row['kilpailija_kansallisuus']
			);
		}

		return $osallistujat;
	}

	/* Metodi palauttaa kaikkien niiden kilpailijoiden tiedot, jotka eivät ole osallistujina parametrina saadun kilpailutunnuksta vastaavassa kilpailussa */
	public static function all_not_osallistuja($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE kilpailija.id not IN (SELECT osallistuja.kilpailija FROM Osallistuja WHERE osallistuja.kilpailu = :kilpailu)');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$ei_osallistujat = array();

		foreach($rows as $row){
			$ei_osallistujat[] = array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'seura' => $row['seura'],
				'kansallisuus' =>$row['kansallisuus'],
				'syntymavuosi' => $row['syntymavuosi']
			);
		}

		return $ei_osallistujat;
	}
	
	/* Metodi etsii ja palattaa parametrina saatua kilpailutunnusta ja kilpailijatunnusta vastaavan osallistujan */
	public static function find($kilpailu, $kilpailija){
		$query = DB::connection()->prepare('SELECT * FROM Osallistuja WHERE $kilpailu = :kilpailu AND $kilpailija = :kilpailija LIMIT 1');
		$query->execute(array('kilpailu' => $kilpailu, 'kilpailija' => $kilpailija));
		$row = $query->fetch();

		if($row){
			$osallistuja = new Osallistuja(array(
				'kilpailu' => $row['kilpailu'],
				'kilpailija' => $row['kilpailija']
			));

			return $osallistuja;
		}

		return null;
	}

	/* Metodi tallentaa attribuuttien tietosisällön tietokantaan */
	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Osallistuja (kilpailu, kilpailija) VALUES (:kilpailu, :kilpailija)');
		$query->execute(array('kilpailu' => $this->kilpailu, 'kilpailija' => $this->kilpailija));
		$row = $query->fetch();
	}

	/* Metodi päivittää attribuuttien arvot tietokantaan */
	public function update(){
		$query = DB::connection()->prepare('UPDATE Osallistuja SET kilpailija = :kilpailija WHERE kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $this->kilpailu, 'kilpailija' => $this->kilpailija));
		$row = $query->fetch();
	}

	/* Metodi poistaa attribuutien tietoja vastaavan rivin tietokannasta */
	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Osallistuja WHERE kilpailu = :kilpailu AND kilpailija = :kilpailija');
		$query->execute(array('kilpailu' => $this->kilpailu, 'kilpailija' => $this->kilpailija));
		$query->fetch();

	}

}