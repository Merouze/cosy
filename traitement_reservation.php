<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";

session_start();

// ******************* add resa *************
if (isset($_POST['resa']) && !empty($_POST)) {
    // Récupérer les données du formulaire pour créer une resa en bdd
    $nomPrenom = strip_tags($_POST['nomPrenom']);
    $telephone = strip_tags($_POST['telephone']);
    $email = strip_tags($_POST['email']);
    $idLogement = intval(strip_tags($_POST['idLogement']));
    $dateDebut = strip_tags($_POST['dateDebut']);
    $dateFin = strip_tags($_POST['dateFin']);
    $dateDebut = new DateTime($_POST['dateDebut']);
    $dateFin = new DateTime($_POST['dateFin']);
    $dateDebut->setTime(15, 0, 0);
    $dateFin->setTime(11, 0, 0);
    $numberNight = intval(strip_tags($_POST['numberNight']));
    $adresse = strip_tags($_POST['adresse']);
    

    $sqlCheckOverlap = "SELECT date_debut, date_fin FROM reservation WHERE id_logement = :idLogement AND id_client != :idClient";
    $statementCheckOverlap = $dtcosycaen->prepare($sqlCheckOverlap);
    $statementCheckOverlap->execute(['idLogement' => $idLogement, 'idClient' => $clientId]);
    $reservationsExistantes = $statementCheckOverlap->fetchAll(PDO::FETCH_ASSOC);

    // ...

    $chevauchement = false;
    foreach ($reservationsExistantes as $reservationExistante) {
        $reservationExistanteDebut = new DateTime($reservationExistante['date_debut']);
        $reservationExistanteFin = new DateTime($reservationExistante['date_fin']);
        $nouvelleDateDebut = $dateDebut;
        $nouvelleDateFin = $dateFin;

        if ($nouvelleDateDebut == $reservationExistanteDebut || $nouvelleDateFin == $reservationExistanteFin) {
            // Il y a un chevauchement, afficher un message d'erreur
            $chevauchement = true;
            $_SESSION['error'] = 'Impossible de modifier. La période choisie chevauche une réservation existante pour ce logement.';
            header('Location: admin.php?id=' . $clientId); // Rediriger avec un message d'erreur
            exit;
        }
    }

    // ...

    // Si aucun chevauchement, procéder à l'ajout normal de la réservation
   // Si aucun chevauchement, procéder à l'ajout normal de la réservation
if (!$chevauchement) {
    try {
        // Démarrer une transaction
        $dtcosycaen->beginTransaction();

        // Insérer les informations du client dans la bdd
        $addClient = $dtcosycaen->prepare("INSERT INTO client (nom_prenom, telephone_client, mail_client, adresse_client) VALUES (:nomPrenom, :telephone, :email, :adresse)");
        $addClient->execute([
            'nomPrenom' => $nomPrenom,
            'telephone' => $telephone,
            'email' => $email,
            'adresse' => $adresse,
        ]);

        // Récupérer l'ID du dernier client inséré
        $clientId = $dtcosycaen->lastInsertId();

        // Insérer la réservation
        $addResa = $dtcosycaen->prepare("INSERT INTO reservation (id_client, date_debut, date_fin, nombre_nuit, id_logement) VALUES (:idClient, :dateDebut, :dateFin, :nombreNuit, :idLogement)");
        $addResa->bindParam(':idClient', $clientId, PDO::PARAM_INT);
        $addResa->bindParam(':dateDebut', $dateDebut->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $addResa->bindParam(':dateFin', $dateFin->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $addResa->bindParam(':nombreNuit', $numberNight, PDO::PARAM_INT);
        $addResa->bindParam(':idLogement', $idLogement, PDO::PARAM_INT);
        $addResa->execute();

        // Valider la transaction
        $dtcosycaen->commit();
        $_SESSION['notif'] = 'Réservation ajoutée avec succès';
        header('Location: admin.php');
    } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $dtcosycaen->rollBack();

            $_SESSION['error'] = 'Une erreur est survenue lors de l\'ajout de la réservation : ' . $e->getMessage();
            header('Location: admin.php');
        }
    } else {
        // S'il y a un chevauchement, rediriger avec un message d'erreur
        header('Location: admin.php');
    }
}
