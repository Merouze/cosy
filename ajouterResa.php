<?php
require "../Les_Logements_Cosy/vendor/autoload.php";
include ".includes/_db.php";
include_once 'functions.php';

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
                <a class="navbar-brand" href="admin.php">Admin</a>
                <ul id="mobile-menu" class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="admin.php">Rechercher une réservation </a></li>

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
                <div class="slide-right">Ajouter une réservation</div>
            </h1>
            
       <!-- *************************** formulaire ajout resa *******************************  -->

        <form id="form" class="form m-t50" method="post" action="traitement_reservation.php">
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
                                    <option value="3">Cosy Gare</option>
                                    <option value="2">Cosy Zénith</option>
                                    <option value="1">Zénit'House</option>
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
        

        <!-- ********************* footer *************************** -->

        <footer class="footer"> 
            <section class="footer">
                <div class="center-footer column-reverse">
                    <div class="p-l5">
                        <a target="_blank" href="index.php"><h3>Aller vers le site</h3></a>
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