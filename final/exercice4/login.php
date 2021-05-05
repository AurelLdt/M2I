<?php

require 'config.php';

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (!empty($_POST)) {
    $query = $db->prepare('select * from admin where email = :email');
    $query->execute(['email' => $email]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user->password)) {
        $_SESSION['user'] = $user;
        header('Location: stagiaire_ajout.php');
    } else {
        echo 'PAS OK';
    }
}

?>

<form method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>

    <button>Login</button>
</form>
