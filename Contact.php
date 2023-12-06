
<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
session_start();
$_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
?>
<?php
// Étape 1 : Récupération des données depuis la base de données
// Préparez la requête
$sql = "SELECT date_debut, date_fin, logement.id_logement, logement.nom_logement AS logement_nom FROM reservation
        INNER JOIN logement ON reservation.id_logement = logement.id_logement";

$statement = $dtcosycaen->prepare($sql);

// Exécutez la requête
$statement->execute();

// Récupérez les résultats
$reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

// Étape 2 : Formatage des données
$events = array();

foreach ($reservations as $row) {
    $currentDate = new DateTime($row['date_debut']);
    $endDate = new DateTime($row['date_fin']);

    while ($currentDate <= $endDate) {
    $color = '';
    switch ($row['id_logement']) {
        case 1:
            $color = 'green';
            break;
        case 2:
            $color = 'blue';
            break;

        case 3:
            $color = 'red';
            break;
        default:
            $color = 'gray'; // Couleur par défaut
    }

    $event = array(
        'title' => $row['logement_nom'],
        // 'start' => $row['date_debut'],
        // 'end' => $row['date_fin'],
        'start' => $currentDate->format('Y-m-d'),

        'color' => $color,
    );

    $events[] = $event;
    $currentDate->modify('+1 day');

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
    
    <title>Contactez nous, Vacances, Hébergements, Gites et Locations saisonnières à Caen.</title>
</head>

<body>
    <main>
    <!-- *************** Navbar with Menu Burger ************************ -->
    <header>
        <nav id="navbar">
            <a class="navbar-brand" href="index.php">Les Logements Cosy</a>
            <ul id="mobile-menu" class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="#"><img src="icon/icons8-france-48 (2) (1).png"
                            alt="drapeaux français choix langues"></a>
                    <ul class="dropdown-menu">
                        <li class="li-dropdown"><a href="#"><img src="icon/icons8-france-48 (2) (1).png" alt="drapeaux français"></a>
                        </li>
                        <li class="li-dropdown"><a href="#"><img src="icon/icons8-united-kingdom-48 (1) (1).png"
                                    alt="drapeaux anglais"></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nos logements</a>
                    <ul class="dropdown-menu">
                        <li class="li-dropdown"><a class="li-a" href="Zénit'House.html">Zénit'House</a></li>
                        <li class="li-dropdown"><a class="li-a" href="CosyZénith.html">Cosy Zénith</a></li>
                        <li class="li-dropdown"><a class="li-a" href="CosyPatio.html">Cosy Gare</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="NosPrestations.html">Nos prestations</a></li>
                <li class="nav-item"><a class="nav-link" href="NosPromotions.html">Nos promotions</a></li>
                <li class="nav-item"><a class="nav-link" href="CaenlaMer.html">Caen la Mer</a></li>
                <li class="nav-item"><a class="nav-link" href="Contact.html">Contact</a></li>
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
                <div class="slide-right">Contactez nous</div>
            </h1>
            <div>
                <h2 class="text-center first-h2">Vacances, Hébergements et Locations saisonnières</h2>
            </div>
        </section>
        <h2 class="text-center p-20 m-b70 m-t70">Un lieu unique pour <span class="text-brown">un séjour unique ...</span></h2>
        <!-- *******************************************calendrier**************************** -->
        <div class="calendar" id='calendar'></div>

            <!-- ***************************fomulaire********************** -->
        <form id="formulaire" method="post" action="email.php" class="form">
            <h4 class="text-center">Demande d'informations</h4>
            <div class="flex-form">
                <div class="form">
                    <div class="select-date">
                        <div>
                            <label for="input-choice-logement" class="">Choix du logement :
                                <select name="choix-logement" id="input-choice-logement" class="housing-choice form-label"
                                    aria-label="Default select example"></label>
                            <option selected>Choisissez votre logement</option>
                            <option value="Cosy Patio">Cosy Patio</option>
                            <option value="Cosy Zénith">Cosy Zénith</option>
                            <option value="Zénit'House">Zénit'House</option>
                            </select>
                        </div>
                        <div>
                            <label for="dateIn-logement">Date d'arrivée :
                                <input class="dateIn form-label" type="date" id="dateIn" name="trip-start" /></label>
                            <div id="dateError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="dateOut">Date de départ :
                                <input class="dateOut form-label" type="date" id="dateOut" name="trip-end" /></label>
                            <div id="dateOutError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="inputNumberNight-logement" class="">Nombre de nuits :
                                <input id="inputNumberNight-logement" type="text" name="inputNumberNight-logement" class="numberNight form-label"></label>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-name">
                        <div class="">
                            <label for="inputName"  class="">Nom, Prénom :
                                <input id="inputName" name="name-logement" type="text" class="name form-label"></label>
                        </div>
                        <div>
                            <label for="inputNumber" class="">Numéro de téléphone :
                                <input name="inputNumber-logement" type="tel" class="phone form-label"></label>
                        </div>
                        <div>
                            <label for="inputEmail-logement" class="">Adresse email :
                                <input name="mail-logement" id="inputEmail-logement" type="email" class="email form-label"
                                    aria-describedby="emailHelp"></label>
                            <div id="emailHelp" class="form-text">Votre e-mail ne sera pas diffusé.</div>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-com">
                        <label for="commentaire">Ecrivez nous :</label>
                        <textarea id="commentaire" name="commentaire" class="message" placeholder="Laissez-nous votre message !"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="">
                        <input name="checkbox-logement" type="checkbox" class="" id="check">
                        <label for="check">J'accepte de recevoir des informations concernant nos promotions et
                            notre actualité. Pour en savoir plus, consulter notre <a href="#">politique
                                de confidentialité.</a></label>
                    </div>
                </div>
                <div class="m-b50">
                    <div id="validation-form" class="validation-form"></div>
                </div>
                <div class="">
                    <button type="submit" class="btn">Envoyer</button>
                </div>
            </div>
        </form>

        <!-- ********************* footer *************************** -->

        <footer class="footer">
            <section class="top-footer">
                <div class="top-footer">
                    <p>N'hésitez pas à nous contacter avec les coordonées ci-dessous </p>
                </div>
            </section>
            <section class="footer">
                <div class="center-footer">
                    <div>
                        <h3>Contact</h3>
                        <p>
                            +33688011150
                            <br>
                            cosycaen@gmail.com
                            <br>
                            CaenlaMer, 14, France
                        </p>
                    </div>
                    <div>
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
                <div class="">
                    <p><a href="">Mentions légales</a></p>
                </div>
                <div class="">
                    <p><a href="">Politique de confidentialité</a></p>
                </div>
                <div class="">
                    <p>© 2023 Copyright : <a class="" href="aurelienmerouze@gmail.com">y1y1</a></p>
                </div>
            </div>
        </footer>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($events); ?>,
            // ... d'autres options de configuration du calendrier ...
        });

        calendar.render();
    });
</script>
    <script src="Js/script.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    
</body>

</html>