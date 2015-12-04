<?php

class Kirjaaja extends BaseModel{

	public $id, $nimi, $tunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
		// tähän validaattorit
	}

	
}