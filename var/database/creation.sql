DROP TABLE Message;
DROP TABLE Utilisateur;
/*
CREATE TABLE Utilisateur(
    idUtilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(20) UNIQUE NOT NULL,
    nom VARCHAR(20),
    mdp VARCHAR(20),
    pic VARCHAR(20), /* profil pic identifiée par le chemin de la photo*/

    -- Contraintes de table
    CONSTRAINT ck_pic CHECK(pic LIKE 'asset(''images/%'')')
);

CREATE TABLE Message(
    idMessage INTEGER PRIMARY KEY AUTOINCREMENT,
    titre VARCHAR(30),
    contenu VARCHAR(1000),
    lUtilisateur INTEGER,

    -- Contraintes de table
    CONSTRAINT fk_Lutilisateur FOREIGN KEY(lUtilisateur) REFERENCES Utilisateur(idUtilisateur)
);
*/