/*Requête de création de la table categorie*/
CREATE TABLE CATEGORIE (
    codcat INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomcat VARCHAR (16) NOT NULL
) Engine = InnoDB;

/*Requête de création de la table achat*/
CREATE TABLE ACHAT (
    NumAch INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomcli VARCHAR (32) NOT NULL,
    livraison VARCHAR (128),
    dateach DATE NOT NULL
) Engine = InnoDB;

/*Requête de création de la table article*/
CREATE TABLE ARTICLE (
    refart VARCHAR (16) PRIMARY KEY,
    description VARCHAR (256),
    prix FLOAT DEFAULT 0.0,
    codcat INTEGER,
    FOREIGN KEY (codcat) REFERENCES CATEGORIE (codcat) ON DELETE CASCADE
);

/*Requête de création de la table detailachat*/
CREATE TABLE DETAILACHAT (
    quantite FLOAT NOT NULL,
    refart VARCHAR (16),
    NumAch INTEGER,
    FOREIGN KEY (refart) REFERENCES ARTICLE (refart) ON DELETE CASCADE,
    FOREIGN KEY (NumAch) REFERENCES ACHAT (NumAch) ON DELETE CASCADE,
    PRIMARY KEY (NumAch, refart)
) Engine = InnoDB;
