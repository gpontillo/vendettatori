IF NOT EXISTS CREATE DATABASE misinformationProject;

IF NOT EXISTS CREATE TABLE utente (

    id INT(10) PRIMARY KEY NOT NULL,
    nomeUtente CHAR(25) NOT NULL,
    email CHAR(25) NOT NULL,
);

IF NOT EXISTS CREATE TABLE notizia (

    id INT(10) PRIMARY KEY NOT NULL,
    link CHAR(255) NOT NULL,
    descrizione CHAR(255) NOT NULL,
    idUtente INT (10),
    indiceAttendibilità INT(10),
    dataPubblicazione DATE,
    FOREIGN KEY(idUtente) REFERENCES utente(id)
);




