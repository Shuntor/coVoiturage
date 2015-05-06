create table CompteUtilisateur (
idU int,
nomU varchar(150),
prenomU varchar(150),
moyenne int,
age int, 
genre varchar(1),
adresse varchar(400),
ville varchar(150),
pays varchar(150),
cp int,
mdp varchar(150),
mail varchar(150),
numTel varchar(150), 
constraint pk_compteUtilisateur PRIMARY KEY(idU)
) ;

create table Voitures (
idV int,
couleur varchar(150),
marque varchar(150),
nbPLace int,
annee int,
idU int,
constraint pk_voitures PRIMARY KEY(idV),
constraint fk_voitures_compteUtilisateur FOREIGN KEY(idU) REFERENCES CompteUtilisateur(idU)
) ;

create table Villes (
nomV varchar(150),
cp int,
constraint pk_villes PRIMARY KEY(cp)
) ;

create table Notes (
moyenne varchar(150),
nbrNotes int,
idU int,
constraint pk_notes PRIMARY KEY(idU, moyenne),
constraint fk_note_utilisateur FOREIGN KEY(idU) REFERENCES CompteUtilisateur(idU)

) ;

create table Trajets (
idT int,
dateT date,
heure int,
destination varchar(150),
depart varchar(150),
idConducteur int,
constraint pk_trajet PRIMARY KEY(idT),
constraint fk_trajet_compteUtilisateur FOREIGN KEY(idConducteur) REFERENCES CompteUtilisateur(idU),
constraint fk_trajet_ville_depart FOREIGN KEY(depart) REFERENCES Villes(nomV),
constraint fk_trajet_ville_destination FOREIGN KEY(destination) REFERENCES Villes(nomV)
) ;

create table Etapes (
ville varchar(150),
heurePassage int,
idT int,
constraint fk_etapes_trajet FOREIGN KEY(idT) REFERENCES Trajets(idT),
constraint fk_etape_ville FOREIGN KEY(ville) REFERENCES Villes(nomV),
constraint pk_etapes PRIMARY KEY(idT,ville)
) ;

create table Postuler (
nbPlace int,
idU int,
idT int,
constraint fk_postuler_trajet FOREIGN KEY(idT) REFERENCES Trajets(idT),
constraint fk_postuler_compteUtilisateur FOREIGN KEY(idU) REFERENCES CompteUtilisateur(idU),
constraint pk_postuler PRIMARY KEY(idT,idU)
) ;

