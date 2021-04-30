<?php

// On va d'abord récupèrer l'id dans l'URL
$id = $_GET['id'] ?? 0;

$title = 'Acteur '.$id;
require __DIR__.'/partials/header.php';

// On va récupèrer l'acteur dont l'ID est dans l'URL
global $db;
// On prépare la requête pour éviter des problèmes de sécurité (Injection SQL)
$query = $db->prepare('SELECT * FROM actor WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute(); // Nécessaire si on prépare la requête
$actor = $query->fetch(); // On a une seule ligne de résultat

// Récupérer les films de l'acteur
$query = $db->prepare('SELECT * FROM movie INNER JOIN movie_has_actor ON movie_has_actor.movie_id = movie.id WHERE movie_has_actor.actor_id = :id');
$query->execute([':id' => $id]);
$movies = $query->fetchAll();

// On vérifie ici si l'acteur existe dans la base
// Sinon on renvoie une 404
if (!$actor) {
    require 'partials/404.php';
}
?>

<div class="container">
    <h1>L'acteur <?= $actor['firstname'].' '.$actor['name']; ?></h1>
    <!-- La date est au format 1950-11-18 dans la BDD -->
    <!-- Né le 18 novembre 1950 -->
    <p>Né le <?= date('d F Y', strtotime($actor['birthday'])); ?></p>
    <p>Pour formater la date en français</p>
    <?php setlocale(LC_ALL, 'fr.utf-8'); ?>
    <p><?= strftime('%d %B %Y', strtotime($actor['birthday'])); ?></p>

    <h1>Ses films</h1>

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
