<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";

// Définir le temps d'expiration de la session en secondes (par exemple, 30 minutes)
$session_lifetime = 1800; // 30 minutes
ini_set('session.gc_maxlifetime', $session_lifetime);

session_start();
$_SESSION['myToken'] = md5(uniqid(mt_rand(), true));

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // Sélectionner les informations de la réservation basée sur l'ID du client
    $selectResa = $dtcosycaen->prepare("SELECT * FROM reservation WHERE id_client = :id");
    $selectResa->bindParam(':id', $clientId, PDO::PARAM_INT);
    $selectResa->execute();
    $reservationData = $selectResa->fetchAll(PDO::FETCH_ASSOC);

    // Sélectionner les informations du client
    $selectClient = $dtcosycaen->prepare("SELECT * FROM client WHERE id_client = :id");
    $selectClient->bindParam(':id', $clientId, PDO::PARAM_INT);
    $selectClient->execute();
    $clientData = $selectClient->fetch(PDO::FETCH_ASSOC);

    // Supprimer la réservation basée sur l'ID du client
    $deleteResa = $dtcosycaen->prepare("DELETE FROM reservation WHERE id_client = :id");
    $deleteResa->bindParam(':id', $clientId, PDO::PARAM_INT);
    $deleteResa->execute();

    // Supprimer le client associé
    $deleteClient = $dtcosycaen->prepare("DELETE FROM client WHERE id_client = :id");
    $deleteClient->bindParam(':id', $clientId, PDO::PARAM_INT);
    $deleteClient->execute();

    // Vérifier si la suppression a réussi
    if ($deleteResa->rowCount() && $deleteClient->rowCount()) {
        $_SESSION['notif'] = 'Réservation et client associé supprimés avec succès';
    }

    header('Location: admin.php');
    exit;
}


