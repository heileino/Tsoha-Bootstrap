<?php


class Tulos extends BaseModel{
	
	public $kilpailija, $kilpailu, $ajanmittauspiste, $aika;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array('validate_nimi', 'validate_jarjestaja', 'validate_paivamaara', 'validate_alkamisaika');
	}

	public function all(){
		$query = DB::connection()->prepare('SELECT * FROM Tulos');
		$query->execute();
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

	public function find($kilpailija, $kilpailu, $ajanmittauspiste){
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