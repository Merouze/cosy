<?php
session_start();

// Détruire toutes les variables de session
session_destroy();

$_SESSION['notif'] = 'Vous avez été déconnecté avec succès.';

// Rediriger vers la page de connexion
header("location: login.php");
exit;
?>
