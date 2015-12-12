<?php

/* Luokka määrittää kilpailijan ominaisuudet ja palvelut*/
class Kilpailija extends BaseModel{

	public $id, $nimi, $seura, $kansallisuus, $syntymavuosi;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi', 'validate_seura', 'validate_kansallisuus', 'validate_syntymavuosi');
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

	
	public function update(){
		$query = DB::connection()->prepare('UPDATE Kilpailija SET nimi = :nimi, seura = :seura, kansallisuus = :kansallisuus, syntymavuosi = :syntymavuosi WHERE id = :id');
		$query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'seura' => $this->seura, 'kansallisuus' => $this->kansallisuus, 'syntymavuosi' => $this->syntymavuosi));
		$row = $query->fetch();

		
	}

	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Kilpailija WHERE id = :id');
		$query->execute(array('id' => $this->id));
		$query->fetch();
	}

	public function validate_nimi(){
		return self::validate_string_length('Nimen', $this->nimi, 3);
	}

	public function validate_seura(){
		return self::validate_string_length('Seuran nimen', $this->seura, 2);
	}

	public function validate_kansallisuus(){
		return self::validate_country_abbreviation($this->kansallisuus, 2);
	}

	public function validate_syntymavuosi(){
		return self::validate_year($this->syntymavuosi);
	}
}