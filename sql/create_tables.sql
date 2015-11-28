CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(120) NOT NULL,
	tunnus varchar(60) NOT NULL,
	salasana varchar(60)
);

CREATE TABLE Kilpailu(
	id SERIAL PRIMARY KEY,
	kayttaja_id INTEGER REFERENCES Kayttaja(id) ON DELETE CASCADE,
	nimi varchar(100) NOT NULL,
	paivamaara DATE,
	alkamisaika TIME,
	jarjestaja varchar(120)
);

CREATE TABLE Kilpailija(
	id SERIAL PRIMARY KEY,
	nimi varchar(60) NOT NULL,
	seura varchar(120),
	kansallisuus varchar(3),
	syntymavuosi INTEGER
);

CREATE TABLE Kirjaaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(60) NOT NULL,
	tunnus varchar(60) NOT NULL,
	salasana varchar(60) NOT NULL
);

CREATE TABLE Toimitsijarooli(
	kilpailu INTEGER REFERENCES Kilpailu(id) ON DELETE CASCADE,
	kirjaaja INTEGER REFERENCES Kirjaaja(id) ON DELETE CASCADE,
	PRIMARY KEY(kilpailu, kirjaaja)
);

CREATE TABLE Ajanmittauspiste(
	id SERIAL,
	etaisyys DECIMAL,
	kilpailu INTEGER REFERENCES Kilpailu(id) ON DELETE CASCADE,
	kirjaaja INTEGER REFERENCES Kirjaaja(id) ON DELETE CASCADE,
	PRIMARY KEY(id, kilpailu)
);

CREATE TABLE Tulos(
	kilpailija INTEGER REFERENCES Kilpailija(id) ON DELETE CASCADE,
	kilpailu INTEGER,
	ajanmittauspiste INTEGER,
	aika TIME,
	PRIMARY KEY(kilpailija, kilpailu, ajanmittauspiste),
	FOREIGN KEY(ajanmittauspiste, kilpailu) REFERENCES Ajanmittauspiste(id, kilpailu) ON DELETE CASCADE
);

CREATE TABLE Osallistuja(
	kilpailu INTEGER REFERENCES Kilpailu(id) ON DELETE CASCADE,
	kilpailija INTEGER REFERENCES Kilpailija(id) ON DELETE CASCADE,
	PRIMARY KEY(kilpailu, kilpailija)
);