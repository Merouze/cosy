<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";

// ******************* Add in db, message from formulaire ***********************

// if (isset($_POST['nom_prenom'])) {
//     $nom_prenom = strip_tags($_POST['nom_prenom']);
//     $message_client = strip_tags($_POST['message_client']);
//     $mail_client = strip_tags($_POST['mail_client']);
//     $telephone_client = strip_tags($_POST['telephone_client']);

//     $addClient = $dtcosycaen->prepare("INSERT INTO `dtcosycaen` (nom_prenom, message_client, mail_client, telephone_client) 
//     VALUES (:name_, :mess, :mail, :tel)");

//     $addClient->execute([
//         ':name_' => $nom_prenom,
//         ':mess' => $message_client,
//         ':mail' => $mail_client,
//         ':tel' => $telephone_client
//     ]);

//     if ($addClient->rowCount()) {
//         $_SESSION['notif'] = 'Ajoutée';
//     } else {
//         $_SESSION['error'] = 'Impossible d\'ajouter en base de données';
//     }

//     header('Location: index.php');
//     exit;
// }
// action.php

$requiredFields = ['nom_prenom', 'message_client', 'mail_client', 'telephone_client'];

// Vérifier si tous les champs requis sont présents dans $_POST
if (areFieldsPresent($requiredFields, $_POST)) {
    // Récupérer les données des champs
    $nom_prenom = strip_tags($_POST['nom_prenom']);
    $message_client = strip_tags($_POST['message_client']);
    $mail_client = strip_tags($_POST['mail_client']);
    $telephone_client = strip_tags($_POST['telephone_client']);

    // Valider ou traiter les données ici

    // Exemple d'insertion dans la base de données
    $addClient = $dtcosycaen->prepare("INSERT INTO `dtcosycaen` (nom_prenom, message_client, mail_client, telephone_client) 
        VALUES (:name_, :mess, :mail, :tel)");

    $addClient->execute([
        ':name_' => $nom_prenom,
        ':mess' => $message_client,
        ':mail' => $mail_client,
        ':tel' => $telephone_client
    ]);

    if ($addClient->rowCount()) {
        $_SESSION['notif'] = 'Ajoutée';
    } else {
        $_SESSION['error'] = 'Impossible d\'ajouter en base de données';
    }

    // Redirection vers index.php
    header('Location: index.php');
    exit;
} else {
    // Gérer le cas où certains champs sont manquants
    $_SESSION['error'] = 'Tous les champs du formulaire sont obligatoires.';
    header('Location: index.php');
    exit;
}

// Fonction pour vérifier la présence de champs dans un tableau
function areFieldsPresent($fields, $data) {
    foreach ($fields as $field) {
        if (!isset($data[$field])) {
            return false;
        }
    }
    return true;
}


?>



