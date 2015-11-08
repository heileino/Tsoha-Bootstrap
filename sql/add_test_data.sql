
-- Jarjestaja-taulun testidata
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Kampin Hiihtoseura', 'kamppi', 'kamppi123');
INSERT INTO Jarjestaja (nimi, tunnus, salasana) VALUES ('Töölön Sauva', 'töölö', 'töölö123');
-- Kilpailu-taulun testidata
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES ('Kampin kisat miehet 30km vapaa', '2015-12-26', '12:00', (SELECT id from Jarjestaja WHERE nimi='Kampin Hiihtoseura'));
INSERT INTO Kilpailu (nimi, paivamaara, alkamisaika, jarjestaja) VALUES ('Töölön hiihtokarnevaalit miehet 15km perinteinen', '2015-12-27', '13:00', (SELECT id from Jarjestaja WHERE nimi='Töölön Sauva'));