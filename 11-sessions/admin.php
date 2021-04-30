<?php

$_SESSION['users'] = [
    ['login' => 'a', 'password' => 'toto'],
    ['login' => 'b', 'password' => 'titi'],
];

$_SESSION['user'] = 'b';

session_start();

// On peut vérifier si un cookie est présent
// dans $_COOKIE
// var_dump($_COOKIE['user']);
// Ici, on vérifie si l'utilisateur n'a plus de session mais
// qu'il avait coché la case "Remember"
if (!isset($_SESSION['user']) && isset($_COOKIE['user'])) {
    // Attention, il faudrait sécuriser cela
    $_SESSION['user'] = $_COOKIE['user'];
}

// On peut récupèrer des données qui ont
// été ajoutées dans la session
if (isset($_SESSION['user'])) { ?>
    <h1>Bonjour <?= $_SESSION['user']; ?></h1>

    <a href="admin.php?logout">Déconnexion</a>
<?php }

// On vérifie s'il veut se déconnecter
if (isset($_GET['logout'])) {
    // Je supprime une partie de la session
    unset($_SESSION['user']);

    // Le code suivant supprimer tout le tableau
    // session_destroy();
    header('Location: index.php');
}
