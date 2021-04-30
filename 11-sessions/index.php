<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Sessions</title>
</head>
<body>
    
    <?php
        // On appelle la fonction suivante pour pouvoir utiliser les sessions
        session_start();

        // On a accès à une superglobale $_SESSION qui nous permet de manipuler la session
        if (!empty($_POST)) {
            $_SESSION['user'] = $_POST['user'];

            // Si on a coché la case "Remember", on crée un cookie
            if (isset($_POST['remember'])) {
                // Notre cookie expire dans 1 an
                setcookie('user', $_POST['user'], time() + 60 * 60 * 24 * 365);
            }

            header('Location: admin.php');
        }
    ?>

    <form method="post">
        <label for="user">Utilisateur</label>
        <input type="text" name="user" id="user">

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Se rappeler de moi</label>

        <button>Connexion</button>
    </form>

</body>
</html>
