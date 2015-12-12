<?php

/* Luokka määrittää kilpailun ominaisuudet ja palvelut */
class Kilpailu extends BaseModel{
	
	public $id, $kayttaja_id, $nimi, $paivamaara, $alkamisaika, $jarjestaja;

	/* Luokan konstruktori */
	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi', 'validate_jarjestaja', 'validate_paivamaara', 'validate_alkamisaika');
	}

	/* Metodi listaa kaikki kilpailut */
	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu');
		$query->execute();
		$rows = $query->fetchAll();
		$kilpailut = array();

		foreach ($rows as $row) {
			$kilpailut[] = new Kilpailu(array(
				'id' => $row['id'],
				'kayttaja_id' => $row['kayttaja_id'],
				'nimi' => $row['nimi'],
				'paivamaara' => $row['paivamaara'],
				'alkamisaika' => $row['alkamisaika'],
				'jarjestaja' => $row['jarjestaja']
			));
		}

		return $kilpailut;
	}

	/* Metodi listaa kaikki parametrina saadulle käyttätunnukselle kuuluvat kilpailut */
	public static function all_by_user($user){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu WHERE kayttaja_id = :kayttaja_id');
		$query->execute(array('kayttaja_id' => $user));
		$rows = $query->fetchAll();
		$kilpailut = array();

		foreach ($rows as $row) {
			$kilpailut[] = new Kilpailu(array(
				'id' => $row['id'],
				'kayttaja_id' => $row['kayttaja_id'],
				'nimi' => $row['nimi'],
				'paivamaara' => $row['paivamaara'],
				'alkamisaika' => $row['alkamisaika'],
				'jarjestaja' => $row['jarjestaja']
			));
		}

		return $kilpailut;

	}

	
	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kilpailu WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$kilpailu = new Kilpailu(array(
				'id' => $row['id'],
				'kayttaja_id' => $row['kayttaja_id'],
				'nimi' => $row['nimi'],
				'paivamaara' => $row['paivamaara'],
				'alkamisaika' => $row['alkamisaika'],
				'jarjestaja' => $row['jarjestaja']
			));

			return $kilpailu;
		}

		return null;
	}
	
	/* Metodi tallentaa attribuuttien tietosisällön tietokantaan */
	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES (:nimi, :paivamaara, :alkamisaika, :jarjestaja) RETURNING id');
		$query->execute(array('nimi' => $this->nimi, 'paivamaara' => $this->paivamaara, 'alkamisaika' => $this->alkamisaika, 'jarjestaja' => $this->jarjestaja));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public function update(){
		$query = DB::connection()->prepare('UPDATE Kilpailu SET nimi = :nimi, jarjestaja = :jarjestaja, paivamaara = :paivamaara, alkamisaika = :alkamisaika WHERE id = :id');
		$query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'jarjestaja' => $this->jarjestaja, 'paivamaara' => $this->paivamaara, 'alkamisaika' => $this->alkamisaika));
		$row = $query->fetch();
	}

	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Kilpailu WHERE id = :id');
		$query->execute(array('id' => $this->id));
		$query->fetch();
	}

	public function validate_nimi(){
		return self::validate_string_length('Nimen', $this->nimi, 3);
	}

	public function validate_jarjestaja(){
		return self::validate_string_length('Järjestäjän nimen', $this->jarjestaja, 2);
	}

	public function validate_paivamaara(){
		return self::validate_date_format($this->paivamaara);
	}

	public function validate_alkamisaika(){
		return self::validate_time_format($this->alkamisaika);
	}
}