<?php

// Pour utiliser le header('Location: ...'); et afficher du contenu avant
ob_start();

// On va d'abord récupèrer l'id dans l'URL
$id = $_GET['id'] ?? 0;

// On inclus la connexion à la base de données avant
// pour pouvoir afficher le titre du film dans la balise
// title (require_once pour être sûr de ne faire qu'une
// seule connexion)
require_once 'config/database.php';

/**
 * Si on veut récupérer le film et ses acteurs en 1 seule requête
 * (Attention on doit changer le code)
 * SELECT * FROM movie
 * INNER JOIN movie_has_actor ON movie.id = movie_has_actor.movie_id
 * INNER JOIN actor ON actor.id = movie_has_actor.actor_id
 * WHERE movie.id = 4;
 */

global $db;
$query = $db->prepare('SELECT * FROM movie WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute(); // Nécessaire si on prépare la requête
$movie = $query->fetch(); // On a une seule ligne de résultat

// J'affiche le titre du film dans la balise title du head
$title = $movie['title'];
require __DIR__.'/partials/header.php';

// Si le film n'existe pas
if (!$movie) {
    require 'partials/404.php';
}
?>

<div class="container my-4">
    <div class="row">
        <div class="col-lg-5">
            <img class="img-fluid" src="uploads/movies/<?= $movie['cover']; ?>" />
        </div>
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <h1><?= $movie['title']; ?></h1>
                    <p>Durée: <?= convertToHours($movie['duration']); ?></p>
                    <p>Sorti le <?= formatDate($movie['released_at']); ?></p>

                    <div>
                        <?= $movie['description']; ?>
                    </div>

                    <div class="mt-5">
                        <?php
                            $query = $db->prepare(
                                'SELECT * FROM actor
                                 INNER JOIN movie_has_actor ON actor.id = movie_has_actor.actor_id
                                 WHERE movie_has_actor.movie_id = :id'
                            );
                            $query->execute([':id' => $id]);
                            $actors = $query->fetchAll();
                        ?>
                        <h5>Avec :</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($actors as $actor) { ?>
                                <li><a href="./acteur.php?id=<?= $actor['id']; ?>">
                                    <?= $actor['firstname'].' '.$actor['name']; ?>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <?php
                        $format = $_POST['format'] ?? null;
                        $errors = [];

                        // Traitement du formulaire panier
                        if (!empty($_POST) && isset($_POST['cart'])) {

                            $allowedFormats = ['1080p', 'VOD', '4K'];

                            if (!in_array($format, $allowedFormats)) {
                                $errors['format'] = 'Le format est invalide.';
                            }
                            
                            // On vérifie si le produit est déjà présent dans le panier (Titre et format)
                            // Si c'est le cas, on augmente sa quantité de 1
                            // Sinon, on ajoute simplement le produit

                            if (empty($errors)) {
                                if (checkCart($movie, $format)) {
                                    updateCart($movie, $format);
                                } else {
                                    addToCart($movie, $format);
                                }

                                header('Location: cart.php');
                            } else {
                                // Si le format n'est pas correct
                                echo $errors['format'];
                            }
                        }
                    ?>

                    <form method="post" class="mt-5">
                        <div class="mb-4">
                            <select class="form-control" name="format">
                                <option value="1080p">1080p</option>
                                <option value="VOD">VOD</option>
                                <option value="4K">4K</option>
                            </select>
                        </div>

                        <button class="btn btn-danger" name="cart">Ajouter au panier</button>
                    </form>
                </div>

                <div class="card-footer text-muted">
                    <?php
                        // Représente la note du film
                        // On va récupèrer la note moyenne du film dans la BDD
                        // grâce aux commentaires
                        $query = $db->prepare(
                            'SELECT AVG(note) FROM `comment` WHERE movie_id = :id'
                        );
                        $query->execute([':id' => $id]);
                        // On prend la seule valeur du fetch et on arrondit
                        $averageMovie = round($query->fetchColumn(), 2);

                        // Boucle pour afficher les étoiles
                        for ($i = 1; $i <= 5; $i++) {
                            // Tant que $i dans la boucle est inférieur à
                            // la moyenne, on affiche une étoile pleine
                            echo ($i <= $averageMovie) ? '★' : '☆';
                        }
                    ?>
                </div>
            </div>

            <!-- Bloc commentaires -->
            <div class="card shadow mt-5">
                <div class="card-body">
                    <?php
                        // Récupèrer les commentaires
                        $query = $db->prepare('SELECT * FROM comment WHERE movie_id = :id ORDER BY created_at DESC LIMIT 5');
                        $query->execute([':id' => $movie['id']]);
                        $comments = $query->fetchAll();

                        foreach ($comments as $comment) {
                            // var_dump($comment);
                    ?>

                        <div class="mb-3">
                            <p class="mb-0">
                                <strong><?= $comment['pseudo']; ?></strong>
                                <span class="small-text">
                                    le <?= formatDate($comment['created_at'], '%d/%m/%Y à %Hh%M'); ?>
                                </span>
                            </p>
                            <p>
                                <?= $comment['message']; ?>
                                <?= $comment['note']; ?>/5
                            </p>
                        </div>
                        <hr />

                    <?php } // Fin du foreach ?>

                    <?php
                        $pseudo = $_POST['pseudo'] ?? null;
                        $message = $_POST['message'] ?? null;
                        $note = $_POST['note'] ?? null;
                        $errors = [];

                        // Traitement du formulaire commentaire
                        if (!empty($_POST) && isset($_POST['comment'])) {
                            $pseudo = htmlspecialchars($_POST['pseudo']); // Transforme <script> en &gt;script&lt
                            $message = htmlspecialchars($_POST['message']); // Supprime <script> de la chaine

                            // On vérifie la validité des champs...
                            if (empty($pseudo)) {
                                $errors['pseudo'] = 'Le pseudo est vide';
                            }

                            // Le message doit faire 5 caractères minimum
                            if (strlen($message) < 5) {
                                $errors['message'] = 'Le message est trop court';
                            }

                            // La note doit être entre 0 et 5
                            if ($note < 0 || $note > 5) {
                                $errors['note'] = 'La note n\'est pas correcte';
                            }

                            // On fait la requête s'il n'y a pas d'erreurs
                            if (empty($errors)) {

                                // Requête SQL...
                                $query = $db->prepare(
                                    'INSERT INTO `comment` (`pseudo`, `message`, `note`, `created_at`, `movie_id`)
                                     VALUES (:pseudo, :message, :note, NOW(), :movie_id)'
                                );

                                $query->execute([
                                    ':pseudo' => $pseudo,
                                    ':message' => $message,
                                    ':note' => $note,
                                    ':movie_id' => $movie['id']
                                ]); // On exécute la requête

                                // On redirige pour éviter que l'utilisateur ne renvoie le formulaire
                                header('Location: film.php?id='.$movie['id']);

                            } else {

                                // Afficher les erreurs...
                                echo '<div class="container alert alert-danger">';
                                foreach ($errors as $error) {
                                    echo '<p class="text-danger m-0">'.$error.'</p>';
                                }
                                echo '</div>';

                            }
                        } // Fin du traitement
                    ?>

                    <form method="POST">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $pseudo; ?>"> <br />

                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="3"><?= $message; ?></textarea> <br />

                        <label for="note">Note</label>
                        <select name="note" id="note" class="form-control">
                            <?php for ($i = 0; $i <= 5; $i++) { ?>
                                <option
                                    value="<?= $i; ?>"
                                    <?= $note == $i ? 'selected' : ''; ?>
                                >
                                    <?= $i; ?>/5
                                </option>
                            <?php } ?>
                        </select> <br />

                        <button class="btn btn-danger btn-block" name="comment">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>
