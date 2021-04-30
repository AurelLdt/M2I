<?php require 'partials/header.php';

// Ici, on récupère la catégorie qu'on modifie dans la BDD
$id = $_GET['id'] ?? 0;

global $db;
$query = $db->prepare('SELECT * FROM category WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
$category = $query->fetch();

// Si la catégorie n'existe pas, on renvoie une 404
if (!$category) {
    require 'partials/404.php';
}

// Tips: $_REQUEST regroupe $_POST et $_GET
$name = $_POST['name'] ?? $category['name'];
$errors = [];

if (!empty($_POST)) {
    // On vérifie que le nom de la catégorie fasse au moins 2 caractères
    if (strlen($name) < 2) {
        $errors['name'] = 'Le nom est trop court';
    }

    // Après avoir vérifié les erreurs, s'il n'y en a pas, on modifie la catégorie dans la BDD
    if (empty($errors)) {
        // Ici, on fait le insert. Le @var permet d'avoir l'auto-complétion
        /** @var PDO $db */
        $query = $db->prepare('UPDATE category SET name = :name WHERE id = :id');
        $query->bindValue(':name', $name);
        $query->bindValue(':id', $id);
        $query->execute();

        // Idéalement, on peut faire une redirection après avoir inséré la catégorie
        // Evite que l'utilisateur renvoie le formulaire avec F5
        header('Location: categorie-liste.php?success');
    }
} // Fin du if pour vérifier la soumission du formulaire

?>

<h1>Modifier la catégorie <?= $category['name']; ?></h1>
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

    <button class="btn btn-primary">Modifier</button>
</form>

<?php require 'partials/footer.php'; ?>
