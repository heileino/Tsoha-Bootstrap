<?php


class Ajanmittauspiste extends BaseModel{
	
	public $id, $etaisyys, $kilpailu, $kirjaaja;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array('validate_nimi', 'validate_jarjestaja', 'validate_paivamaara', 'validate_alkamisaika');
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

	public function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
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
		$this->kilpailu = $row['kilpailu'];
	}

	public function update(){
		return null;

	}

	public function destroy(){
		return null;

	}
}