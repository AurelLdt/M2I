<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php
        session_start();

        if (!empty($_POST)) {
            /*
                $_SESSION = [
                    'userlist' => [
                        ['login' => 'b', 'password' => 'c'],
                        ['login' => 'a', 'password' => 'b'],
                        ['login' => 'a', 'password' => 'b']
                    ],
                    'panier' => [1, 2, 3],
                    'user' => 'toto',
                ];
            */
            $_SESSION['userlist'][] = [
                'login' => $_POST['login'],
                'password' => $_POST['password']
            ];

            var_dump($_SESSION);
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

        <button>Inscription</button>
    </form>
</body>
</html>
