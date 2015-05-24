create table Villes (
idVille int NOT NULL AUTO_INCREMENT,
nomV varchar(150),
cp int,
constraint pk_villes PRIMARY KEY(idVille)
) ;

create table CompteUtilisateur (
idU varchar(150),
nomU varchar(150),
prenomU varchar(150),
moyenne float,
age int, 
genre varchar(1),
pays varchar(150),
mail varchar (150),
telephone varchar (150),
mdp varchar(150),
constraint pk_compteUtilisateur PRIMARY KEY(idU),
) ;

create table Voitures (
idV int NOT NULL AUTO_INCREMENT,
couleur varchar(150),
marque varchar(150),
nbPLace int,
annee int,
idU varchar(150),
constraint pk_voitures PRIMARY KEY(idV),
constraint fk_voitures_compteUtilisateur FOREIGN KEY(idU) REFERENCES CompteUtilisateur(idU)
) ;

create table Trajets (
idT int NOT NULL AUTO_INCREMENT,
dateT int,
heureD time,
heureA time,
idVilleDestination int,
idVilleDepart int,
idConducteur varchar(150),
idVoiture int,
constraint pk_trajet PRIMARY KEY(idT),
constraint fk_trajet_compteUtilisateur FOREIGN KEY(idConducteur) REFERENCES CompteUtilisateur(idU),
constraint fk_trajet_ville_depart FOREIGN KEY(idVilleDepart) REFERENCES Villes(idVille),
constraint fk_trajet_ville_destination FOREIGN KEY(idVilleDestination) REFERENCES Villes(idVille),
constraint fk_trajet_id_voiture FOREIGN KEY(idVoiture) REFERENCES Voitures(idV)
) ;

create table Avis (
idDonneur varchar(150),
idReceveur varchar(150),
idT int,
texte varchar(500),
note int,
constraint pk_avis PRIMARY KEY(idDonneur, idReceveur, idT),
constraint fk_idDonneur FOREIGN KEY(idDonneur) REFERENCES CompteUtilisateur(idU),
constraint fk_idReceveur FOREIGN KEY(idReceveur) REFERENCES CompteUtilisateur(idU),
constraint fk_idT FOREIGN KEY(idT) REFERENCES Trajets(idT)
) ;

create table Etapes (
idVilleEtapes int,
heurePassage int,
idT int,
constraint fk_etapes_trajet FOREIGN KEY(idT) REFERENCES Trajets(idT),
constraint fk_etape_ville FOREIGN KEY(idVilleEtapes) REFERENCES Villes(idVille),
constraint pk_etapes PRIMARY KEY(idT,idVilleEtapes)
) ;

create table Postuler (
nbPlace int,
idU varchar(150),
idT int,
constraint fk_postuler_trajet FOREIGN KEY(idT) REFERENCES Trajets(idT),
constraint fk_postuler_compteUtilisateur FOREIGN KEY(idU) REFERENCES CompteUtilisateur(idU),
constraint pk_postuler PRIMARY KEY(idT,idU)
) ;
