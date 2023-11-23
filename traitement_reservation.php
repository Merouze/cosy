<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
include_once 'functions.php';

var_dump($_POST);
session_start();

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


// if (isset($_POST['recherche']) && (isset($_POST))) {
//     // Construisez la requête en fonction du paramètre de recherche
//     $recherche = strip_tags($_POST['chercherResa']);

//     // Vérifiez si la valeur de recherche est une date valide
//     $dateDebut = date('Y-m-d', strtotime($recherche));
//     $dateFin = date('Y-m-d', strtotime($recherche));

//     // Construisez la requête avec les conditions de date
//     $displayResa = $dtcosycaen->prepare("
//         SELECT 
//         reservation.id_reservation,
//             reservation.date_debut,
//             reservation.date_fin,
//             reservation.nombre_nuit,
//             logement.nom_logement,
//             client.nom_prenom,
//             client.telephone_client,
//             client.mail_client,
//             client.adresse_client
//         FROM 
//         reservation
//         INNER JOIN
//             client ON reservation.id_client = client.id_client
//             INNER JOIN
//             logement ON reservation.id_logement = logement.id_logement
//             WHERE
//             client.nom_prenom LIKE :recherche
//             OR reservation.date_debut <= :dateDebut
//             OR reservation.date_fin >= :dateFin
//             OR logement.nom_logement LIKE :recherche
//             ORDER BY
//             reservation.date_debut DESC
//             ");

//     // Liez le paramètre de recherche
//     $displayResa->bindParam(':recherche', $recherche, PDO::PARAM_STR);

//     // Liez les paramètres de date
//     $displayResa->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
//     $displayResa->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);

//     // ...

//     // Exécutez la requête
//     $displayResa->execute();

//     // Récupérez les résultats
//     $historiqueReservations = $displayResa->fetchAll(PDO::FETCH_ASSOC);

//     // Affichage des résultats de la recherche
//     if (!empty($historiqueReservations)) {
//         $_SESSION['notif'] = 'Réservation trouvée(s)';
//     } else {
//         $_SESSION['error'] = 'Aucune réservation trouvée';
//     }

//     header('Location: admin.php');
//     exit();
// }
?>