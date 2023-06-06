CREATE DATABASE IF NOT EXISTS missinformationProject;
USE missinformationProject;
CREATE TABLE IF NOT EXISTS fonte(
    id_fonte INT(10) PRIMARY KEY NOT NULL,
    nome_fonte VARCHAR(255) NOT NULL,
    link_fonte VARCHAR(255) NOT NULL,
    indice_fonte INT(10) NOT NULL
);
CREATE TABLE IF NOT EXISTS notizia (
    id INT(10) PRIMARY KEY NOT NULL,
    link VARCHAR(255) NOT NULL,
    descrizione_notizia CHAR(255) NOT NULL,
    argomento CHAR(255),
    fonte INT(10),
    indice_attendibilita INT(10) NOT NULL,
    data_pubblicazione DATE NOT NULL,
    data_accaduto DATE,
    coinvolgimento CHAR(255),
    luogo VARCHAR(255),
    from_api BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY(fonte) REFERENCES fonte(id_fonte) ON DELETE
    SET NULL ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS segnalazioni(
    id INT(10) PRIMARY KEY NOT NULL,
    url VARCHAR(255) NOT NULL,
    motivo VARCHAR(500) NOT NULL,
    valutazione INT(10) NOT NULL DEFAULT 0,
    esito INT(10) NOT NULL DEFAULT 0,
    id_notizia INT,
    FOREIGN KEY(id_notizia) REFERENCES notizia(id) ON DELETE
    SET NULL ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS media (
    id int(10) PRIMARY KEY NOT NULL,
    indice_attendibilita int(11) NOT NULL,
    estensione varchar(10) NOT NULL,
    percorso varchar(250) NOT NULL
);
CREATE TABLE IF NOT EXISTS media_notizia (
    id_notizia int(10),
    id_media int(10),
    PRIMARY KEY (id_notizia, id_media),
    FOREIGN KEY(id_notizia) REFERENCES notizia(id) ON DELETE
    NO ACTION ON UPDATE CASCADE,
        FOREIGN KEY(id_media) REFERENCES media(id) ON DELETE
    NO ACTION ON UPDATE CASCADE
);