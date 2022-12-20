/*Remplissage de la table categorie*/
INSERT INTO CATEGORIE (nomcat) VALUES ("Informatique"), ("Audio Visiuel"), ("Bien immobilier"), ("Divers"), ("Meubles");

/*Remplissage de la table article*/
INSERT INTO ARTICLE (refart, description, prix, codcat) VALUES
    ("DEL30", "Portable Dell X300", 1715.00, "1"),
    ("SAX15", "Portable Samsung X15 XVM", 1999.00, "1"),
    ("SOXMP", "PC Portable Sony Z1-XMP", 2399.00, "1"),
    ("QSE45", "Ecouter Sans fil", 812.50, "2"),
    ("FGTY8", "Casck bleu fillaire", 1258.00, "2"),
    ("IOL10", "Micro Pro X11", 3942.00, "2"),
    ("CHL02", "Banc en bois trampé", 712.80, "3"),
    ("PLM79", "Lampe de table Yamato", 1369.00, "3"),
    ("UIL34", "Lantern noire inflammable", 560.25, "3");
