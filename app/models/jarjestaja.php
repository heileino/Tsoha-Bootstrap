<?php

class Jarjestaja extends BaseModel{

	public $id, $nimi, $tunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($tunnus, $salasana){
		$query = DB::connection()->prepare('SELECT * FROM Jarjestaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
		$query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
		$row = $query->fetch();


		if($row){
			$jarjestaja = new Jarjestaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $jarjestaja;
		} else{
			return null;
		}
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Jarjestaja WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$jarjestaja = new Jarjestaja(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'tunnus' => $row['tunnus'],
				'salasana' => $row['salasana']
			));

			return $jarjestaja;
		}

		return null;
	}	
}