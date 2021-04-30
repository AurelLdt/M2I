<?php require 'partials/header.php'; ?>

<?php
// Tips: $_REQUEST regroupe $_POST et $_GET
$name = $_POST['name'] ?? '';
$errors = [];

if (!empty($_POST)) {
    // On vérifie que le nom de la catégorie fasse au moins 2 caractères
    if (strlen($name) < 2) {
        $errors['name'] = 'Le nom est trop court';
    }

    // Après avoir vérifié les erreurs, s'il n'y en a pas, on ajoute la catégorie dans la BDD
    if (empty($errors)) {
        // Ici, on fait le insert. Le @var permet d'avoir l'auto-complétion
        /** @var PDO $db */
        $query = $db->prepare('INSERT INTO category (name) VALUES (:name)');
        $query->bindValue(':name', $name);
        $query->execute();

        // Idéalement, on peut faire une redirection après avoir inséré la catégorie
        // Evite que l'utilisateur renvoie le formulaire avec F5
        header('Location: categorie-ajout.php?success');
    }
} // Fin du if pour vérifier la soumission du formulaire

// On vérifie si l'utilisateur vient d'ajouter une catégorie (paramètre success présent)
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success dismissable fade show">
        Votre catégorie a bien été ajoutée dans la BDD.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>';
}

?>

<h1>Ajouter une catégorie</h1>
<form method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name"
               class="form-control <?= isset($errors['name']) ? 'is-invalid' : ''; ?>"
               value="<?= $name; ?>">

        <?php if (isset($errors['name'])) { // S'il y a un erreur sur le champ
            echo '<span class="text-danger">'.$errors['name'].'</span>';
        } ?>
    </div>

    <button class="btn btn-primary">Ajouter</button>
</form>

<?php require 'partials/footer.php'; ?>
