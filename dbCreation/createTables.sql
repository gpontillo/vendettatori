IF NOT EXISTS CREATE DATABASE vendettatori;

IF NOT EXISTS CREATE TABLE notizia (

    id INT(10) PRIMARY KEY NOT NULL,
    link CHAR(255) NOT NULL,
    descrizione_notizia CHAR(255) NOT NULL,
    cateogoria_notizia CHAR(255) NOT NULL,
    indice_attendibilita INT(10) NOT NULL,
    data_pubblicazione DATE NOT NULL,
    data_accaduto DATE,
    coinvolgimento CHAR(255)
);




