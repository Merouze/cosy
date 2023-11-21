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

                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="icon/icons8-france-48 (2) (1).png"
                                alt="drapeaux français choix langues"></a>
                        <ul class="dropdown-menu">
                            <li class="li-dropdown"><a href="#"><img src="icon/icons8-france-48 (2) (1).png" alt="drapeaux français"></a>
                            </li>
                            <li class="li-dropdown"><a href="en-index.php"><img src="icon/icons8-united-kingdom-48 (1) (1).png"
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
            <div class="slide-right">Les Logements Cosy</div>
        </h1>
        
        <?php
        
?>
        <div>
            <h2 class="text-center first-h2">Vacances, Hébergements et Locations saisonnières</h2>
        </div>
    </section>
    <h2 class="text-center m-b70 m-t70 p-20">Un lieu unique pour <span class="text-brown">un séjour unique
            ...</span></h2>
    <!-- *********************    Section présentation logements ******************* -->
    <h2 class="text-center m-b50">Venez découvrir nos logements</h2>
    <div class="container  column-reverse p-20 ">
        <hr>
        <div class="text-center p-20 display-text">
            <a href="Zénit'House.html">
                <h2 class="">Zénit'House</h2>
            </a>
            <p>
                A 5 minutes en voiture du Zénith et du parc expo, cette charmante maison Cosy est
                parfaite pour profiter des évènements organisés aux alentours !
            </p>
        </div>
        <div class=""><a href="Zénit'House.html"><img class="height-img border-radius"
                    src="img-zenithouse-webp/salon-zénithouse (1).webp" alt="Salon Zénit'House"></a>
        </div>
    </div>
    <div class="container bloc-display-flex  p-20">
        <div class=""><a href="CosyZénith.html"><img class="height-img border-radius" src="img-zénith-webp/salon.webp"
                    alt="Chambre Caen Patio"></a>
        </div>
        <div class="text-center p-20 display-text"><a href="CosyZénith.html">
                <h2 class="">Cosy Zénith</h2>
            </a>
            <p>
                Idéalement situé à proximité du Zénith, du centre-ville et du stade d'Ornano, vous
                découvrirez ce magnifique appartement Cosy orienté plein sud et sans aucun vis à vis !
            </p>
        </div>
        <hr>
    </div>
    <div class="container bloc-display-flex p-20">
        <hr>
        <div class="text-center p-20 display-text">
            <a href="CosyPatio.html">
                <h2 class="">Cosy Gare</h2>
            </a>
            <p>
                Venez découvrir cette suite à l'ambiance très Cosy, située idéalement à deux pas de
                la gare de Caen et proche de toutes commodités !
            </p>
        </div>
        <div class=""><a href="CosyPatio.html"><img class="height-img border-radius"
                    src="img-Gare-webp/salon2-patio (1).webp" alt="Chambre Caen Patio"></a>
        </div>
    </div>

    <!-- *********************** section Prestation ************************ -->
    <a href="NosPrestations.html">
        <h2 class="text-center m-t70 m-b50">Que proposons nous ?</h2>
    </a>
    <div class="container bloc-display-flex p-20 text-center">
        <p>
            Nous avons
            sélectionné avec soin une gamme de logement située à Caen la Mer. Notre site de location
            saisonnière
            vous propose une sélection de logements de qualité pour vous offrir un séjour confortable et
            mémorable.
        </p>
    </div>
    <div class="text-center p-20 display-text">
        <div class=""><a href="NosPrestations.html"><img class="height-img border-radius"
                    src="img-Gare-webp/chambre-patio (1).webp" alt="Chambre Caen Patio"></a>
        </div>
        <hr>
    </div>
    <!-- *************************  section Découvrir **************************** -->
    <a class="" href="CaenlaMer.html">
        <h2 class="text-center m-b70">Tant à
            découvrir</h3>
    </a>
    <div class="container text-center">
        <p class="text-center">Bienvenue à Caen la Mer, votre destination idéale pour des vacances inoubliables en
            Normandie !</p>
    </div>
    <div class="container column-reverse p-20">
        <div class="text-center p-20 display-text">
            <ul class="list-none">
                <li><a class="text-reset fw-bold"
                        href="https://www.normandie-tourisme.fr/decouverte/histoire/d-day-et-bataille-de-normandie/les-plages-du-debarquement/">
                        <p>Les
                            plages du débarquements</p>
                    </a></li>
                <li><a class="text-reset fw-bold"
                        href="https://www.caenlamer-tourisme.fr/patrimoine-culturel/chateau-de-caen/">
                        <p>Le château
                            de Caen</p>
                    </a></li>
                <li><a class="text-reset fw-bold"
                        href="https://www.caenlamer-tourisme.fr/decouvrir-caen-la-mer/sur-les-traces-du-debarquement-et-de-la-bataille-de-normandie-a-caen/le-memorial-de-caen/">
                        <p>Le
                            Mémorial de Caen</p>
                    </a></li>
                <li><a class="text-reset fw-bold" href="https://festyland.com/">
                        <p>Parc d'attraction Festyland</p>
                    </a>
                </li>
                <li><a class="text-reset fw-bold" href="http://www.suisse-normande-tourisme.com/">
                        <p>La Suisse
                            Normande</p>
                    </a></li>
            </ul>
        </div>
        <div class=""><a href="CaenlaMer.html"><img class="height-img border-radius" src="Img-CaenlaMer/Plage.jpg"
                    alt="Plage"></a>
        </div>
        
    </div>
    <div class="container">
        <hr>
    </div>    <!-- ********************* commentaire *************************** -->

    <section>
        <h2 class="text-center m-t50">Commentaires</h2>
        <div class="container bloc-display-flex p-20 ">
                <div class="customer-review">
                    <hr>
                    <div class="stars">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <p class="comment">“ Séjour de 2 nuits pour un concert au Zénith de Caen. Nous y étions en 5 minutes en voiture. Nous en avons profité pour faire des visites alentours (40 minutes maximum des plages du débarquement). Le logement de Franck est très cocooning, on s’y sent bien. La décoration est très jolie. Nous y reviendrons avec plaisir. ”</p>
                    <p class="name">Laëtitia.</p>
                    <p class="date">Avril, 2023</p>
                    <hr>
                </div>
                <div class="customer-review">
                    <hr>
                    <div class="stars">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <p class="comment">“ Excellent séjour chez Franck dans ce studio charmant et très bien équipé. Franck est un hôte très agréable au contact facile au plaisir de revenir. ”</p>
                    <p class="name">Linoa.</p>
                    <p class="date">Mai, 2023</p>
                    <hr>
                </div>
            </div>
    </section>
    <!-- ****************** Formulaire ******************** -->
    <form action="action.php" method="post" id="form" class="form m-t50">
        <div class="flex-form">
            <h4 class="text-center">Demande d'informations</h4>
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
                        <label for="nom_prenom" class="">Nom, Prénom :
                            <input id="nom_prenom" type="text" class="name form-label"></label>
                    </div>
                    <div>
                        <label for="telephone_client" class="">Numéro de téléphone :
                            <input id="telephone_client" type="tel" class="phone form-label"></label>
                    </div>
                    <div>
                        <label for="mail_client" class="">Adresse email :
                            <input id="mail_client" type="email" class="email form-label"
                                aria-describedby="emailHelp"></label>
                        <div id="emailHelp" class="form-text">Votre e-mail ne sera pas diffusé.</div>
                    </div>
                    <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                    <!-- <input type="hidden" name="info_client" value="1"> -->

                </div>
            </div>
            <div class="form">
                <div class="form-com">
                    <label for="message_client">Ecrivez nous :</label>
                    <textarea id="message_client" class="message" placeholder="Laissez-nous votre message !"
                        style="height: 100px"></textarea>
                </div>
                <div class="">
                    <input type="checkbox" class="" id="check">
                    <label class="p-l5" for="check">J'accepte de recevoir des informations concernant nos promotions et
                        notre actualité. Pour en savoir plus, consulter notre <a href="#">politique
                            de confidentialité.</a></label>
                </div>
            </div>
            <div class="">
            </div>
            <div class="">
                <button id="submitBtn" type="submit" class="btn">Envoyer</button>
                <div id="validation-form" class="validation-form"></div>
            </div>
        </div>

     </form>
     <?php
var_dump ($_POST);
?>

    <!-- ********************* footer *************************** -->

    <footer class="footer">
        <section class="top-footer">
            <div class="top-footer">
                <p>N'hésitez pas à nous contacter avec les coordonées ci-dessous </p>
            </div>
        </section>
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