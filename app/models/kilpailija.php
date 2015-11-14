<?php

class Kilpailija extends BaseModel{

	public $id, $nimi, $seura, $kansallisuus, $syntymavuosi;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function kaikki(){
		$kysely = DB::connection()->prepare('SELECT * FROM Kilpailija');
		$kysely->execute();
		$rivit = $kysely->fetchAll();
		$kilpailijat = array();

		foreach($rivit as $rivi){
			$kilpailijat[] = new Kilpailija(array(
				'id' => $rivi['id'],
				'nimi' => $rivi['nimi'],
				'seura' => $rivi['seura'],
				'kansallisuus' => $rivi['kansallisuus'],
				'syntymavuosi' => $rivi['syntymavuosi']
			));
		}

		return $kilpailijat;
	}

	public static function etsi($id){
		$kysely = DB::connection()->prepare('SELECT * FROM Kilpailija WHERE id = :id LIMIT 1');
		$kysely->execute(array('id' => $id));
		$rivi = $kysely->fetch();

		if($rivi){
			$kilpailija = new Kilpailija(array(
				'id' => $rivi['id'],
				'nimi' => $rivi['nimi'],
				'seura' => $rivi['seura'],
				'kansallisuus' => $rivi['kansallisuus'],
				'syntymavuosi' => $rivi['syntymavuosi']
			));

			return $kilpailija;
		}

		return null;
	}

	public function talleta(){
		$kysely = DB::connection()->prepare('INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES (:nimi, :seura, :kansallisuus, :syntymavuosi) RETURNING id');
		$kysely->execute(array('nimi' => $this->nimi, 'seura' => $this->seura, 'kansallisuus' => $this->kansallisuus, 'syntymavuosi' => $this->syntymavuosi));
		$rivi = $kysely->fetch();
		$this->id = $rivi['id'];
	}
}