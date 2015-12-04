<?php

class Osallistuja extends BaseModel{
	public $kilpailu, $kilpailija;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array();
	}

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

	public static function all_return_names($kilpailu_id){
		$query = DB::connection()->prepare('SELECT Kilpailija.nimi as kilpailija_nimi, Kilpailija.seura as kilpailija_seura FROM Osallistuja INNER JOIN Kilpailija ON Osallistuja.kilpailija = Kilpailija.id WHERE osallistuja.kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$osallistujat = array();

		foreach($rows as $row){
			$osallistujat[] = array(				
				'kilpailija_nimi' => $row['kilpailija_nimi'],
				'kilpailija_seura' => $row['kilpailija_seura']
			);
		}

		return $osallistujat;
	}

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

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Osallistuja (kilpailu, kilpailija) VALUES (:kilpailu, :kilpailija)');
		$query->execute(array('kilpailu' => $this->kilpailu, 'kilpailija' => $this->kilpailija));
		$row = $query->fetch();
	}

	public function update(){

	}

	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Osallistuja WHERE kilpailu = :kilpailu AND kilpailija = :kilpailija');
		$query->execute(array('kilpailu' => $this->kilpailu, 'kilpailija' => $this->kilpailija));
		$query->fetch();

	}

}