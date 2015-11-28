
-- Jarjestaja-taulun testidata
INSERT INTO Kayttaja (nimi, tunnus, salasana) VALUES ('Teppo Testaaja', 'suksi', 'sauva');
INSERT INTO Kayttaja (nimi, tunnus, salasana) VALUES ('Kalle Kokeilija', 'kalle', 'kokeilija');
-- Kilpailu-taulun testidata
INSERT INTO Kilpailu (kayttaja_id, nimi, paivamaara, alkamisaika, jarjestaja) VALUES (1,'Kampin kisat miehet 30km vapaa', '2015-12-26', '12:00', 'Kampin Kisaveikot');
INSERT INTO Kilpailu (kayttaja_id, nimi, paivamaara, alkamisaika, jarjestaja) VALUES (1, 'Töölön hiihtokarnevaalit miehet 15km perinteinen', '2015-12-27', '13:00', 'Töölön Taisto');
-- Kilpailija-taulun testidata
INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES ('Hirmu Hiihtäjä', 'Kampin Hiihtoseura', 'FIN', 1949);
INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES ('Juhani Jalkatyö', 'Vuosaaren Viesti', 'EST', 1949);
-- Kirjaaja-taulun testidata
INSERT INTO Kirjaaja (nimi, tunnus, salasana) VALUES ('Kimmo Kirjuri', 'kimmo', 'kimmo123');
-- Toimitsijarooli-taulun testidata
INSERT INTO Toimitsijarooli (kilpailu, kirjaaja) VALUES (1, 1);
-- Ajanmittauspiste-taulun testidata
INSERT INTO Ajanmittauspiste (etaisyys, kilpailu, kirjaaja) VALUES (15.00, 1, 1);
-- Tulos-taulun testidata
INSERT INTO Tulos (kilpailija, kilpailu, ajanmittauspiste, aika) VALUES (1, 1, 1, '00:23:21.7');
-- Osallistuja-taulun testidata
INSERT INTO Osallistuja(kilpailu, kilpailija) VALUES (1, 1);