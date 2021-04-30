<?php

/**
 * Le but de ce script est de remplir la BDD avec des catégories.
 * Le script vide la base et la re-remplit pour repartir au propre.
 * Le script peut s'exécuter sur le navigateur ou en CLI :
 * php .\09-mysql\scripts\insert-category.php
 */

// J'inclus la connexion à la base de données
require __DIR__.'/../config/database.php';

// Les catégories à ajouter dans la BDD
$categories = ['Films de gangsters', 'Action', 'Horreur', 'Science-fiction', 'Thriller'];

// On va vider la table avant de la remplir (et on remet les ids à 0)
// On désactiver temporairement la vérification des clés êtrangères
$db->query('SET FOREIGN_KEY_CHECKS = 0');
$db->query('TRUNCATE category');
$db->query('SET FOREIGN_KEY_CHECKS = 1');

foreach ($categories as $category) {
    $db->query("INSERT INTO category (name) VALUES ('$category')");
    echo "INSERT INTO category (name) VALUES ('$category')";
    echo '<br />';
}

// "INSERT INTO category (name) VALUES ('Films de gangsters')";
// "INSERT INTO category (name) VALUES ('Action')";
// "INSERT INTO category (name) VALUES ('Horreur')";
// "INSERT INTO category (name) VALUES ('Science-fiction')";
// "INSERT INTO category (name) VALUES ('Thriller')";
