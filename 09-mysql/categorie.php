<?php

$id = $_GET['id'] ?? 0;

$title = 'Catégorie '.$id;
require 'partials/header.php';

global $db;
// $query = $db->prepare('SELECT * FROM movie WHERE category_id = :id');
$query = $db->prepare(
    'SELECT *, movie.id AS id, movie.title AS movie_title FROM movie
     INNER JOIN category ON movie.category_id = category.id
     WHERE category_id = :id'
);
$query->bindValue(':id', $id);
$query->execute();
$movies = $query->fetchAll();

// Si on veut récupèrer la catégorie sans jointure, on peut faire une 2ème requête
$query = $db->prepare('SELECT * FROM category WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
// $category = $query->fetch();
$category = $movies[0]; // Récupère le premier film du tableau pour avoir le
// nom de la catégorie
?>

<div class="container">
    <h1><?= $category['name']; ?></h1>

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
