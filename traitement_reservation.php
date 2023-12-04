<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
include_once 'functions.php';

session_start();
// var_dump($_POST);

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
    
    try {
        // ... (validation des données)
    
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
        $addResa = $dtcosycaen->prepare("INSERT INTO reservation (id_client, date_debut, date_fin, nombre_nuit, id_logement) VALUES (:idClient, :debut, :fin, :nombreNuit, :idLogement)");
        $addResa->execute([
            'debut' => $dateDebut,
            'fin' => $dateFin,
            'nombreNuit' => $numberNight,
            'idLogement' => $idLogement,
            'idClient' => $clientId,
        ]);
    
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
    
};
