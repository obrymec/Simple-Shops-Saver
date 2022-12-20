<?php
    // La ligne de code ci-dessous accomplie les objectifs de ce script.
    try {
        // Création d'une connexion vers la base de données "shops_saver" en mode "root" sans mot de passe particulier.
        $db = new PDO ("mysql:host=localhost;dbname=shops_saver;charset=utf8", "root", '');
        // Si l'opération à effectuée vaut: "recuperer_articles".
        if ($_POST ["operation"] == "recuperer_articles") {
            // Préparation de la requête de récupération des articles disponibles.
            $articles = $db->prepare ("SELECT DISTINCT refart FROM ARTICLE;");
            // Exécutons la requête ainsi préparée.
            $articles->execute ();
            // Récupération des résultats de la requête SQL.
            $resultats = $articles->fetchAll ();
            // Envoie des données à la surface.
            echo json_encode (array ("articles" => $resultats));
        // Si l'opération à effectuée vaut: "ajouter_articles".
        } elseif ($_POST ["operation"] == "ajouter_articles") {
            // Contient le dernier achat effectué.
            $code_achat = $_POST ["code_achat"];
            // Si ce achat n'est pas déjà ajouté à la base de données.
            if ($code_achat <= 0) {
                // Préparation de la requête d'ajout d'un achat.
                $ajout_achat = $db->prepare ("INSERT INTO ACHAT (dateach, nomcli, livraison) VALUES (:dateach, :nomcli, :livraison)");
                // Exécutons la requête ainsi préparée avec les données requises.
                $ajout_achat->execute (array ("dateach" => $_POST ["date"], "nomcli" => $_POST ["client"], "livraison" => $_POST ["livraison"]));
                // Préparation de la requête de récupération de l'identifiant du dernier achat effectué.
                $demande = $db->prepare ("SELECT NumAch FROM ACHAT ORDER BY NumAch DESC LIMIT 1;");
                // Exécutons la requête pour la récupération du dernier identifiant de l'achat.
                $demande->execute ();
                // Récupération de l'identifiant de l'achat en cours.
                $code_achat = $demande->fetch ();
                $code_achat = $code_achat ["NumAch"];
            }
            // Préparation de la requête d'ajout d'un détail d'achat.
            $ajout_detail = $db->prepare ("INSERT INTO DETAILACHAT (NumAch, refart, quantite) VALUES (:NumAch, :refart, :quantite)");
            // Exécutons la requête ainsi préparée avec les données requises.
            $ajout_detail->execute (array ("NumAch" => $code_achat, "refart" => $_POST ["reference_article"], "quantite" => $_POST ["quantite"]));
            // Envoie d'une réponse à la surface pour informer l'utilisateur de la réussite de l'opération.
            echo json_encode (array ("status" => 200, "code_achat" => $code_achat));
        }
    // Gestion de l'erreur.
    } catch (PDOException $exp) {
        // Affichons le méssage d'erreur détecté.
        echo ("Erreur de connexion à la base de données: " . $exp->getMessage ());
    }
?>
