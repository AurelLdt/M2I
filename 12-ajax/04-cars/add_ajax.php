<?php

// charset=UTF8 permet de corriger le soucis des accents
$db = new PDO('mysql:host=localhost;dbname=cars;charset=UTF8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$brand = $_POST['brand'] ?? '';
$model = $_POST['model'] ?? '';
$price = $_POST['price'] ?? '';
$errors = [];

if (!empty($_POST)) {

    if (empty($brand)) {
        $errors['brand'] = 'La marque est vide';
    }

    if (empty($model)) {
        $errors['model'] = 'Le modèle est vide';
    }

    if (!ctype_digit($price)) {
        $errors['price'] = 'Le prix est invalide';
    }

    header('Content-Type: application/json');
    // J'autorise n'importe qui à se connecter à l'API
    header('Access-Control-Allow-Origin: *');

    if (empty($errors)) {
        $query = $db->prepare(
            'INSERT INTO cars (brand, model, price)
             VALUES (:brand, :model, :price)'
        );
        $query->execute([
            ':brand' => $brand,
            ':model' => $model,
            ':price' => $price,
        ]);

        echo json_encode([
            // Permet de récupérer l'id qui vient d'être inséré
            'id' => $db->lastInsertId(),
            'brand' => $brand,
            'model' => $model,
            'price' => $price,
        ]);
    } else {
        http_response_code(422);
        echo json_encode($errors);
    }

}
