<?php
$title = 'Connexion';
ob_start();
// session_start();
require 'partials/header.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

if (!empty($_POST)) {
    /** @var PDO $db */
    $query = $db->prepare(
        'SELECT * FROM user WHERE email = :email'
    );
    $query->bindValue(':email', $email);
    $query->execute();
    $user = $query->fetch(); // On récupère le user qui veut se connecter

    // On va vérifier que l'utilisateur existe et que le mot de passe saisi
    // correspond au hash de la BDD
    if ($user && password_verify($password, $user['password'])) {
        // On est connecté
        $_SESSION['user'] = $user;
        header('Location: index.php');
    } else {
        echo 'Email ou mot de passe incorrect';
    }
}

// Afficher un message "Bienvenue USER"
// var_dump($_SESSION);

?>

<div class="container">
    <h1>Connexion</h1>

    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-primary">Connexion</button>
    </form>
</div>

<?php require 'partials/footer.php'; ?>
