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
        <header>
            <!-- ********************** Navbar with burger menu ********************** -->
            <nav id="navbar">
                <a class="navbar-brand" href="index.php">Les Logements Cosy</a>
                <ul id="mobile-menu" class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#form">Ajouter une réservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="#recherche">Rechercher une réservation </a></li>

                </ul>
                <div class="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </nav>
        </header>
        <!-- *********************    Titre  ******************* -->
        <section class="header">
            <h1 class="text-center">
                <div class="slide-right">Admin</div>
            </h1>
            <?php

            ?>
            <div>
                <h2 class="text-center first-h2">Vacances, Hébergements et Locations saisonnières</h2>
            </div>
        </section>
        <h2 class="text-center m-b70 m-t70 p-20">Un lieu unique pour <span class="text-brown">un séjour unique
                ...</span></h2>

        <!-- *************************** formulaire ajout resa *******************************  -->

        <form id="form" class="form m-t50" method="post" action="traitement_reservation.php">
            <h4 class="text-center">Ajouter une réservation</h4>
            <div class="flex-form">
                <div class="form">
                    <div class="form-name">
                        <div>
                            <label for="inputName">Nom, Prénom :
                                <input id="inputName" type="text" class="name form-label" name="nomPrenom">
                            </label>
                            <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                        </div>
                        <div>
                            <label for="inputNumber">Numéro de téléphone :
                                <input id="inputNumber" type="tel" class="phone form-label" name="telephone">
                            </label>
                        </div>
                        <div>
                            <label for="inputEmail">Adresse email :
                                <input id="inputEmail" type="email" class="email form-label" name="email" aria-describedby="emailHelp">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <label for="inputAddress">Adresse :</label>
                    <textarea class="form-label" type="text" id="inputAddress" name="adresse" placeholder="Entrez votre adresse"></textarea>

                </div>
                <div class="form">
                    <div class="select-date">
                        <div>
                            <label for="input-choice">Choix du logement :
                                <select id="input-choice" class="housing-choice form-label" name="idLogement" aria-label="Default select example">
                                    <option selected disabled>Choisissez votre logement</option>
                                    <option value="1">Cosy Patio</option>
                                    <option value="2">Cosy Zénith</option>
                                    <option value="3">Zénit'House</option>
                                </select>
                            </label>
                        </div>
                        <div>
                            <label for="dateIn">Date d'arrivée :
                                <input class="dateIn form-label" type="date" id="dateIn" name="dateDebut">
                            </label>
                            <div id="dateError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="dateOut">Date de départ :
                                <input class="dateOut form-label" type="date" id="dateOut" name="dateFin">
                            </label>
                            <div id="dateOutError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="inputNumberNight">Nombre de nuits :
                                <input id="inputNumberNight" type="text" class="numberNight form-label" name="numberNight">
                            </label>
                        </div>
                    </div>
                </div>

                <button name="resa" type="submit" class="btn">Ajouter</button>
                <div id="validation-form" class="validation-form"></div>
            </div>
        </form>
        <!-- ********************************************** rechercher une resa ********************* -->

        <form id="recherche" class="form m-t50" method="post" action="traitement_reservation.php">
            <h4 class="text-center">Rechercher une réservation</h4>

            <div class="form m-t50">
                <div><label for="rechercheResa">Rechercher par :</label>
                    <input class="form-label" type="text" name="chercherResa" id="rechercheResa" placeholder="Nom, date ou logement.">
                    <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                </div>
                <button name="recherche" type="submit" class="btn m-t50">Rechercher</button>

            </div>
        </form>

        <?php
// ...

$historiqueReservations = [];
    
        
// if (isset($_POST)) {
//     $recherche = strip_tags($_POST['chercherResa']);
if (isset($_POST['recherche'])) {
    if (isset($_POST['chercherResa'])) {
        $recherche = strip_tags($_POST['chercherResa']);
        

    // Vérifiez si la valeur de recherche est une date valide
    $dateDebut = date('Y-m-d', strtotime($recherche));
    $dateFin = date('Y-m-d', strtotime($recherche));

    // Construisez la requête avec les conditions de date
    $displayResa = $dtcosycaen->prepare("
        SELECT 
        reservation.id_reservation,
            reservation.date_debut,
            reservation.date_fin,
            reservation.nombre_nuit,
            logement.nom_logement,
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
            client.nom_prenom LIKE :recherche
            OR reservation.date_debut <= :dateDebut
            OR reservation.date_fin >= :dateFin
            OR logement.nom_logement LIKE :recherche
            ORDER BY
            reservation.date_debut DESC
            ");

    // Liez le paramètre de recherche
    $displayResa->bindParam(':recherche', $recherche, PDO::PARAM_STR);

    // Liez les paramètres de date
    $displayResa->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $displayResa->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);

    // ...

    // Exécutez la requête
    $displayResa->execute();

    // Récupérez les résultats
    $historiqueReservations = $displayResa->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des résultats de la recherche
    if (!empty($historiqueReservations)) {
        $_SESSION['notif'] = 'Réservation trouvée(s)';
    } else {
        $_SESSION['error'] = 'Aucune réservation trouvée';
    }

}}


// ...
?>

<!-- Affichage des résultats -->
<?php
if (!empty($historiqueReservations)) {
    echo '<ul>';
    foreach ($historiqueReservations as $reservation) {
        echo '<li>';
        echo '<strong>Client:</strong> ' . $reservation['nom_prenom'] . '<br>';
        echo '<strong>Téléphone:</strong> ' . $reservation['telephone_client'] . '<br>';
        echo '<strong>Email:</strong> ' . $reservation['mail_client'] . '<br>';
        echo '<strong>Adresse:</strong> ' . $reservation['adresse_client'] . '<br>';
        echo '<strong>Date de début:</strong> ' . date('d/m/Y', strtotime($reservation['date_debut'])) . '<br>';
        echo '<strong>Date de fin:</strong> ' . date('d/m/Y', strtotime($reservation['date_fin'])) . '<br>';
        echo '<strong>Nombre de nuits:</strong> ' . $reservation['nombre_nuit'] . '<br>';
        echo '<strong>Logement:</strong> ' . $reservation['nom_logement'] . '<br>';
        echo '<a href="edit.php?id=' . $reservation['id_reservation'] . '">Modifier</a>';
        echo '<a href="edit.php?id=' . $reservation['id_reservation'] . '">Supprimer</a>';

        echo '</li>';
    }
    echo '</ul>';
}
// var_dump($historiqueReservations);
?>




        <!-- ********************* footer *************************** -->

        <footer class="footer">
            <section class="footer">
                <div class="center-footer column-reverse">
                    <div class="p-l5">
                        <h3>Contact</h3>
                        <p>
                            +33688011150
                            <br>
                            cosycaen@gmail.com
                            <br>
                            CaenlaMer, 14, France
                        </p>
                    </div>
                    <div class="p-l5">
                        <h3>
                            Les logements Cosy
                        </h3>
                        <p>
                            Un lieu unique pour un séjour unique.
                            <br>
                            Les logements Cosy,
                            <br>
                            Vacances, Hébergements, Gites, Locations saisonnières.
                        </p>
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
</body>

</html>