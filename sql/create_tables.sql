CREATE TABLE Jarjestaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(120) NOT NULL,
	tunnus varchar(60),
	salasana varchar(60)
);

CREATE TABLE Kilpailu(
	id SERIAL PRIMARY KEY,
	nimi varchar(100) NOT NULL,
	paivamaara DATE,
	alkamisaika TIME,
	jarjestaja INTEGER REFERENCES Jarjestaja(id)
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
	kilpailu INTEGER REFERENCES Kilpailu(id),
	kirjaaja INTEGER REFERENCES Kirjaaja(id),
	PRIMARY KEY(kilpailu, kirjaaja)
);

CREATE TABLE Ajanmittauspiste(
	id SERIAL,
	etaisyys DECIMAL,
	aika TIME,
	kilpailu INTEGER REFERENCES Kilpailu(id),
	kirjaaja INTEGER REFERENCES Kirjaaja(id),
	PRIMARY KEY(id, kilpailu)
);

CREATE TABLE Tulos(
	kilpailija INTEGER REFERENCES Kilpailija(id),
	kilpailu INTEGER,
	ajanmittauspiste INTEGER,
	PRIMARY KEY(kilpailija, kilpailu, ajanmittauspiste),
	FOREIGN KEY(ajanmittauspiste, kilpailu) REFERENCES Ajanmittauspiste(id, kilpailu)
);

CREATE TABLE Osallistuja(
	kilpailu INTEGER REFERENCES Kilpailu(id),
	kilpailija INTEGER REFERENCES Kilpailija(id),
	PRIMARY KEY(kilpailu, kilpailija)
);