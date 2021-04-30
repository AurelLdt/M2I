<?php

// Création d'une classe avec méthodes statiques
// Nous allons créer une classe DB qui va nous aider à écrire nos requêtes SQL
// plus facilement et plus rapidement.

// Actuellement
$db = new PDO('mysql:host=localhost;dbname=webflix;charset=UTF8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

// Si on veut faire un select
$query = $db->query('SELECT * FROM movie LIMIT 2');
$movies = $query->fetchAll();
var_dump($movies);

// Si on veut faire un select préparé
$query = $db->prepare('SELECT * FROM movie WHERE id = :id');
$query->bindValue(':id', 1);
$query->execute([':id' => 1]);
$movie = $query->fetch();
var_dump($movie);

// Avec les objets
require 'DB.php';
// On pourrait aussi faire $db = new DB(); mais on veut le faire en statique pour l'exemple
$movies = DB::query('SELECT * FROM movie LIMIT 2');
$movie = DB::query('SELECT * FROM movie WHERE id = :id', ['id' => 1]);
var_dump($movie);

// Test du insert
DB::postQuery(
    'INSERT INTO movie (title, released_at, description, duration, cover, category_id)
     VALUES (:title, :released_at, :description, :duration, :cover, :category_id)',
    [
        'title' => 'La planète des singes',
        'released_at' => '2021-03-19',
        'description' => 'Lorem',
        'duration' => 180,
        'cover' => 'heat.jpg',
        'category_id' => 4
    ]
);

// $movies est un tableau d'objet grâce à PDO::FETCH_OBJ
foreach ($movies as $movie) {
    // echo $movie['title'].'<br />';
    echo $movie->title.'<br />';
}
