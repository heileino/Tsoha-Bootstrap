
-- Jarjestaja-taulun testidata
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Kampin Hiihtoseura', 'kamppi', 'kamppi123');
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Töölön Sauva', 'töölö', 'töölö123');
-- Kilpailu-taulun testidata
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika) VALUES ('Kampin kisat miehet 30km vapaa', '2015-12-26', '12:00');
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika) VALUES ('Töölön hiihtokarnevaalit miehet 15km perinteinen', '2015-12-27', '13:00');
--Kilpailija-taulun testidata
INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES ('Hirmu Hiihtäjä', 'Kampin Hiihtoseura', 'FIN', 1949);
--Kirjaaja-taulun testidata
INSERT INTO Kirjaaja (nimi, tunnus, salasana) VALUES ('Kimmo Kirjuri', 'kimmo', 'kimmo123');