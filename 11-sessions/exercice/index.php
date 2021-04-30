<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        session_start();

        if (!empty($_POST)) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Pour la partie 2, on va vérifier si l'utilisateur est présent dans la liste des inscrits
            $userlist = $_SESSION['userlist'] ?? [];
            var_dump($userlist);
            foreach ($userlist as $user) {
                if ($login === $user['login'] && $password === $user['password']) {
                    $_SESSION['user'] = $login;
                    header('Location: connecte.php');
                }
            }

            // On vérifie si le login et le mot de passe correspondent à admin admin
            if ($login === 'admin' && $password === 'admin') {
                $_SESSION['user'] = $login; // On "fait" la connexion

                header('Location: connecte.php');
            } else {
                echo 'Login et mot de passe incorrects';
            }
        }
    ?>

    <form method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <button>Connexion</button>
    </form>
</body>
</html>
