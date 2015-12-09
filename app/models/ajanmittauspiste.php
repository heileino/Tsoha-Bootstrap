<?php

class Ajanmittauspiste extends BaseModel{
	
	public $id, $etaisyys, $kilpailu, $kirjaaja;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_etaisyys');
	}

	public function all(){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste');
		$query->execute();
		$rows = $query->fetchAll();

		$ajanmittauspisteet = array();

		foreach($rows as $row){
			$ajanmittauspisteet[] = new Ajanmittauspiste(array(
				'id' => $row['id'],
				'etaisyys' => $row['etaisyys'],
				'kilpailu' => $row['kilpailu'],
				'kirjaaja' => $row['kirjaaja']
			));
		}

		return $ajanmittauspisteet;
	}

	public function all_from_kilpailu($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste WHERE kilpailu = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu_id));
		$rows = $query->fetchAll();

		$ajanmittauspisteet = array();

		foreach($rows as $row){
			$ajanmittauspisteet[] = new Ajanmittauspiste(array(
				'id' => $row['id'],
				'etaisyys' => $row['etaisyys'],
				'kilpailu' => $row['kilpailu'],
				'kirjaaja' => $row['kirjaaja']
			));
		}

		return $ajanmittauspisteet;

	}

	public function find($kilpailu_id, $id){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste WHERE id = :id  AND kilpailu = :kilpailu LIMIT 1');
		$query->execute(array('id' => $id, 'kilpailu' => $kilpailu_id));
		$row = $query->fetch();

		if($row){
			$ajanmittauspiste = new Ajanmittauspiste(array(
				'id' => $row['id'],
				'etaisyys' => $row['etaisyys'],
				'kilpailu' => $row['kilpailu'],
				'kirjaaja' => $row['kirjaaja']
			));

			return $ajanmittauspiste;
		}

		return null;

	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Ajanmittauspiste (etaisyys, kilpailu, kirjaaja) VALUES (:etaisyys, :kilpailu, :kirjaaja) RETURNING id');
		$query->execute(array('etaisyys' => $this->etaisyys, 'kilpailu' => $this->kilpailu, 'kirjaaja' => $this->kirjaaja));
		$row = $query->fetch();
		$this->id = $row['id'];
	}


	public function update(){
		return null;

	}

	public function destroy(){
		return null;

	}

	public function validate_etaisyys(){
		return self::validate_distance($this->etaisyys);
	}

}