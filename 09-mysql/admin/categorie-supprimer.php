<?php

// On inclut la database
require 'partials/header.php';

// On récupère l'id
$id = $_GET['id'] ?? 0;

// On fait la suppression
global $db;
$query = $db->prepare(
    'DELETE FROM category WHERE id = :id'
);
$query->bindValue(':id', $id);
$query->execute();

// On redirige vers la liste
header('Location: categorie-liste.php?delete');
