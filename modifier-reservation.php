    <?php
    require "../Les_Logements_Cosy/vendor/autoload.php";
    include ".includes/_db.php";
    session_start();
    $_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
    ?>
    <?php
    // Récupérer l'ID de la réservation à modifier depuis l'URL
    $clientId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Récupérer les données actuelles de la réservation depuis la base de données
    $getClientData = $dtcosycaen->prepare("SELECT * FROM client WHERE id_client = :id");
    $getClientData->execute(['id' => $clientId]);
    $clientData = $getClientData->fetch(PDO::FETCH_ASSOC);

    $getData = $dtcosycaen->prepare("SELECT * FROM reservation WHERE    id_client = :id");
    $getData->execute(['id' => $clientId]);
    $reservationData = $getData->fetch(PDO::FETCH_ASSOC);

    // Traitement du formulaire de modification lors de la soumission
    if (isset($_POST['modifierResa'])) {
        // Récupérer les données du formulaire
        $nomPrenomModif = strip_tags($_POST['nomPrenomModif']);
        $telephoneModif = strip_tags($_POST['telephoneModif']);
        $emailModif = strip_tags($_POST['emailModif']);
        $adresseModif = strip_tags($_POST['adresseModif']);
        $idLogementModif = intval(strip_tags($_POST['idLogementModif']));
        $dateDebutModif = strip_tags($_POST['dateDebutModif']);
        $dateFinModif = strip_tags($_POST['dateFinModif']);
        $numberNightModif = intval(strip_tags($_POST['numberNightModif']));

        // Mettre à jour les informations du client associé
        $updateClient = $dtcosycaen->prepare("UPDATE client SET
        nom_prenom = :nomPrenom,
        telephone_client = :telephone,
        mail_client = :email,
        adresse_client = :adresse
        WHERE id_client = :idClient
    ");

        $updateClient->execute([
            'nomPrenom' => $nomPrenomModif,
            'telephone' => $telephoneModif,
            'email' => $emailModif,
            'adresse' => $adresseModif,
            'idClient' => $clientData['id_client'],
        ]);
        $updateResa = $dtcosycaen->prepare("UPDATE reservation SET
        date_debut = :debut,
        date_fin = :fin,
        nombre_nuit = :nombreNuit,
        id_logement = :idLogement
        WHERE id_client = :id
    ");

        $updateResa->execute([
            'debut' => $dateDebutModif,
            'fin' => $dateFinModif,
            'nombreNuit' => $numberNightModif,
            'idLogement' => $idLogementModif,
            'id' => $clientId,
        ]);


        // Rediriger après la mise à jour
        header('Location: admin.php');
        exit;
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
                    <div class="slide-right">Modifier une réservation</div>
                </h1>
                <?php

                ?>
                <div>
                    <h2 class="text-center first-h2">Vacances, Hébergements et Locations saisonnières</h2>
                </div>
            </section>
            <h2 class="text-center m-b70 m-t70 p-20">Un lieu unique pour <span class="text-brown">un séjour unique
                    ...</span></h2>

            <!-- *************************** formulaire modif resa *******************************  -->
            <!-- 

            <form id="form" class="form m-t50" method="post" action="traitement_modifier_reservation.php">
                <h4 class="text-center">Modifier une réservation</h4>
                <div class="flex-form">
                    <div class="form">
                        <div class="form-name">
                            <div>
                                <label for="inputName">Nom, Prénom :
                                    <input id="inputName" type="text" class="name form-label" name="new-nomPrenom">
                                </label>
                                <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">
                            </div>
                            <div>
                                <label for="inputNumber">Numéro de téléphone :
                                    <input id="inputNumber" type="tel" class="phone form-label" name="new-telephone">
                                </label>
                            </div>
                            <div>
                                <label for="inputEmail">Adresse email :
                                    <input id="inputEmail" type="email" class="email form-label" name="new-email" aria-describedby="emailHelp">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form">
                        <label for="inputAddress">Adresse :</label>
                        <textarea class="form-label" type="text" id="inputAddress" name="new-adresse" placeholder="Entrez votre adresse"></textarea>

                    </div>
                    <div class="form">
                        <div class="select-date">
                            <div>
                                <label for="input-choice">Choix du logement :
                                    <select id="input-choice" class="housing-choice form-label" name="new-idLogement" aria-label="Default select example">
                                        <option selected disabled>Choisissez votre logement</option>
                                        <option value="1">Cosy Patio</option>
                                        <option value="2">Cosy Zénith</option>
                                        <option value="3">Zénit'House</option>
                                    </select>
                                </label>
                            </div>
                            <div>
                                <label for="dateIn">Date d'arrivée :
                                    <input class="dateIn form-label" type="date" id="dateIn" name="new-dateDebut">
                                </label>
                                <div id="dateError" style="color: red;"></div>
                            </div>
                            <div>
                                <label for="dateOut">Date de départ :
                                    <input class="dateOut form-label" type="date" id="dateOut" name="new-dateFin">
                                </label>
                                <div id="dateOutError" style="color: red;"></div>
                            </div>
                            <div>
                                <label for="inputNumberNight">Nombre de nuits :
                                    <input id="inputNumberNight" type="text" class="numberNight form-label" name="new-numberNight">
                                </label>
                            </div>
                        </div>
                    </div> -->

            <!-- Formulaire de modification -->
            <form id="formModifier" class="form m-t50" method="post" action="">
                <h4 class="text-center">Modifier une réservation</h4>
                <!-- Afficher les données actuelles de la réservation pour référence -->
                <div>
                    <label>Nom, Prénom actuel : <?php echo $clientData['nom_prenom']; ?></label>
                </div>
                <div>
                    <label>Téléphone actuel : <?php echo $clientData['telephone_client']; ?></label>
                </div>
                <div>
                    <label>Adresse mail actuelle : <?php echo $clientData['mail_client']; ?></label>
                </div>
                <div>
                    <label>Adresse actuelle : <?php echo $clientData['adresse_client']; ?></label>
                </div>
                <div>
                    <label>Date de début actuelle : <?php echo $reservationData['date_debut']; ?></label>
                </div>
                <div>
                    <label>Date de fin actuelle : <?php echo $reservationData['date_fin']; ?></label>
                </div>
                <div>
                    <label>Nombre de nuits actuel : <?php echo $reservationData['nombre_nuit']; ?></label>
                </div>
                <div>
                    <label>Nombre de nuits actuel : <?php echo $reservationData['nombre_nuit']; ?></label>
                </div>

                <!-- Formulaire de modification -->
                <div class="form">
                    <label for="nomPrenomModif">Nom, Prénom :</label>
                    <input id="nomPrenomModif" type="text" class="name form-label" name="nomPrenomModif" value="<?php echo $clientData['nom_prenom']; ?>" required>
                </div>
                <div class="form">
                    <label for="telephoneModif">Numéro de téléphone :</label>
                    <input id="telephoneModif" type="tel" class="phone form-label" name="telephoneModif" value="<?php echo $clientData['telephone_client']; ?>" required>
                </div>
                <div class="form">
                    <label for="emailModif">Adresse email :</label>
                    <input id="emailModif" type="email" class="email form-label" name="emailModif" value="<?php echo $clientData['mail_client']; ?>" aria-describedby="emailHelp" required>
                </div>
                <div class="form">
                    <label for="adresseModif">Adresse :</label>
                    <textarea class="form-label" id="adresseModif" name="adresseModif" required><?php echo $clientData['adresse_client']; ?></textarea>
                </div>
                <div class="form">
                    <label for="idLogementModif">Choix du logement :</label>
                    <select id="idLogementModif" class="housing-choice form-label" name="idLogementModif" aria-label="Default select example" required>
                        <option value="1" <?php echo ($reservationData['id_logement'] == 1) ? 'selected' : ''; ?>>Cosy Patio</option>
                        <option value="2" <?php echo ($reservationData['id_logement'] == 2) ? 'selected' : ''; ?>>Cosy Zénith</option>
                        <option value="3" <?php echo ($reservationData['id_logement'] == 3) ? 'selected' : ''; ?>>Zénit'House</option>
                    </select>
                </div>
                <div class="form">
                    <div>
                        <label for="dateIn">Date d'arrivée :
                            <input class="dateIn form-label" type="date" id="dateIn" name="dateDebutModif">
                        </label>
                        <div id="dateError" style="color: red;"></div>
                    </div>
                    <div>
                        <label for="dateOut">Date de départ :
                            <input class="dateOut form-label" type="date" id="dateOut" name="dateFinModif">
                        </label>
                        <div id="dateOutError" style="color: red;"></div>
                    </div>
                    <div>
                        <label for="inputNumberNight">Nombre de nuits :
                            <input id="inputNumberNight" type="text" class="numberNight form-label" name="numberNightModif">
                        </label>
                    </div>
                </div>
                </div>  


                <!-- Bouton de soumission -->
                <button name="modifierResa" type="submit" class="btn">Modifier</button>
                <div id="validation-form" class="validation-form"></div>
            </form>


            <?php

            ?>


            <div id="validation-form" class="validation-form"></div>
            </form>
            <?php
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
        <script>
            function confirmDelete(reservationId) {
                let confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cette réservation ?");

                if (confirmDelete) {
                    window.location.href = 'delete_reservation.php?id=' + reservationId;
                }
            }
        </script>
        <script src="Js/script.js"></script>
    </body>

    </html>