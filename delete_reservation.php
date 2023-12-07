<?php
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
    $reservationId = $_GET['id'];
    // var_dump($reservationId);
    // exit;

    // Récupérez l'ID du client associé à la réservation
    $getClientId = $dtcosycaen->prepare("SELECT id_client FROM reservation WHERE id_reservation = :id");
    $getClientId->bindParam(':id', $reservationId, PDO::PARAM_INT);
    $getClientId->execute();
    $clientRow = $getClientId->fetch(PDO::FETCH_ASSOC);

    if ($clientRow) {
        $clientId = $clientRow['id_client'];

        // Supprimez d'abord la réservation
        $deleteResa = $dtcosycaen->prepare("DELETE FROM reservation WHERE id_reservation = :id");
        $deleteResa->bindParam(':id', $reservationId, PDO::PARAM_INT);
        $deleteResa->execute();

        // Ensuite, supprimez le client
        $deleteClient = $dtcosycaen->prepare("DELETE FROM client WHERE id_client = :id");
        $deleteClient->bindParam(':id', $clientId, PDO::PARAM_INT);
        $deleteClient->execute();

        // Vérifiez si la suppression a réussi
        if ($deleteResa->rowCount() && $deleteClient->rowCount()) {
            $_SESSION['notif'] = 'Réservation supprimés avec succès';
        } else {
            $_SESSION['error'] = 'Impossible de supprimer la réservation et le client associé';
        }

        header('Location: admin.php');
        exit;
    }
}
