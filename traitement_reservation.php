<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
include_once 'functions.php';


// // ******************* add resa *************

if (isset($_POST['resa']) && (isset($_POST))) {
    // Récupérer les données du formulaire pour créer une resa en bdd
    $nomPrenom = strip_tags($_POST['nomPrenom']);
    $telephone = strip_tags($_POST['telephone']);
    $email = strip_tags($_POST['email']);
    $idLogement = intval(strip_tags($_POST['idLogement']));
    $dateDebut = strip_tags($_POST['dateDebut']);
    $dateFin = strip_tags($_POST['dateFin']);
    $numberNight = intval(strip_tags($_POST['numberNight']));
    $adresse = strip_tags($_POST['adresse']);

    // Insérer les informations du client dans la bdd
    $addClient = $dtcosycaen->prepare("INSERT INTO client (nom_prenom, telephone_client, mail_client, adresse_client) VALUES (:nomPrenom, :telephone, :email, :adresse)");
    $addClient->execute([
        'nomPrenom' => $nomPrenom,
        'telephone' => $telephone,
        'email' => $email,
        'adresse' => $adresse,
    ]);

    // Récupérer l'ID du dernier client inseré
    $clientId = $dtcosycaen->lastInsertId();

    // Insérer la réservation
    $addResa = $dtcosycaen->prepare("INSERT INTO reservation (id_client, date_debut, date_fin, nombre_nuit, id_logement) VALUES (:idClient, :debut, :fin, :nombreNuit, :idLogement)");
    $addResa->execute([
        'debut' => $dateDebut,
        'fin' => $dateFin,
        'nombreNuit' => $numberNight,
        'idLogement' => $idLogement,
        'idClient' => $clientId,
    ]);

    if ($addResa->rowCount()) {
        $_SESSION['notif'] = 'Réservation ajoutée avec succès';
    } else {
        $_SESSION['error'] = 'Impossible d\'ajouter la réservation';
    }
    header('Location: admin.php');

};

// ****************** afficher un historique des reservation ******************

$historiqueQuery = $dtcosycaen->prepare("
    SELECT 
        reservation.id_reservation,
        reservation.date_debut,
        reservation.date_fin,
        reservation.nombre_nuit,
        logement.nom_logement,
        client.nom_prenom,
        client.telephone_client,
        client.mail_client,
        client.adresse_client
    FROM 
        reservation
    INNER JOIN
        client ON reservation.id_client = client.id_client
    INNER JOIN
        logement ON reservation.id_logement = logement.id_logement
    ORDER BY
        reservation.date_debut DESC
");

// Exécutez la requête
$historiqueQuery->execute();

// Récupérez les résultats
$historiqueReservations = $historiqueQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
    <?php foreach ($historiqueReservations as $reservation): ?>
        <li>
            <strong>ID Réservation:</strong> <?= $reservation['id_reservation'] ?><br>
            <strong>Date de début:</strong> <?= $reservation['date_debut'] ?><br>
            <strong>Date de fin:</strong> <?= $reservation['date_fin'] ?><br>
            <strong>Nombre de nuits:</strong> <?= $reservation['nombre_nuit'] ?><br>
            <strong>Logement:</strong> <?= $reservation['nom_logement'] ?><br>
            <strong>Client:</strong> <?= $reservation['nom_prenom'] ?><br>
            <strong>Téléphone:</strong> <?= $reservation['telephone_client'] ?><br>
            <strong>Email:</strong> <?= $reservation['mail_client'] ?><br>
            <strong>Adresse:</strong> <?= $reservation['adresse_client'] ?><br>
        </li>
    <?php endforeach; ?>
</ul>


