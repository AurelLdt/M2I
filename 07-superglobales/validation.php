<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <?php
        /*
        Valider les données d'un formulaire est une étape CRUCIALE pour
        le développeur back end. Cela va nous assurer d'avoir des données
        correctes dans la BDD et surtout d'éviter parfois les failles.

        On va imaginer le formulaire suivant :
            - Un email (Valide et obligatoire)
            - Un âge (Majeur)
            - Un code postal (Doit faire 5 caractères, doit exister mais n'est pas obligatoire)
        */

        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';
        $zip = $_POST['zip'] ?? '';

        $age = htmlspecialchars($age); // Cette fonction transforme les < en &lt; et tous les
        // caractères spéciaux HTML en caractères non interprétables

        // On va pouvoir vérifier les données (seulement si le formulaire est soumis)
        $errors = [];
        if (!empty($_POST)) {
            // On vérifie l'email
            if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'L\'email n\'est pas valide';
            }

            // On vérifie l'âge
            if ($age < 18) {
                $errors['age'] = 'Vous n\'êtes pas majeur';
            }

            // On vérifie le code postal (entre 00000 et 99999)
            if (strlen($zip) !== 5 || !ctype_digit($zip)) {
                $errors['zip'] = 'Le code postal est invalide';
            }

            // var_dump($errors);
        }
    ?>

    <div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"
                    class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    value="<?= $email; ?>">
                <?php if (isset($errors['email'])) {
                    echo '<span class="text-danger">'.$errors['email'].'</span>';
                } ?>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" name="age" id="age"
                    class="form-control <?= isset($errors['age']) ? 'is-invalid' : ''; ?>"
                    value="<?= $age; ?>">
                <?php if (isset($errors['age'])) {
                    echo '<span class="text-danger">'.$errors['age'].'</span>';
                } ?>
            </div>

            <div class="form-group">
                <label for="zip">Code postal</label>
                <input type="text" name="zip" id="zip"
                    class="form-control <?= isset($errors['zip']) ? 'is-invalid' : ''; ?>"
                    value="<?= $zip; ?>">
                <?php if (isset($errors['zip'])) {
                    echo '<span class="text-danger">'.$errors['zip'].'</span>';
                } ?>
            </div>

            <button class="btn btn-dark">Envoyer</button>
        </form>

        <?php
            if (!empty($_POST) && empty($errors)) { // Le formulaire est soumis 
                // et il n'y a pas d'erreurs
                echo "Bonjour $email, votre age est $age, vous habitez dans le $zip";
            }
        ?>
    </div>

</body>
</html>
