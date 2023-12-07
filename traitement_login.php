<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
session_start();
// $_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
$_SESSION['myToken'] = bin2hex(random_bytes(16));

if (isset($_POST['connexion'])) {
    // Récupérer les données du formulaire
    $email = strip_tags($_POST["email"]);
    $password = strip_tags($_POST["password"]);

    // Vérifier les informations d'identification
    $query = $dtcosycaen->prepare("SELECT id_admin, password FROM admin WHERE login = :login");
    $query->execute([
        'login' => $email,
    ]);

    $result = $query->fetch();
    $hash = $result['password'];

    if ($query->rowCount() == 1 && password_verify($password, $hash)) {
        // Utilisateur authentifié, rediriger vers l'espace administrateur
        $_SESSION["loggedin"] = true;
        $_SESSION['notif'] = 'Connexion réussie.';
        header("location: admin.php");
    } else {
        // Identifiants invalides, afficher un message d'erreur
        $_SESSION['error'] = 'Identifiants invalides';
        header("location: login.php");
    }
}
?>
