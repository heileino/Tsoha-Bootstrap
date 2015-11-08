
-- Jarjestaja-taulun testidata
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Kampin Hiihtoseura', 'kamppi', 'kamppi123');
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Töölön Sauva', 'töölö', 'töölö123');
-- Kilpailu-taulun testidata
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES ('Kampin kisat miehet 30km vapaa', '2015-12-26', '12:00', (SELECT id FROM Jarjestaja WHERE nimi like 'Kampin%'));
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES ('Töölön hiihtokarnevaalit miehet 15km perinteinen', '2015-12-27', '13:00', (SELECT id FROM Jarjestaja WHERE nimi like 'Töölö%'));
-- Kilpailija-taulun testidata
INSERT INTO Kilpailija (nimi, seura, kansallisuus, syntymavuosi) VALUES ('Hirmu Hiihtäjä', 'Kampin Hiihtoseura', 'FIN', 1949);
-- Kirjaaja-taulun testidata
INSERT INTO Kirjaaja (nimi, tunnus, salasana) VALUES ('Kimmo Kirjuri', 'kimmo', 'kimmo123');
-- Toimitsijarooli-taulun testidata
INSERT INTO Toimitsijarooli (kilpailu, kirjaaja) VALUES ((SELECT id FROM Kilpailu WHERE nimi like 'Kampin%'), (SELECT id FROM Kirjaaja WHERE nimi like 'Kimmo%'));
-- Ajanmittauspiste-taulun testidata
INSERT INTO Ajanmittauspiste (etaisyys, aika, kilpailu, kirjaaja) VALUES (15.00, '00:23:21.7', (SELECT id FROM Kilpailu WHERE nimi like 'Töölö%'), (SELECT id FROM Kirjaaja WHERE nimi like 'Kimmo%'));