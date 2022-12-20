<?php
    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "shops_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=shops_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_categories".
        if ($_POST ["operation"] === "recuperer_categories") {
            // Préparation de la requête de récupération des catégories disponibles.
            $categories = $db->prepare ("SELECT * FROM CATEGORIE;");
            // Exécutons la requête ainsi préparée.
            $categories->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $categories->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("categories" => $resultats));
        // Si l'opération à effectuée vaut: "rechercher_articles".
        } elseif ($_POST ["operation"] === "rechercher_articles") {
            // Contient la préparation d'une requête en fonction du type de tri à effectué.
            $tri = null;
            // Tri par prix.
            if ($_POST ["type_de_tri"] === "prix") {
                // Requête pour tri par prix.
                $tri = $db->prepare ("SELECT DISTINCT ARTICLE.refart, ARTICLE.description, ARTICLE.prix
                    FROM CATEGORIE INNER JOIN ARTICLE ON ARTICLE.codcat = :codcat WHERE ARTICLE.description
                    LIKE '%" . $_POST ["cle"] . "%' ORDER BY ARTICLE.prix " . $_POST ["ordre"] . ';');
            // Tri par catégorie.
            } elseif ($_POST ["type_de_tri"] === "categorie") {
                // Requête pour tri par prix.
                $tri = $db->prepare ("SELECT DISTINCT ARTICLE.refart, ARTICLE.description, ARTICLE.prix
                    FROM CATEGORIE INNER JOIN ARTICLE ON ARTICLE.codcat = :codcat WHERE ARTICLE.description
                    LIKE '%" . $_POST ["cle"] . "%' ORDER BY CATEGORIE.nomcat " . $_POST ["ordre"] . ';');
            // Tri par identifiant.
            } elseif ($_POST ["type_de_tri"] === "identifiant") {
                // Requête pour tri par prix.
                $tri = $db->prepare ("SELECT DISTINCT ARTICLE.refart, ARTICLE.description, ARTICLE.prix
                    FROM CATEGORIE INNER JOIN ARTICLE ON ARTICLE.codcat = :codcat WHERE ARTICLE.description
                    LIKE '%" . $_POST ["cle"] . "%' ORDER BY ARTICLE.refart " . $_POST ["ordre"] . ';');
            }
            // Exécutons la requête ainsi préparée avec les données requises.
            $tri->execute (array ("codcat" => $_POST ["codcat"]));
            // Récupération des résultats de la requête SQL.
            $resultats = $tri->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("articles" => $resultats));
        }
    // Gestion de l'erreur.
    } catch (PDOException $exp) {
        // Affichons le méssage d'erreur détecté.
        echo ("Erreur de connexion à la base de données: " . $exp->getMessage ());
    }
?>
