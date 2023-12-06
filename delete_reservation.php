<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";

session_start();

if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

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

        // Redirigez l'utilisateur vers la page d'origine ou une autre page après la suppression
        header('Location: admin.php');
    }
} 
?>

