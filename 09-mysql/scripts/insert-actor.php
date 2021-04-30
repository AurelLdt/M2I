<?php

// J'inclus la connexion à la base de données
require __DIR__.'/../config/database.php';

$actors = [
    ['Pacino', 'Al', '1940-04-25'],
    ['Brando', 'Marlon', '1924-04-03'],
    ['de Niro', 'Robert', '1943-08-17'],
    ['Willis', 'Bruce', '1955-03-19'],
    ['Liotta', 'Ray', '1954-12-18'],
    ['Snipes', 'Wesley', '1962-07-31'],
    ['Stalone', 'Sylvester', '1946-07-06'],
    ['Norton', 'Edward', '1969-08-18'],
    ['Spacey', 'Kevin', '1959-07-26'],
    ['Kilmer', 'Val', '1959-12-31'],
    // Simulation d'une injection SQL
    ['Milou', "Tintin'); INSERT INTO actor (name, firstname, birthday) VALUES ('HACKED', 'HACKED', '1991-11-18');", '1999-12-25'],
];

$db->query('SET FOREIGN_KEY_CHECKS = 0');
$db->query('TRUNCATE actor');
$db->query('SET FOREIGN_KEY_CHECKS = 1');

foreach ($actors as $actor) {
    // $db->query("INSERT INTO actor (name, birthday, firstname) VALUES ('$actor[0]', '$actor[2]', '$actor[1]')");
    echo "INSERT INTO actor (name, birthday, firstname) VALUES ('$actor[0]', '$actor[2]', '$actor[1]')";
    // echo '<br />'.PHP_EOL;
    // On peut écrire une requête préparée pour se protéger des injections SQL. Les injections SQL ne sont possibles que
    // s'il y a dans la requête une concaténation avec des entrées utilisateurs ($_GET, $_POST).
    // Dans une requête préparée, on a des paramètres qui ressemblent à :colonne
    $query = $db->prepare("INSERT INTO actor (name, firstname, birthday) VALUES (:name, :firstname, :birthday)");
    // On renseigne chaque paramètre de la requête
    $query->bindValue(':name', $actor[0]);
    $query->bindValue(':firstname', $actor[1]);
    $query->bindValue(':birthday', $actor[2]);
    // On exécute la requête
    $query->execute();
}
