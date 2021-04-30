<?php

try {
    // Connexion à la BDD
    $db = new PDO('mysql:host=localhost;dbname=webflix;charset=UTF8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Afficher les erreurs SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // On récupére un tableau associatif dans les résultats
    ]);

    // Si on veut les films d'une catégorie
    $category = $_GET['category'] ?? null;

    if ($category) {
        // Requête pour les films d'une catégorie
        $query = $db->prepare(
            'SELECT * FROM movie WHERE category_id = :category'
        );
        $query->execute([':category' => $category]);
        $movies = $query->fetchAll();
    } else {
        // Requête pour récupèrer les films
        $movies = $db->query('SELECT * FROM movie')->fetchAll();
    }

    // On précise qu'on renvoie du JSON et pas du HTML
    header('Content-Type: application/json');

    // Renvoyer le tableau de films en JSON
    echo json_encode($movies);
} catch (\Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
