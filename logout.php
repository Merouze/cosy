<?php
// session_start();

// $_SESSION['notif'] = 'Vous avez été déconnecté avec succès.';
// // Détruire toutes les variables de session
// session_destroy();

// // Rediriger vers la page de connexion
// header("location: login.php");
// exit;
?>
<?php
session_start();

// Stocker la notification dans une variable
$notification = 'Vous avez été déconnecté avec succès.';

// Détruire toutes les variables de session
session_destroy();

// Rediriger vers la page de connexion avec la notification dans l'URL
header("location: login.php?notif=" . urlencode($notification));
exit;
?>
