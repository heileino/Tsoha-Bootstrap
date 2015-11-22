
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
INSERT INTO Toimitsijarooli (kilpailu, kirjaaja) VALUES ((SELECT id FROM Kilpailu WHERE nimi like 'Kampin%'), (SELECT id FROM Kirjaaja WHERE nimi like 'Kimmo%'));
-- Ajanmittauspiste-taulun testidata
INSERT INTO Ajanmittauspiste (etaisyys, aika, kilpailu, kirjaaja) VALUES (15.00, '00:23:21.7', (SELECT id FROM Kilpailu WHERE nimi like 'Töölö%'), (SELECT id FROM Kirjaaja WHERE nimi like 'Kimmo%'));
-- Tulos-taulun testidata
INSERT INTO Tulos (kilpailija, kilpailu, ajanmittauspiste) VALUES ((SELECT id FROM Kilpailija WHERE nimi like 'Hirmu%'), (SELECT kilpailu FROM Ajanmittauspiste WHERE etaisyys=15.00), (SELECT id FROM Ajanmittauspiste WHERE etaisyys=15.00));
-- Osallistuja-taulun testidata
INSERT INTO Osallistuja(kilpailu, kilpailija) VALUES ((SELECT id FROM Kilpailu WHERE nimi like 'Kampin%'), (SELECT id FROM Kilpailija WHERE nimi like 'Hirmu%'));