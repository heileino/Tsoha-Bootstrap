<?php

class Kilpailu extends BaseModel{
	
	public $id, $nimi, $paivamaara, $alkamisaika, $jarjestaja;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailut = array();

		foreach ($rows as $row) {
			$kilpailut[] = new Kilpailu(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'paivamaara' => $row['paivamaara'],
				'alkamisaika' => $row['alkamisaika'],
				'jarjestaja' => $row['jarjestaja']
			));
		}

		return $kilpailut;
	}

	
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu WHERE Kilpailu.id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$kilpailu = new Kilpailu(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'paivamaara' => $row['paivamaara'],
				'alkamisaika' => $row['alkamisaika'],
				'jarjestaja' => $row['jarjestaja']
			));

			return $kilpailu;
		}

		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES (:nimi, :paivamaara, :alkamisaika, :jarjestaja) RETURNING id');
		$query->execute(array('nimi' => $this->nimi, 'paivamaara' => $this->paivamaara, 'alkamisaika' => $this->alkamisaika, 'jarjestaja' => $this->jarjestaja));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}