<?php
// On peut définir un titre et un css spécifique pour la page
$title = 'Les films';
$stylesheet = 'assets/css/films.css';

require 'partials/header.php';

// Requête SQL pour les films
global $db;
$movies = $db->query('SELECT * FROM movie')->fetchAll();
?>

<div class="container">
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success dismissable fade show">
            Votre film a bien été ajouté dans la BDD.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <h1>Les films</h1>

    <div class="row">
        <?php foreach ($movies as $movie) { ?>
            <div class="col-3">
                <div class="card shadow mb-4">
                    <img class="card-img-top" src="uploads/movies/<?= $movie['cover']; ?>" />
                    <div class="card-body">
                        <h2 class="card-title"><?= $movie['title']; ?></h2>
                        <p class="card-text">
                            Sorti en <?= substr($movie['released_at'], 0, 4); ?>
                        </p>
                        <p class="card-text">
                            <?= $movie['description']; ?>
                        </p>

                        <div class="d-grid">
                            <a href="./film.php?id=<?= $movie['id']; ?>" class="btn btn-danger">Voir le film</a>
                        </div>
                    </div>

                    <div class="card-footer text-muted">
                        <?php
                        // Représente la note du film
                        $note = rand(0, 5);
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $note) {
                                echo '★';
                            } else {
                                echo '☆';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php require 'partials/footer.php'; ?>
