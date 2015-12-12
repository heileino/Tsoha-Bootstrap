<?php

/* Luokka toimii kontrollerina kilpailijan mallin ja näkymän välillä */
class KilpailijaController extends BaseController{
	
	/* Metodi listaa kaikki järjestelmässä olevat kilpailijat pyytämällä niitä kilpailijatietokannasta kilpailijan tietoja hallinnoivan mallin avulla.
	Lisäksi metodi ohjaa listaa kaikista kilpailuista näyttävälle näkymälle ja välittää sille taulukon kaikista haetuista kilpailijoista. */
	public static function show(){
		$kilpailijat = Kilpailija::all();
		View::make('kilpailija/kilpailija_lista.html', array('kilpailijat' => $kilpailijat));
	}
	
	/* Metodi hakee parametrina saatua id-tunnusta vastaavan kilpailijan tiedot*/
	public static function show_kilpailija($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/kilpailija_esittely.html', array('attributes' => $kilpailija));
	}

	/* Metodi ohjaa uuden uuden kilpailijan luomisesta vastaavaan näkymään */
	public static function create(){
		View::make('kilpailija/kilpailija_uusi.html');
	}
	
	/* Metodi vastaanottaa uuden kilpailijan luomisesta vastaavalta näkymälomakkeelta uuden kilpailijan luomiseen vaadittavat tiedot 
	ja tallentaa ne kilpailija-mallin kautta tietokantaan */
	public static function store(){
		$params = $_POST;
		$attributes = array(
			'nimi' => $params['nimi'],
			'seura' => $params['seura'],
			'kansallisuus' => $params['kansallisuus'],
			'syntymavuosi' => $params['syntymavuosi']
		);

		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();

		if(count($errors) == 0){
			$kilpailija->save();
			Redirect::to('/kilpailija', array('message' => 'Kilpailijan tiedot on lisätty tietokantaan!'));
		} else{
			View::make('kilpailija/kilpailija_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
		}	
	}
	
	/* Metodi hakee parametrina saadun tunnuksen avulla kilpailijan tiedot ja välittää ne kilpailijan tietojen muokkauksesta vastaavalle näkymälle */
	public static function edit($id){
		$kilpailija = Kilpailija::find($id);
		View::make('kilpailija/kilpailija_muokkaus.html', array('attributes' => $kilpailija));
	}
	/* Metodi vastaanottaa kilpailijan tietojen muokkauksesta vastaavan näkymän lomaketietoja ja päivittää tiedot kilpailija-mallin kautta tietokantaan */
	public static function update($id){
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'seura' => $params['seura'],
			'kansallisuus' => $params['kansallisuus'],
			'syntymavuosi' => $params['syntymavuosi']
		);
		
		$kilpailija = new Kilpailija($attributes);
		$errors = $kilpailija->errors();
		
		if(count($errors) > 0){
			View::make('kilpailija/kilpailija_muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
		} else{
			$kilpailija->update();
			Redirect::to('/kilpailija/' . $kilpailija->id, array('message' => 'Kilpailijan tietoja on muokattu onnistuneesti!')); 
		}
	}

	/* Metodi pyytää kilpailija-mallia poistamaan parametrina saatua tunnusta vastaavan kilpailu-ilmentymän */
	public static function destroy($id){
		$kilpailija = new Kilpailija(array('id' => $id));
		$kilpailija->destroy();

		Redirect::to('/kilpailija', array('message' => 'Kilpailijan poisto onnistui!'));
	}
}