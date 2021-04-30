<?php
// On va inclure le header (le doctype et le menu) sur chaque page
// $title = 'Mon super site';
require 'partials/header.php';

/**
 * 1. On va poser le carousel des films
 * 2. Par défaut, on utilise Bootstrap et on va afficher 3 jaquettes de films par slide
 * 3. On aura 3 slides donc 9 films ce qui veut dire qu'on doit écrire une requête SQL qui récupère
 *    les 9 derniers films par date de sortie.
 * 4. Pour la boucle, on part d'un tableau de 9 éléments et on doit l'afficher dans le code HTML du carousel
 * 5. Pour la selection de films aléatoires, il faudra récupérer 4 films aléatoires (RAND())
 */

global $db;
$carouselMovies = $db->query('SELECT * FROM movie ORDER BY released_at DESC LIMIT 9')->fetchAll();
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <?php foreach ([0, 3, 6] as $key) { ?>
            <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
                <div class="d-flex">
                    <img src="uploads/movies/<?= $carouselMovies[$key]['cover']; ?>"
                         class="d-block" alt="<?= $carouselMovies[$key]['title']; ?>">
                    <img src="uploads/movies/<?= $carouselMovies[$key+1]['cover']; ?>"
                         class="d-block" alt="<?= $carouselMovies[$key+1]['title']; ?>">
                    <img src="uploads/movies/<?= $carouselMovies[$key+2]['cover']; ?>"
                         class="d-block" alt="<?= $carouselMovies[$key+2]['title']; ?>">
                </div>
            </div>
        <?php } ?>

        <?php /* foreach ($carouselMovies as $key => $carouselMovie) { ?>
            <?php if ($key % 3 === 0) { ?>
            <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
                <div class="d-flex">
            <?php } ?>
                    <img src="uploads/movies/<?= $carouselMovies[$key]['cover']; ?>"
                         class="d-block" alt="<?= $carouselMovies[$key]['title']; ?>">
            <?php if (($key + 1) % 3 === 0) { ?>
                </div>
            </div>
            <?php } ?>
        <?php } */ ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php
$randomMovies = $db->query('SELECT * FROM movie ORDER BY RAND() LIMIT 4');
?>
<div class="container mt-4 mb-5">
    <h2>Sélection de films aléatoires</h2>

    <div class="row">
        <?php foreach ($randomMovies as $movie) { ?>
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
