<?php

class Kilpailija extends BaseModel{

	public $id, $nimi, $seura, $kansallisuus, $syntymavuosi;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailijat = array();

		foreach($rows as $row){
			$kilpailijat[] = new Kilpailija(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'seura' => $row['seura'],
				'kansallisuus' => $row['kansallisuus'],
				'syntymavuosi' => $row['syntymavuosi']
			));
		}

		return $kilpailijat;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$kilpailija = new Kilpailija(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'seura' => $row['seura'],
				'kansallisuus' => $row['kansallisuus'],
				'syntymavuosi' => $row['syntymavuosi']
			));

			return $kilpailija;
		}

		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES (:nimi, :seura, :kansallisuus, :syntymavuosi) RETURNING id');
		$query->execute(array('nimi' => $this->nimi, 'seura' => $this->seura, 'kansallisuus' => $this->kansallisuus, 'syntymavuosi' => $this->syntymavuosi));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public function validate_nimi(){
		return parent::validate_string_lenght($this->nimi, 3);
	}

	public function validate_seura(){
		return parent::validate_string_lenght($this->seura, 2);
	}

	public function validate_kansallisuus(){
		return parent::validate_string_lenght($this->nimi, 2);
	}

	public function validate_syntymavuosi(){
		$errors = array();
		if($this->syntymavuosi < 1900 || $this->syntymavuosi > date('Y')){
			$errors[] = 'Syntymävuosi ei kelvannut!';
		}

		return $errors;
	}

	

	public function paivita(){
		$kysely = DB::connection()->prepare('UPDATE Kilpailija SET nimi = :nimi, seura = :seura, kansallisuus = :kansallisuus, syntymavuosi = :syntymavuosi RETURNING id');
		//$kysely->execute(array('nimi' => $this->nimi, 'seura' => $this->seura, 'kansallisuus' => $this->kansallisuus, 'syntymavuosi' => $this->syntymävuosi));
		$rivi = $kysely->fetch();
		$this->id = $rivi['id'];
	}

	public function poista(){
		$kysely = DB::connection()->prepare('DELETE FROM Kilpailija WHERE id = :id');
	}
}