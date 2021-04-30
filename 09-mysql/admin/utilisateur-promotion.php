<?php

require 'partials/header.php';

$id = $_GET['id'] ?? 0;

// On récupère le user pour connaitre son rôle actuel
global $db;
$query = $db->prepare('SELECT * FROM user WHERE id = :id');
$query->execute([':id' => $id]);
$user = $query->fetch();

// On vérifie que l'utilisateur existe
if ($user) {
    // Si son rôle actuel est user, on le passe en admin sinon on le passe en user
    $newRole = $user['role'] === 'user' ? 'admin' : 'user';

    $query = $db->prepare(
        'UPDATE user SET role = :role WHERE id = :id'
    );
    $query->execute([
        ':id' => $id,
        ':role' => $newRole,
    ]);
}

header('Location: utilisateur-liste.php?promotion');
