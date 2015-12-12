<?php

public $kilpailu, $kirjaaja;

	public function __construct($attributes){
		parent::__construct($attributes);
		// tähän validaattorit
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Toimitsijarooli');
		$query->execute();
		$rows = $query->fetchAll();
		$toimitsijat = array();

		foreach ($rows as $row) {
			$toimitsijat[] = new Toimitsija(array(
				'kilpailu' => $row['kilpailu'],
				'kirjaaja' => $row['kirjaaja']
			));
		}

		return $toimitsijat;
	}