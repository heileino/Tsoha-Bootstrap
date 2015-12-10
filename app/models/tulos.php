<?php

class Tulos extends BaseModel{
	
	public $kilpailija, $kilpailu, $ajanmittauspiste, $aika;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array('');
	}

	public static function all($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Tulos WHERE Tulos.kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$tulokset = array();

		foreach($rows as $row){
			$tulokset[] = new Tulos(array(
				'kilpailija' => $row['kilpailija'],
				'kilpailu' => $row['kilpailu'],
				'ajanmittauspiste' => $row['ajanmittauspiste'],
				'aika' => $row['aika']
			));
		}

		return $tulokset;
	}

	public static function all_from_ajanmittauspiste($kilpailu_id, $ajanmittauspiste){
		$query = DB::connection()->prepare('SELECT Kilpailija.nimi as nimi, Kilpailija.seura as seura, Kilpailija.kansallisuus as kansallisuus, kilpailija, kilpailu, ajanmittauspiste, aika FROM Tulos, Kilpailija WHERE Tulos.kilpailija = Kilpailija.id AND Tulos.kilpailu = :kilpailu AND Tulos.ajanmittauspiste = :ajanmittauspiste ORDER BY aika ASC');
		$query->execute(array('kilpailu' => $kilpailu_id, 'ajanmittauspiste' => $ajanmittauspiste));
		$rows = $query->fetchAll();

		$tulokset = array();

		foreach($rows as $row){
			$tulokset[] = array(
				'nimi' => $row['nimi'],
				'seura' => $row['seura'],
				'kansallisuus' => $row['kansallisuus'],
				'kilpailija' => $row['kilpailija'],
				'kilpailu' => $row['kilpailu'],
				'ajanmittauspiste' => $row['ajanmittauspiste'],
				'aika' => $row['aika']
			);
		}

		return $tulokset;
	}


	public static function find($kilpailija, $kilpailu, $ajanmittauspiste){
		$query = DB::connection()->prepare('SELECT * FROM Tulos WHERE $kilpailija = :kilpailija AND $kilpailu = :kilpailu AND $ajanmittauspiste = :ajanmittauspiste LIMIT 1');
		$query->execute(array('kilpailija' => $kilpailija, 'kilpailu' => $kilpailu, 'ajanmittauspiste' => $ajanmittauspiste));
		$row = $query->fetch();

		if($row){
			$tulos = new Tulos(array(
				'kilpailija' => $row['kilpailija'],
				'kilpailu' => $row['kilpailu'],
				'ajanmittauspiste' => $row['ajanmittauspiste'],
				'aika' => $row['aika']
			));

			return $tulos;
		}

		return null;

	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Tulos (kilpailija, kilpailu, ajanmittauspiste, aika) VALUES (:etaisyys, :kilpailu, :ajanmittauspiste, :aika) RETURNING id');
		$query->execute(array('kilpailija' => $this->kilpailija, 'kilpailu' => $this->kilpailu, 'ajanmittauspiste' => $this->ajanmittauspiste));
		$row = $query->fetch();
	}

	public function update(){
		return null;

	}

	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Tulos WHERE kilpailija = :kilpailija AND kilpailu = :kilpailu AND ajanmittauspiste = :ajanmittauspiste');
		$query->execute(array('id' => $this->id));
		$query->fetch();

	}
}