insert into compteutilisateur (idU, nomU, prenomU, moyenne, age, genre, adresse, ville, pays, cp, mail, telephone, mdp) VALUES
('emeric.tosi@gmail.com', 'Tosi', 'Genie-Emeric', 5, 20, 1, '6 avenue des peupliers', 'Toulouse', 'France', 31400, 'emeric.tosi@gmail.com', 0666006660, 'mdp'),
('massip.thomas@gmail.com', 'Massip','Idiot-Thomas', 4, 20, 1, '5 avenue des marguerites', 'Cornebarrieu', 'France', 31000, 'massip.thomas@gmail.com', 0600006654, 'mdp'),
('cantal.guillaume@gmail.com', 'Cantal', 'Guigui', 4, 56, 1, '1 rue des lilas', 'Bordeaux', 'France', 45000, 'cantal.guillaume@gmail.com', 0644556677, 'mdp');

insert into voitures (couleur, marque, nbPlace, annee, idU) values
('rouge', 'ferrari', 2, 1999, 'emeric.tosi@gmail.com'),
('marron', 'renault 4L', 4, 1973, 'massip.thomas@gmail.com'),
('noire', 'K2000', 3, 1980, 'cantal.guillaume@gmail.com');

insert into villes (idVille, nomV, cp) values
(100, 'Merignac', 45000),
(101, 'Foix', 09000),
(102, 'Cornebarrieu', 31000),
(103, 'Ramonville', 31400);

insert into trajets (idT, dateT, heureD, heureA, idVilleDestination, idVilleDepart, idConducteur) VALUES
(100, 1432857600, '14:00:00', '18:00:00', 100, 101, 'emeric.tosi@gmail.com'),
(101, 1432867600, '15:00:00', '17:00:00', 102, 103, 'cantal.guillaume@gmail.com');

insert into postuler (nbPlace, idU, idT) values
(1, 'emeric.tosi@gmail.com', 101),
(1, 'cantal.guillaume@gmail.com', 100),
(1, 'massip.thomas@gmail.com', 100);