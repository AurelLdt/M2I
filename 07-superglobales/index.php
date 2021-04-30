<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperGlobales</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <h2>Les superglobales en PHP</h2>
        <p>$_GET et $_POST sont des variables superglobales. On va les utiliser pour récupèrer des valeurs dans l'URL ou dans un formulaire.</p>

        <a class="btn btn-primary" href="index.php?name=toto">Hello Toto</a>
        <a class="btn btn-primary" href="index.php?name=tata">Hello Tata</a>
        <a class="btn btn-primary" href="index.php">Hello World</a>

        <?php
            // $_GET permet de récupèrer tous les paramètres de l'URL. Les paramètres se définissent en accèdant à l'URL de cette manière : index.php?name=toto&id=10
            // ? pour le premier paramètre et & pour les suivants
            var_dump($_GET);

            // On peut récupérer un paramètre particulier
            // On n'oublie pas de vérifier le paramètre car il peut ne pas exister
            $name = isset($_GET['name']) ? $_GET['name'] : 'world';
        ?>

        <h1>Hello <?= $name; ?></h1>

        <h2>Un formulaire avec $_GET</h2>

        <?php
            // On récupère le terme de la recherche
            $search = $_GET['search'] ?? ''; // Opérateur null coalesce (équivalent du ternaire)
        ?>

        <form method="get" action="">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Votre recherche..."
                   value="<?= $search; ?>">

            <button class="btn btn-primary">Ok</button>
        </form>

        <!-- Ici, on affiche une liste de résultats s'il y a eu une recherche -->
        <?php if (!empty($search)) { ?>

            <ul>
                <li>A</li>
                <li>B</li>
                <li>C</li>
            </ul>

        <?php } ?>

        <h2>Un formulaire avec $_POST</h2>

        <?php
            // On récupère l'email et le mot de passe s'ils sont saisis dans le formulaire
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $skills = $_POST['skills'] ?? [];
        ?>

        <form method="post" action="">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $email; ?>">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe">

            <div class="form-check">
                <input type="checkbox" name="skills[]" value="front" class="form-check-input"
                       id="front"
                       <?php echo in_array('front', $skills) ? 'checked' : ''; ?>
                >
                <label for="front" class="form-check-label">Front</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="skills[]" value="back" class="form-check-input"
                       id="back"
                       <?= in_array('back', $skills) ? 'checked' : ''; ?>
                >
                <label for="back" class="form-check-label">Back</label>
            </div>

            <button class="btn btn-primary">S'inscrire</button>
        </form>

        <?php
            var_dump($_POST);

            if (!empty($_POST)) { // On vérifie si le formulaire est bien soumis
                // On peut potentiellement vérifier les données...
                // On va créer un tableau d'erreurs vide qu'on va pouvoir remplir au fur et à mesure des vérifications
                $errors = [];

                // Si l'email est invalide, on ajoute un message dans le tableau
                if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Pour ajouter quelque chose dans un tableau
                    // array_push($errors, 'L\'email est invalide.');
                    $errors[] = 'L\'email est invalide.';
                }

                // On voudrait vérifier que le mot de passe fasse 6 caractères au minimum
                if (strlen($password) < 6) {
                    $errors[] = 'Le mot de passe est trop court.';
                }

                // Est-ce que mon formulaire est correct ?
                if (empty($errors)) { // Si le tableau d'erreurs est vide
                    echo 'Le formulaire est correct';
                } else {
                    // Ici je vais parcourir le tableau d'erreurs pour les afficher
                    echo '<ul>';
                    foreach ($errors as $error) {
                        echo '<li>'.$error.'</li>'; // Affiche chaque message d'erreur
                    }
                    echo '</ul>';
                }
            } // Fin du premier if
        ?>
    </div>

</body>
</html>
