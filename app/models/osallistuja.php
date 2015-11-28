<?php

class Osallistuja extends BaseModel{
	public $kilpailu, $kilpailija;

	public function __construct($attributes){
		parent::__construct($attributes);
		//$this->validators = array();
	}

	public function all($kilpailu_id){
		$kilpailu = Kilpailu::find($kilpailu_id);
		$query = DB::connection()->prepare('SELECT * FROM Osallistuja WHERE Osallistuja.kilpailija = :kilpailu');
		$query->execute(array('kilpailu' => $kilpailu->id));
		$rows = $query->fetchAll();

		$osallistujat = array();

		foreach($rows as $row){
			$tulokset[] = new Osallistuja(array(
				'kilpailu' => $row['kilpailu'],
				'kilpailija' => $row['kilpailija']
			));
		}

		return $tulokset;
	}

	public function find($kilpailu, $kilpailija){
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