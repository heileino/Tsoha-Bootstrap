<?php

class Kilpailu extends BaseModel{
	
	public $id, $nimi, $paivamaara, $alkamisaika, $jarjestaja;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function kaikki(){
		
		$kysely = DB::connection()->prepare('SELECT Kilpailu.id, Kilpailu.nimi, paivamaara, alkamisaika, Jarjestaja.nimi as jarjestaja FROM Kilpailu INNER JOIN Jarjestaja On Jarjestaja.id=Kilpailu.jarjestaja');
		$kysely->execute();
		$rivit = $kysely->fetchAll();
		$kilpailut = array();

		foreach ($rivit as $rivi) {
			$kilpailut[] = new Kilpailu(array(
				'id' => $rivi['id'],
				'nimi' => $rivi['nimi'],
				'paivamaara' => $rivi['paivamaara'],
				'alkamisaika' => $rivi['alkamisaika'],
				'jarjestaja' => $rivi['jarjestaja']
			));
		}

		return $kilpailut;
	}

	public static function etsi($id){
		$kysely = DB::connection()->prepare('SELECT Kilpailu.id, Kilpailu.nimi, paivamaara, alkamisaika, Jarjestaja.nimi as jarjestaja FROM Kilpailu INNER JOIN Jarjestaja On Jarjestaja.id=Kilpailu.jarjestaja WHERE Kilpailu.id = :id LIMIT 1');
		$kysely->execute(array('id' => $id));
		$rivi = $kysely->fetch();

		if($rivi){
			$kilpailu = new Kilpailu(array(
				'id' => $rivi['id'],
				'nimi' => $rivi['nimi'],
				'paivamaara' => $rivi['paivamaara'],
				'alkamisaika' => $rivi['alkamisaika'],
				'jarjestaja' => $rivi['jarjestaja']
			));

			return $kilpailu;
		}

		return null;
	}
}