<?php
    session_start();
    require __DIR__.'/../../config/functions.php';
    // Le chemin est relatif à index.php
    // require 'config/config.php';
    // On peut utiliser le chemin absolu pour que ce soit plus parlant
    // __DIR__ renvoie C:\wamp64\www\php\08-includes\partials
    require __DIR__.'/../../config/config.php';
    // On va inclure la connexion à la BDD
    require_once __DIR__.'/../../config/database.php';

    // On va vérifier que l'utilisateur est bien administrateur
    // pour pouvoir accéder au back office
    if (!isAdmin()) {
        require 'partials/403.php';
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/scss/index.css">

    <?php
    // On vérifie si le développeur a ajouté un fichier CSS
    // pour la page
    if (isset($stylesheet)) { ?>
        <link rel="stylesheet" href="<?= $stylesheet; ?>">
    <?php } ?>
</head>
<body class="admin">
    <header class="navbar navbar-dark sticky-top bg-dark">
        <div class="col-lg-2">
            <a class="navbar-brand ms-3" href="./dashboard.php">
                Mon dashboard
            </a>
        </div>
        <div class="col-lg-10 text-end">
            <ul class="navbar-nav me-3">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Retour au site</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 px-0 bg-secondary">
                <nav class="sticky-top">
                    <ul class="nav flex-column pt-3">
                        <li class="nav-item">
                            <a class="nav-link" href="./categorie-ajout.php">
                                Ajouter une catégorie
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./categorie-liste.php">
                                Catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./film-ajout.php">
                                Ajouter un film
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./utilisateur-liste.php">
                                Utilisateurs
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-10">
