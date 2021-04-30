<?php
$title = 'Nos acteurs';
require 'partials/header.php';

// J'ai besoin de récupèrer les acteurs avec la bonne requête
global $db;
$query = $db->query('SELECT * FROM actor');
$actors = $query->fetchAll();
?>

<div class="container">
    <h1>Les acteurs</h1>

    <div class="row">
        <?php foreach ($actors as $actor) { ?>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title text-center"><?= $actor['firstname'].' '.$actor['name']; ?></h2>

                        <div class="text-center">
                            <a class="btn btn-dark" href="./acteur.php?id=<?= $actor['id']; ?>">
                                Voir l'acteur
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php require 'partials/footer.php'; ?>
