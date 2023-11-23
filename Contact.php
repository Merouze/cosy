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


                <!-- <div class="text-center figure-caption mt-2 mb-5">Les périodes indisponibles à la location sont affiché
                    en rouge.</div>
            </div> -->
            <!-- ***************************fomulaire********************** -->
        <form id="form" class="form">
            <h4 class="text-center">Demande d'informations</h4>
            <div class="flex-form">
                <div class="form">
                    <div class="select-date">
                        <div>
                            <label for="input-choice" class="">Choix du logement :
                                <select id="input-choice" class="housing-choice form-label"
                                    aria-label="Default select example"></label>
                            <option selected>Choisissez votre logement</option>
                            <option value="Cosy Patio">Cosy Patio</option>
                            <option value="Cosy Zénith">Cosy Zénith</option>
                            <option value="Zénit'House">Zénit'House</option>
                            </select>
                        </div>
                        <div>
                            <label for="dateIn">Date d'arrivée :
                                <input class="dateIn form-label" type="date" id="dateIn" name="trip-start" /></label>
                            <div id="dateError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="dateOut">Date de départ :
                                <input class="dateOut form-label" type="date" id="dateOut" name="trip-start" /></label>
                            <div id="dateOutError" style="color: red;"></div>
                        </div>
                        <div>
                            <label for="inputNumberNight" class="">Nombre de nuits :
                                <input id="inputNumberNight" type="text" class="numberNight form-label"></label>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-name">
                        <div class="">
                            <label for="inputName" class="">Nom, Prénom :
                                <input id="inputName" type="text" class="name form-label"></label>
                        </div>
                        <div>
                            <label for="inputNumber" class="">Numéro de téléphone :
                                <input id="inputNumber" type="tel" class="phone form-label"></label>
                        </div>
                        <div>
                            <label for="inputEmail" class="">Adresse email :
                                <input id="inputEmail" type="email" class="email form-label"
                                    aria-describedby="emailHelp"></label>
                            <div id="emailHelp" class="form-text">Votre e-mail ne sera pas diffusé.</div>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="form-com">
                        <label for="commentaire">Ecrivez nous :</label>
                        <textarea id="commentaire" class="message" placeholder="Laissez-nous votre message !"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="">
                        <input type="checkbox" class="" id="check">
                        <label class="" for="check">J'accepte de recevoir des informations concernant nos promotions et
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
    <script src="Js/script.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    
    
</body>

</html>