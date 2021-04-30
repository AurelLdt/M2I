<?php
$title = 'Nous contacter';
require __DIR__.'/partials/header.php'; ?>
<?php // require_once 'partials/header.php'; // Pour être sûr qu'il ne soit présent qu'une seule fois ?>
<?php // include 'partials/header.php';

// Récupèration des valeurs du formulaire
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// On vérifie les erreurs
$errors = [];

// On s'assure que ce code est exécuté seulement pour le formulaire de contact
if (!empty($_POST) && isset($_POST['contact'])) {
    if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }

    // Vérification du sujet
    if ($subject === '') {
        $errors['subject'] = 'Le sujet n\'est pas valide';
    }

    // Vérif du message
    if (iconv_strlen($message) < 15) {
        $errors['message'] = 'Le message est trop court';
    }
}

?>

<div class="container">
    <h1>Nous contacter</h1>

    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>"
                            value="<?= $email; ?>"
                    >

                    <?php if (isset($errors['email'])) {
                        echo '<span class="text-danger">'.$errors['email'].'</span>';
                    } ?>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <select id="subject" name="subject" class="form-select <?= isset($errors['subject']) ? 'is-invalid' : ''; ?>">
                        <option value="">Choisir le sujet</option>
                        <option value="stage" <?= $subject === 'stage' ? 'selected' : ''; ?>>Proposition de stage</option>
                        <option value="emploi" <?= $subject === 'emploi' ? 'selected' : ''; ?>>Proposition d'emploi</option>
                        <option value="projet" <?= $subject === 'projet' ? 'selected' : ''; ?>>Demande de projet</option>
                    </select>

                    <?php if (isset($errors['subject'])) {
                        echo '<span class="text-danger">'.$errors['subject'].'</span>';
                    } ?>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : ''; ?>" rows="5"><?php
                        echo $message;
                    ?></textarea>

                    <?php if (isset($errors['message'])) {
                        echo '<span class="text-danger">'.$errors['message'].'</span>';
                    } ?>
                </div>

                <div class="d-grid"> <!-- Permet d'étaler le bouton sur toute la div -->
                    <button class="btn btn-dark" name="contact">Envoyer</button>
                </div>
            </div>
        </div>
    </form>

    <?php
        if (!empty($_POST) && empty($errors) && isset($_POST['contact'])) {
            echo "<div class=\"alert alert-success\">Merci $email pour votre $subject et votre message : $message</div>";
            // @todo Envoyer un mail ou ajouter ça à la base de données...
        }
    ?>
</div>

<?php require 'partials/footer.php'; ?>
