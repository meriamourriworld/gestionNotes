-- CREATE DATABASE gestionNotes;
USE gestionNotes;


-- Creation des tables
CREATE TABLE Matiere(
	idMat varchar(10) PRIMARY KEY,
    nomMat varchar(50),
    objectifMat varchar(500),
    coefMat int
);
ALTER TABLE Matiere ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE TABLE Utilisateur(
	idUser int PRIMARY KEY AUTO_INCREMENT,
    identifiant varchar(20),
    motPasse varchar(256),
    role varchar(20)
);

CREATE TABLE Professeur(
	idProf varchar(10) PRIMARY KEY,
    nomProf varchar(50),
    prenomProf varchar(50),
    dateNaissance date,
    adresseProf varchar(200),
    mailProf varchar(50),
    telProf varchar(20),
    photoProf longblob,
    matiere varchar(10),
    profil int NULL,
    FOREIGN KEY (matiere) REFERENCES Matiere(idMat),
    FOREIGN KEY (profil) REFERENCES Utilisateur(idUser)
);
ALTER TABLE Professeur ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE TABLE Classe(
	idClasse varchar(10) PRIMARY KEY,
    nomClasse varchar(50),
    nbEtudiants int,
    niveauClasse varchar(50),
    descClasse varchar(200)
);
ALTER TABLE Classe ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE TABLE Etudiant(
	cne varchar(10) PRIMARY KEY,
    nomEtud varchar(50),
    prenomEtud varchar(50),
    dnEtud date,
    adresseEtud varchar(200),
    mailEtud varchar(50),
    telEtud varchar(20),
    photoEtud longblob,
    classe varchar(10),
    profil int NULL,
    FOREIGN KEY (classe) REFERENCES Classe(idClasse),
    FOREIGN KEY (profil) REFERENCES Utilisateur(idUser)
);
ALTER TABLE Etudiant ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE table Devoir(
	idDev varchar(10) PRIMARY KEY,
    titreDev varchar(30),
    descDev varchar(100),
    dateEcheance Date,
    noteDev float,
    matiere varchar(10),
    etudiant varchar(10),
    FOREIGN KEY (matiere) REFERENCES Matiere(idMat),
    FOREIGN KEY (etudiant) REFERENCES Etudiant(idEtud)
);
ALTER TABLE Devoir ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE TABLE ClasseProf(
	classe varchar(10),
    professeur varchar(10),
    FOREIGN KEY (classe) REFERENCES Classe(idClasse),
    FOREIGN KEY (professeur) REFERENCES Professeur(idProf),
    PRIMARY KEY (classe, professeur)
);
ALTER TABLE ClasseProf ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;

CREATE TABLE Notes (
    etudiant varchar(10),
    devoir varchar(10),
    note float,
    PRIMARY KEY(etudiant, devoir),
    FOREIGN KEY (etudiant) REFERENCES etudiant(cne),
    FOREIGN KEY (devoir) REFERENCES Devoir(idDev)
);
ALTER table Notes ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST;