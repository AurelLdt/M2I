<?php
session_start();

// On vérifie si on se déconnecte
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
}

// On vérifie si l'utilisateur est connecté
// S'il ne l'est pas, on le redirige vers le login
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    // exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
</head>
<body>
    Bonjour <?= $_SESSION['user']; ?>

    <a href="connecte.php?logout">Se déconnecter</a>
</body>
</html>
