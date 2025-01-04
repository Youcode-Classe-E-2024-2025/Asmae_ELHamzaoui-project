-- Active: 1733492701458@@127.0.0.1@3306@gestion_projet
CREATE DATABASE gestion_projet;

USE gestion_projet;

CREATE TABLE Utilisateur (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom_user VARCHAR(255) NOT NULL,
    email_user VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role_user ENUM('chef_de_projet', 'membre', 'invite') NOT NULL
);

ALTER TABLE Utilisateur
MODIFY role_user ENUM('chef_de_projet', 'membre', 'invite') NOT NULL DEFAULT 'membre';


CREATE TABLE Projet (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    nom_projet VARCHAR(255) NOT NULL,
    desc_projet TEXT,
    date_debut_projet DATE,
    date_fin_projet DATE,
    visibilite_projet ENUM('public', 'privé') NOT NULL,
    chefProjet_id INT,
    FOREIGN KEY (chefProjet_id) REFERENCES Utilisateur(id_user)
);

CREATE TABLE Etat_de_tache (
    id_etatTache INT AUTO_INCREMENT PRIMARY KEY,
    statut ENUM('To Do', 'Doing', 'Done') NOT NULL
);

CREATE TABLE Tache (
    id_tache INT AUTO_INCREMENT PRIMARY KEY,
    titre_tache VARCHAR(255) NOT NULL,
    desc_tache TEXT,
    statut_tache ENUM('en_cours', 'terminee', 'en_attente') NOT NULL,
    date_limite_tache DATE,
    priorite_tache ENUM('basse', 'moyenne', 'haute') NOT NULL,
    date_creation_tache TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    membre_assigne_id INT,
    projet_id INT,
    etat_id INT,
    FOREIGN KEY (membre_assigne_id) REFERENCES Utilisateur(id_user),
    FOREIGN KEY (projet_id) REFERENCES Projet(id_projet),
    FOREIGN KEY (etat_id) REFERENCES Etat_de_tache(id_etatTache)
);

CREATE TABLE Categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(255) NOT NULL,
    desc_categorie TEXT
);

CREATE TABLE Tag (
    id_tag INT AUTO_INCREMENT PRIMARY KEY,
    nom_tag VARCHAR(255) NOT NULL
);

CREATE TABLE Tache_Categorie (
    tache_id INT,
    categorie_id INT,
    PRIMARY KEY (tache_id, categorie_id),
    FOREIGN KEY (tache_id) REFERENCES Tache(id_tache),
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id_categorie)
);

CREATE TABLE Tache_Tag (
    tache_id INT,
    tag_id INT,
    PRIMARY KEY (tache_id, tag_id),
    FOREIGN KEY (tache_id) REFERENCES Tache(id_tache),
    FOREIGN KEY (tag_id) REFERENCES Tag(id_tag)
);

INSERT INTO Utilisateur(nom_user, email_user, mot_de_passe, role_user) VALUES ('asmae','asmae@admin.com', 'Asmae1234@', 'chef_de_projet')

UPDATE Utilisateur
SET role_user = 'chef_de_projet'
WHERE email_user = 'asmaeadmin@gmail.com' ;
