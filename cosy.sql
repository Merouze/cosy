-- Création de la base de données
CREATE DATABASE dtcosycaen;

-- Création de la table client
CREATE TABLE client(
   id_client INT AUTO_INCREMENT,
   nom_client VARCHAR(50),
   prenom_client VARCHAR(50),
   message_client VARCHAR(500),
   mail_client VARCHAR(60),
   telephone_client VARCHAR(20),
   adresse_client VARCHAR(100),
   PRIMARY KEY(id_client)
);

-- Création de la table logement
CREATE TABLE logement(
   id_logement INT AUTO_INCREMENT,
   nom_logement VARCHAR(50),
   PRIMARY KEY(id_logement)
);

-- Création de la table reservation
CREATE TABLE reservation(
   id_reservation INT AUTO_INCREMENT,
   date_debut DATE,
   date_fin DATE,
   id_logement INT NOT NULL,
   PRIMARY KEY(id_reservation),
   FOREIGN KEY(id_logement) REFERENCES logement(id_logement)
);

-- Création de la table saison
CREATE TABLE saison(
   id_saison INT AUTO_INCREMENT,
   type_saison VARCHAR(50),
   PRIMARY KEY(id_saison)
);

CREATE TABLE prix_logement(
   id_prix_logement INT AUTO_INCREMENT,
   prix DECIMAL(8,2),
   id_logement INT,
   id_saison INT,
   PRIMARY KEY(id_prix_logement),
   FOREIGN KEY(id_logement) REFERENCES logement(id_logement),
   FOREIGN KEY(id_saison) REFERENCES saison(id_saison)
);

-- Création de la table obtenir
CREATE TABLE prix(
   id_client INT,
   id_reservation INT,
   prix_total DECIMAL(8,2),
   PRIMARY KEY(id_client, id_reservation),
   FOREIGN KEY(id_client) REFERENCES client(id_client),
   FOREIGN KEY(id_reservation) REFERENCES reservation(id_reservation)
);

-- ********************************************************************************************************************************************************

-- Insertion de données dans la table client
INSERT INTO client (nom_client, prenom_client, message_client, mail_client, telephone_client, adresse_client)
VALUES
  ('Doe', 'John', 'Bonjour', 'john.doe@example.com', '0634567890', '123 Main '),
  ('Smith', 'Jane', 'Bienvenue', 'jane.smith@example.com', '0676543210', '456 Oak '),
  ('Johnson', 'Bob', 'Salut', 'bob.johnson@example.com', '0651234567', '789 Elm ');

-- Insertion de données dans la table logement
INSERT INTO logement (nom_logement)
VALUES
  ('ZénitHouse'),
  ('Cosy Zénith'),
  ('Cosy Gare');

-- Insertion de données dans la table saison
INSERT INTO saison (nom_saison)
VALUES
  ('Basse Saison'),
  ('Moyenne Saison'),
  ('Haute Saison');

-- Ajout de prix pour chaque logement et chaque saison
INSERT INTO prix_logement (prix, id_logement, id_saison)
VALUES
  (80.00, 1, 1), -- Basse Saison, ZénitHouse
  (60.00, 2, 1), -- Basse Saison, Cosy Zénith
  (50.00, 3, 1),  -- Basse Saison, Cosy Gare

  (100.00, 1, 2), -- Moyenne Saison, ZénitHouse
  (80.00, 2, 2), -- Moyenne Saison, Cosy Zénith
  (70.00, 3, 2), -- Moyenne Saison, Cosy Gare

  (120.00, 1, 3), -- Haute Saison, ZénitHouse
  (100.00, 2, 3), -- Haute Saison, Cosy Zénith
  (90.00, 3, 3); -- Haute Saison, Cosy Gare

-- Insertion de données dans la table reservation
INSERT INTO reservation (date_debut, date_fin, id_logement)
VALUES
  ('2023-01-01', '2023-01-10', 1),
  ('2023-02-01', '2023-02-10', 1),
  ('2023-03-01', '2023-03-10', 1),
  ('2023-01-01', '2023-01-10', 2),
  ('2023-02-15', '2023-02-10', 2),
  ('2023-03-15', '2023-03-10', 2),
  ('2023-01-20', '2023-01-10', 3),
  ('2023-02-20', '2023-02-10', 3),
  ('2023-03-20', '2023-03-10', 3);

-- Mise à jour de la table obtenir avec le prix_total calculé
