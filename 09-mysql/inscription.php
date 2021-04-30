<?php
ob_start();
$title = 'Inscription';
require 'partials/header.php';

// Inscription de l'utilisateur
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$cf_password = $_POST['cf-password'] ?? '';
$errors = [];

// Pour stocker un mot de passe dans la BDD (PAS EN CLAIR NI EN MD5)
// On va générer un hash
// echo $hash = password_hash('azerty', PASSWORD_DEFAULT);
// On peut vérifier qu'un hash correspond à un mot de passe
// Utile pour le login
// var_dump(password_verify('azerty', $hash));

if (!empty($_POST)) {
    // Vérifier l'email (Obligatoire) et vérifier le mot de passe (Obligatoire)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }

    // Le mot de passe doit faire 6 caractères minimum
    if (strlen($password) < 6) {
        $errors['password'] = 'Le mot de passe est trop court';
    }

    // Vérifier que l'email est unique
    global $db;
    $query = $db->prepare('SELECT * FROM user WHERE email = :email');
    // $query->bindValue(':email', $email);
    $query->execute([':email' => $email]);
    $user = $query->fetch();

    if ($user) {
        $errors['email'] = 'L\'email existe déjà';
    }

    // On va vérifier que les 2 mots de passe correspondent
    if ($password !== $cf_password) {
        $errors['password'] = 'Les mots de passe ne correspondent pas';
    }

    // Si aucune erreur, on inscrit l'utilisateur
    if (empty($errors)) {
        /** @var PDO $db */
        $query = $db->prepare(
            'INSERT INTO user (email, password) VALUES (:email, :password)'
        );
        $query->bindValue(':email', $email);
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $query->execute();

        // Si on veut connecter l'utilisateur au moment où il s'inscrit
        // session_start();
        // SELECT * FROM user WHERE email = "toto@toto.com"
        $user = $db->query('SELECT * FROM user WHERE email = "'.$email.'"')->fetch();
        $_SESSION['user'] = $user;

        // Temporairement, on redirige vers le login pour tester la connexion
        // Parfois, le header renvoie une erreur (Dans ce cas, on ajoute ob_start() en haut du fichier)
        // Warning: Cannot modify header information
        header('Location: index.php');
    } else {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>'.$error.'</li>'; // Affiche chaque message d'erreur
        }
        echo '</ul>';
    }
}

?>

<div class="container">
    <h1>Inscription</h1>

    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div>
            <label for="cf-password">Confirmer le mot de passe</label>
            <input type="password" name="cf-password" id="cf-password" class="form-control">
        </div>

        <button class="btn btn-primary">Inscription</button>
    </form>
</div>

<?php require 'partials/footer.php'; ?>
