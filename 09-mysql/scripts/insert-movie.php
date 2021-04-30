<?php

// J'inclus la connexion à la base de données
require __DIR__.'/../config/database.php';

$movies = [
    ['Le Parrain', 1972, 186, 1],
    ['Scarface', 1983, 120, 1],
    ['Les Affranchis', 1990, 145, 1],
    ['Heat', 1995, 146, 1],
    ['Die Hard', 1988, 124, 2],
    ['Demolition Man', 1993, 89, 2],
    ['Taken', 2008, 96, 2],
    ['Deadpool', 2016, 97, 2],
    ['The Expandables', 2010, 132, 2],
    ['Scream', 1996, 78, 3],
    ['Vendredi 13', 1980, 97, 3],
    ['Saw', 2005, 102, 3],
    ['Scary Movie', 2000, 79, 3],
    ['Star Wars IV Un nouvel espoir', 1977, 160, 4],
    ['Alien', 1979, 145, 4],
    ['ET', 1982, 95, 4],
    ['Robocop', 1987, 98, 4],
    ['The Game', 1997, 96, 5],
    ['Sixième Sens', 1999, 120, 5],
    ['Usual Suspects', 1995, 114, 5],
    ['Fight Club', 1999, 108, 5],
    ['Inception', 2010, 107, 5],
    ['Deadpool 2', 1019, 93, 2],
];

$db->query('SET FOREIGN_KEY_CHECKS = 0');
$db->query('TRUNCATE movie');
$db->query('SET FOREIGN_KEY_CHECKS = 1');

foreach ($movies as $movie) {
    // Sixième Sens -> sixieme-sens.jpg
    $cover = str_replace(' ', '-', $movie[0]);
    $cover = str_replace('è', 'e', $cover);
    // $cover = str_replace(['è', ' '], ['e', '-'], $movie[0]);
    $cover = strtolower($cover).'.jpg';

    $db->query("INSERT INTO movie (title, released_at, description, duration, cover, category_id)
                VALUES ('$movie[0]', '$movie[1]-01-01', 'Lorem ipsum', $movie[2], '$cover', '$movie[3]')");
    echo "INSERT INTO movie (title, released_at, description, duration, cover, category_id)
          VALUES ('$movie[0]', '$movie[1]-01-01', 'Lorem ipsum', $movie[2], '$cover', '$movie[3]')";
    // PHP_EOL est une constante qui permet de faire un retour chariot dans la CLI
    echo '<br />'.PHP_EOL;
}
