<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
session_start();
$_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="icon" href="icon/logoHTML.png">
    <link rel="stylesheet" href="Css/style.css">
    <title>Les Logements Cosy, Vacances, Hébergements, Gites et Locations saisonnières à Caen.</title>
</head>

<body>
    <main>

        <!-- *********************    Titre  ******************* -->
        <h1 class="text-center">
            <div class="slide-right">Log in</div>
        </h1>


        <!-- ********************************************** rechercher une resa ********************* -->

        <form id="connexion" class="form m-t50" method="post" action="traitement_login.php">
            <?php
            // Affichage des notifications ou erreurs
            if (isset($_SESSION['notif'])) {
                echo '<span class="alert-success">' . $_SESSION['notif'] . '</span>';
                unset($_SESSION['notif']);
            }

            if (isset($_SESSION['error'])) {
                echo '<span class="error-message">' . $_SESSION['error'] . '</span>';
                unset($_SESSION['error']);
            }
            $motDePasse = "1935";
            ?>
            <div class="form m-t50">
                <div>
                    <label for="email">Log in :</label>
                    <input class="form-label" type="text" name="email" id="email" placeholder="Entrer votre email.">
                    <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input class="form-label" type="password" name="password" id="password" placeholder="Entrer votre mot de passe.">
                </div>
                <button name="connexion" type="submit" class="btn m-t50">Valider</button>
            </div>
        </form>

    </main>
    <script src="Js/script.js"></script>


</body>

</html>