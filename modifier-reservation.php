    <?php
    require "../Les_Logements_Cosy/vendor/autoload.php";
    include ".includes/_db.php";
    // Définir le temps d'expiration de la session en secondes (par exemple, 30 minutes)
    $session_lifetime = 1800; // 30 minutes
    ini_set('session.gc_maxlifetime', $session_lifetime);

    session_start();
    $_SESSION['myToken'] = md5(uniqid(mt_rand(), true));

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
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
        // Mise à jour réussie, enregistrez un message de notification
        $_SESSION['notif'] = 'La réservation a été modifiée avec succès.';

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
                    <a class="navbar-brand" href="admin.php">Admin</a>
                    <ul id="mobile-menu" class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="ajouterResa.php">Ajouter une réservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Rechercher une réservation </a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Deconnexion</a></li>


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
                <div class="slide-right">Modifier une réservation</div>
            </h1>
            <?php
            // var_dump($reservationData);
            // var_dump($clientData['clientData']);
            ?>
            <!-- *************************** formulaire modif resa *******************************  -->

            <form id="formModifier" class="form m-t50" method="post" action="">
                <h4 class="text-center">Modifier une réservation</h4>


                <!-- Formulaire de modification -->
                <div>
                    <label>Nom, Prénom actuel : <?php echo $clientData['nom_prenom']; ?></label>
                </div>
                <div class="form">
                    <label for="nomPrenomModif">Nom, Prénom :</label>
                    <input id="nomPrenomModif" type="text" class="name form-label" name="nomPrenomModif" value="<?php echo $clientData['nom_prenom']; ?>" required>
                    <input type="hidden" id="tokenField" name="token" value="<?= $_SESSION['myToken'] ?>">

                </div>
                <div>
                    <label>Téléphone actuel : <?php echo $clientData['telephone_client']; ?></label>
                </div>
                <div class="form">
                    <label for="telephoneModif">Numéro de téléphone :</label>
                    <input id="telephoneModif" type="tel" class="phone form-label" name="telephoneModif" value="<?php echo $clientData['telephone_client']; ?>" required>
                </div>
                <div>
                    <label>Adresse mail actuelle : <?php echo $clientData['mail_client']; ?></label>
                </div>
                <div class="form">
                    <label for="emailModif">Adresse email :</label>
                    <input id="emailModif" type="email" class="email form-label" name="emailModif" value="<?php echo $clientData['mail_client']; ?>" aria-describedby="emailHelp" required>
                </div>
                <div>
                    <label>Adresse actuelle : <?php echo $clientData['adresse_client']; ?></label>
                </div>
                <div class="form">
                    <label for="adresseModif">Adresse :</label>
                    <textarea class="form-label" id="adresseModif" name="adresseModif" required><?php echo $clientData['adresse_client']; ?></textarea>
                </div>
                <div class="form">
                    <label for="idLogementModif">Choix du logement :</label>
                    <select id="idLogementModif" class="housing-choice form-label" name="idLogementModif" aria-label="Default select example" required>
                        <option value="1" <?php echo ($reservationData['id_logement'] == 1) ? 'selected' : ''; ?>>Zénit'House</option>
                        <option value="2" <?php echo ($reservationData['id_logement'] == 2) ? 'selected' : ''; ?>>Cosy Zénith</option>
                        <option value="3" <?php echo ($reservationData['id_logement'] == 3) ? 'selected' : ''; ?>>Cosy Gare</option>
                    </select>
                </div>
                <div class="form">
                    <div>
                        <label>Date de début actuelle : <?php echo $reservationData['date_debut']; ?></label>
                    </div>
                    <div>
                        <label for="dateIn">Date d'arrivée :
                            <input class="dateIn form-label" type="date" id="dateIn" name="dateDebutModif">
                        </label>
                        <div id="dateError" style="color: red;"></div>
                    </div>

                    <div>
                        <label>Date de fin actuelle : <?php echo $reservationData['date_fin']; ?></label>
                    </div>
                    <div>
                        <label for="dateOut">Date de départ :
                            <input class="dateOut form-label" type="date" id="dateOut" name="dateFinModif">
                        </label>
                        <div id="dateOutError" style="color: red;"></div>
                    </div>
                    <div>
                        <label>Nombre de nuits actuel : <?php echo $reservationData['nombre_nuit']; ?></label>
                    </div>
                    <div>
                        <label for="inputNumberNight">Nombre de nuits :
                            <input readonly="readonly" id="inputNumberNight" type="text" class="numberNight form-label" name="numberNightModif" value="<?php echo $reservationData['nombre_nuit']; ?>">

                        </label>

                    </div>
                </div>

                <button name="modifierResa" type="submit" class="btn">Modifier</button>
                <div id="validation-form" class="validation-form"></div>
            </form>
            <!-- ********************* footer *************************** -->

            <footer class="footer">

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