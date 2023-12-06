<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
session_start();
$_SESSION['myToken'] = md5(uniqid(mt_rand(), true));


?>
<?php

// // ****************** afficher un historique des reservation ******************

$historiqueReservations = [];

if (isset($_POST['recherche'])) {
    $rechercheDate = isset($_POST['rechercheLogement']) ? strip_tags($_POST['rechercheLogement']) : '';
    $rechercheNom = isset($_POST['chercherResa']) ? strip_tags($_POST['chercherResa']) : '';
    $rechercheDate = isset($_POST['chercheDate']) ? strip_tags($_POST['chercheDate']) : '';
    $rechercheLogement = isset($_POST['rechercheLogement']) ? strip_tags($_POST['rechercheLogement']) : '';


    // Construisez la requête avec les conditions de recherche
    $sql = "
        SELECT 
            reservation.id_reservation,
            reservation.date_debut,
            reservation.date_fin,
            reservation.nombre_nuit,
            logement.nom_logement,
            client.id_client,
            client.nom_prenom,
            client.telephone_client,
            client.mail_client,
            client.adresse_client
        FROM 
            reservation
        INNER JOIN
            client ON reservation.id_client = client.id_client
        INNER JOIN
            logement ON reservation.id_logement = logement.id_logement
        WHERE
            (client.nom_prenom LIKE :rechercheNom OR logement.nom_logement LIKE :rechercheNom)
            " . (!empty($rechercheDate) ? "AND (reservation.date_debut <= :dateRecherche AND reservation.date_fin >= :dateRecherche)" : "") . "
        ORDER BY
            reservation.date_debut DESC
    ";

    // Préparez la requête
    $displayResa = $dtcosycaen->prepare($sql);

    // Liez le paramètre de recherche
    $rechercheNom = "%$rechercheNom%";
    $displayResa->bindParam(':rechercheNom', $rechercheNom, PDO::PARAM_STR);

    // Liez le paramètre de date si disponible
    if (!empty($rechercheDate) && strtotime($rechercheDate)) {
        // Convertir la date au format SQL (YYYY-MM-DD)
        $dateSQL = date("Y-m-d", strtotime($rechercheDate));

        // Liez le paramètre de date
        $displayResa->bindParam(':dateRecherche', $dateSQL, PDO::PARAM_STR);
    }

    // Exécutez la requête
    $displayResa->execute();

    // Récupérez les résultats
    $historiqueReservations = $displayResa->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($historiqueReservations)) {
        $_SESSION['notif'] = 'Réservation trouvée(s).';
    } else {
        $_SESSION['error'] = 'Aucune réservation trouvée.';
    }
}


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
        <header>
            <!-- ********************** Navbar with burger menu ********************** -->
            <nav id="navbar">
                <a class="navbar-brand" href="admin.php">Admin</a>
                <ul id="mobile-menu" class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="ajouterResa.php">Ajouter une réservation</a></li>

                </ul>
                <div class="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </nav>
        </header>
        <!-- *********************    Titre  ******************* -->
        <h1 class="text-center">
            <div class="slide-right">Rechercher une réservation</div>
        </h1>
      

        <!-- ********************************************** rechercher une resa ********************* -->

        <form id="recherche" class="form m-t50" method="post" action="">
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
            ?>


            <div class="form m-t50">
                <div><label for="rechercheResa">Rechercher par Nom :</label>
                    <input class="form-label" type="text" name="chercherResa" id="rechercheResa" placeholder="Nom ou logement.">
                    <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                </div>
                <div>
                    <div> <label for="dateIn">Rechercher par date :
                        </label>
                        <input class="dateIn form-label" type="date" id="chercheDate" name="chercheDate">
                    </div>
                </div>
                <button name="recherche" type="submit" class="btn m-t50">Rechercher</button>
            </div>
        </form>
        <?php
        // <!-- Affichage des résultats -->
        if (!empty($historiqueReservations)) {
            echo '<div class="flex-form form"><ul>';
            foreach ($historiqueReservations as $reservation) {
                echo '<div class="flex-form form"><li>';
                echo '<dl>';
                echo '<dt><strong>Client:</strong></dt><dd>' . $reservation['nom_prenom'] . '</dd>';
                echo '<dt><strong>Téléphone:</strong></dt><dd>' . $reservation['telephone_client'] . '</dd>';
                echo '<dt><strong>Email:</strong></dt><dd>' . $reservation['mail_client'] . '</dd>';
                echo '<dt><strong>Adresse:</strong></dt><dd>' . $reservation['adresse_client'] . '</dd>';
                echo '<dt><strong>Date de début:</strong></dt><dd>' . date('d/m/Y', strtotime($reservation['date_debut'])) . '</dd>';
                echo '<dt><strong>Date de fin:</strong></dt><dd>' . date('d/m/Y', strtotime($reservation['date_fin'])) . '</dd>';
                echo '<dt><strong>Nombre de nuits:</strong></dt><dd>' . $reservation['nombre_nuit'] . '</dd>';
                echo '<dt><strong>Logement:</strong></dt><dd>' . $reservation['nom_logement'] . '</dd>';
                echo '</dl>';
                echo '<a class="btn m-t50" href="modifier-reservation.php?id=' . urlencode($reservation['id_client']) . '">Modifier</a>';
                echo '<a class="btn m-t50" href="#" onclick="confirmDelete(' . $reservation['id_client'] . ');">Supprimer</a>';
                echo '</li></div>';
            }
            echo '</ul></div>';
        }
        ?>
        <!-- ********************* footer *************************** -->
        <footer class="footer">
            <section class="footer">
                <div class="center-footer column-reverse">
                    <div class="p-l5">
                        <a target="_blank" href="index.php">
                            <h3>Aller vers le site</h3>
                        </a>
                    </div>

                </div>
                </div>
            </section>
            <!-- Copyright -->
            <div class="bottom-footer">
                <div class="p-l5">
                    <p><a href="">Mentions légales</a></p>
                </div>
                <div class="p-l5">
                    <p><a href="">Politique de confidentialité</a></p>
                </div>
                <div class="p-l5">
                    <p>© 2023 Copyright : <a class="" href="aurelienmerouze@gmail.com">y1y1</a></p>
                </div>
            </div>
        </footer>


    </main>
    <script src="Js/script.js"></script>
    <script>
        function confirmDelete(reservationId) {
            var confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cette réservation ?");

            if (confirmDelete) {
                window.location.href = 'delete_reservation.php?id=' + reservationId;
            }
        }
    </script>

</body>

</html>