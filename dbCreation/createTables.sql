IF NOT EXISTS CREATE DATABASE misinformationProject;

IF NOT EXISTS CREATE TABLE utente (

    id INT(10) PRIMARY KEY NOT NULL,
    nomeUtente CHAR(25) NOT NULL,
    email CHAR(25) NOT NULL,
);

IF NOT EXISTS CREATE TABLE notizia (

    id INT(10) PRIMARY KEY NOT NULL,
    link CHAR(255) NOT NULL,
    descrizione_notizia CHAR(255) NOT NULL,
    categoria INT(255) NOT NULL,
    indice_attendibilita INT(10) NOT NULL,
    data_pubblicazione DATE NOT NULL,
    data_accaduto DATE,
    coinvolgimento CHAR(255),
    FOREIGN KEY(categoria) REFERENCES categoria(categoria)
);

IF NOT EXISTS CREATE TABLE categoria(
    id_categoria INT(1O) PRIMARY KEY NOT NULL,
    descrizione_categoria CHAR(255)
=======
    descrizione CHAR(255) NOT NULL,
    idUtente INT (10),
    indiceAttendibilità INT(10),
    dataPubblicazione DATE,
    FOREIGN KEY(idUtente) REFERENCES utente(id)
>>>>>>> 76f7322e6966ff91db47c40924d258a6168304a3
);








