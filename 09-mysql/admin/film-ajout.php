<?php require 'partials/header.php'; ?>

<?php
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$cover = $_POST['cover'] ?? '';
$duration = $_POST['duration'] ?? '';
$released_at = $_POST['released_at'] ?? '';
$category_id = $_POST['category'] ?? '';
$errors = [];

// Protection contre les attaques XSS
$title = htmlspecialchars($title);
$description = htmlspecialchars($description);

// On récupère les catégories pour le select
global $db;
$categories = $db->query('SELECT * FROM category')->fetchAll();

if (!empty($_POST)) {
    if (strlen($title) < 2) {
        $errors['title'] = 'Le titre est trop court';
    }

    if (strlen($description) < 15) {
        $errors['description'] = 'La description est trop courte';
    }

    // Ici, on pourra vérifier la cover


    if ($duration < 1 || $duration > 999) {
        $errors['duration'] = 'La durée n\'est pas valide';
    }

    // Vérification de la date
    $month = formatDate($released_at, '%m');
    $day = formatDate($released_at, '%d');
    $year = formatDate($released_at, '%Y');

    if ($released_at !== formatDate($released_at, '%Y-%m-%d') || !checkdate($month, $day, $year)) {
        $errors['released_at'] = 'La date n\'est pas valide';
    }

    // Vérification de la catégorie
    if (!in_array($category_id, array_column($categories, 'id'))) {
        $errors['category'] = 'La categorie n\'est pas valide';
    }

    if (empty($errors)) {

        // Ici, on peut faire l'upload

        // Ici, on fait la requête SQL
        $query = $db->prepare(
            'INSERT INTO movie (title, description, cover, duration, released_at, category_id)
             VALUES (:title, :description, :cover, :duration, :released_at, :category_id)'
        );

        $query->bindValue(':title', $title);
        $query->bindValue(':description', $description);
        $query->bindValue(':cover', $cover);
        $query->bindValue(':duration', $duration);
        $query->bindValue(':released_at', $released_at);
        $query->bindValue(':category_id', $category_id);

        $query->execute();

        header('Location: ../films.php?success');
    }
}
?>

<h1>Ajouter un film</h1>

<form method="POST">
    <div class="mb-3">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title"
               class="form-control <?= isset($errors['title']) ? 'is-invalid' : ''; ?>"
               value="<?= $title; ?>">

        <?php if (isset($errors['title'])) {
            echo '<span class="text-danger">'.$errors['title'].'</span>';
        } ?>
    </div>

    <div class="mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description"
            class="form-control <?= isset($errors['description']) ? 'is-invalid' : ''; ?>"
            ><?= $description;?></textarea>

        <?php if (isset($errors['description'])) {
            echo '<span class="text-danger">'.$errors['description'].'</span>';
        } ?>
    </div>

    <div class="mb-3">
        <label for="cover">Jaquette</label>
        <input type="text" name="cover" id="cover"
               class="form-control <?= isset($errors['cover']) ? 'is-invalid' : ''; ?>"
               value="<?= $cover; ?>">

        <?php if (isset($errors['cover'])) {
            echo '<span class="text-danger">'.$errors['cover'].'</span>';
        } ?>
    </div>

    <div class="mb-3">
        <label for="duration">Durée</label>
        <input type="text" name="duration" id="duration"
               class="form-control <?= isset($errors['duration']) ? 'is-invalid' : ''; ?>"
               value="<?= $duration; ?>">

        <?php if (isset($errors['duration'])) {
            echo '<span class="text-danger">'.$errors['duration'].'</span>';
        } ?>
    </div>

    <div class="mb-3">
        <label for="released_at">Date</label>
        <input type="date" name="released_at" id="released_at"
               class="form-control <?= isset($errors['released_at']) ? 'is-invalid' : ''; ?>"
               value="<?= $released_at; ?>">

        <?php if (isset($errors['released_at'])) {
            echo '<span class="text-danger">'.$errors['released_at'].'</span>';
        } ?>
    </div>

    <div class="mb-3">
        <label for="category">Catégorie</label>
        <select name="category" id="category" class="form-control <?= isset($errors['category']) ? 'is-invalid' : ''; ?>">
            <option value="">Choisir une catégorie</option>
            <?php foreach ($categories as $category) { ?>
                <option <?= ($category['id'] === $category_id) ? 'selected': ''; ?>
                    value="<?= $category['id']; ?>">
                    <?= $category['name']; ?>
                </option>
            <?php } ?>
        </select>

        <?php if (isset($errors['category'])) {
            echo '<span class="text-danger">'.$errors['category'].'</span>';
        } ?>
    </div>

    <button class="btn btn-primary">Ajouter</button>
</form>

<?php require 'partials/footer.php'; ?>
