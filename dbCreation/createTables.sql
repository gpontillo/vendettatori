CREATE DATABASE IF NOT EXISTS missinformationProject;

USE missinformationProject;

CREATE TABLE IF NOT EXISTS categoria(
    id_categoria INT(10) PRIMARY KEY NOT NULL,
    descrizione_categoria CHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS notizia (
    id INT(10) PRIMARY KEY NOT NULL,
    link CHAR(255) NOT NULL,
    descrizione_notizia CHAR(255) NOT NULL,
    tipo_categoria INT(10),
    indice_attendibilita INT(10) NOT NULL,
    data_pubblicazione DATE NOT NULL,
    data_accaduto DATE,
    coinvolgimento CHAR(255),
    FOREIGN KEY(tipo_categoria) REFERENCES categoria(id_categoria)
        ON DELETE SET NULL ON UPDATE CASCADE
            
);









