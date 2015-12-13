<?php
/* Luokka määrittää ajanmittauspisteen ominaisuudet ja palvelut */
class Ajanmittauspiste extends BaseModel{
	
	public $id, $etaisyys, $kilpailu, $kirjaaja;
	/* Luokan konstruktori */
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_etaisyys');
	}

	/* Metodi palauttaa listan kaikista tietokannan ajanottopisteistä */
	public static function all(){
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

	/* Metodi palauttaa listan kaikista tietokannan ajanottopisteistä, jotka kuuluvat parametrina saatua kilpailutunnusta vastaavaan kilpailuun */
	public static function all_from_kilpailu($kilpailu_id){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste WHERE kilpailu = :kilpailu ORDER BY etaisyys ASC');
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

	/* Metodi palauttaa listan kaikista tietokannan ajanottopisteistä, jotka kuuluvat parametrina saatua kilpailutunnusta vastaavaan kilpailuun */
	public static function all_from_kirjaaja($kirjaaja_id){
		$query = DB::connection()->prepare('SELECT DISTINCT Kilpailu.id as kilpailu_id, Kilpailu.nimi as kilpailu_nimi, Ajanmittauspiste.id as ajanmittauspiste_id, Ajanmittauspiste.etaisyys as etaisyys FROM Ajanmittauspiste, Kilpailu, Toimitsija WHERE Ajanmittauspiste.kirjaaja = :kirjaaja_id AND Toimitsija.kilpailu = Kilpailu.id');		
		$query->execute(array('kirjaaja_id' => $kirjaaja_id));
		$rows = $query->fetchAll();
		$ajanmittauspisteet = array();

		foreach($rows as $row){
			$ajanmittauspisteet[] = array(
				'kilpailu_id' => $row['kilpailu_id'],
				'kilpailu_nimi' => $row['kilpailu_nimi'],
				'ajanmittauspiste_id' => $row['ajanmittauspiste_id'],
				'etaisyys' => $row['etaisyys']
			);				
		}

		return $ajanmittauspisteet;


	}
	/* Metodi etsii ja palauttaa parametrina saamaansa kilpailutunnusta ja ajanmittauspistetunnusta vastaavan ajanmittauspisteen */
	public static function find($kilpailu_id, $ajanmittauspiste_id){
		$query = DB::connection()->prepare('SELECT * FROM Ajanmittauspiste WHERE id = :id  AND kilpailu = :kilpailu LIMIT 1');
		$query->execute(array('id' => $ajanmittauspiste_id, 'kilpailu' => $kilpailu_id));
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

	/* Metodi tallentaa attribuuttien tietosisällön tietokantaan */
	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Ajanmittauspiste (etaisyys, kilpailu, kirjaaja) VALUES (:etaisyys, :kilpailu, :kirjaaja) RETURNING id');
		$query->execute(array('etaisyys' => $this->etaisyys, 'kilpailu' => $this->kilpailu, 'kirjaaja' => $this->kirjaaja));
		$row = $query->fetch();
		$this->id = $row['id'];
	}


	public function update(){
		
	}

	public function destroy(){

	}

	/* Validaattori testaa etäisyydeksi annetun syötteen oikeellisuuden */
	public function validate_etaisyys(){
		return self::validate_distance($this->etaisyys);
	}

}