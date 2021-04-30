<?php

// charset=UTF8 permet de corriger le soucis des accents
$db = new PDO('mysql:host=localhost;dbname=cars;charset=UTF8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$id = $_GET['id'] ?? null;

if ($id) {
    $query = $db->prepare('SELECT * FROM cars WHERE id = :id');
    $query->execute(['id' => $id]);
    $cars = $query->fetch(); // On récupère 1 SEULE voiture
} else {
    $cars = $db->query('SELECT * FROM cars')->fetchAll();
}

header('Content-Type: application/json');
// J'autorise n'importe qui à se connecter à l'API
header('Access-Control-Allow-Origin: *');

echo json_encode($cars);
