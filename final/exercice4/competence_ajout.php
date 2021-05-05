<?php

require 'config.php';

if (!isLogged()) {
    header('Location: login.php');
}

$name = $_POST['name'] ?? null;
$errors = [];

if (!empty($_POST)) {
    if (empty($name)) {
        $errors['name'] = 'Erreur sur le nom.';
    }

    if (empty($errors)) {
        $query = $db->prepare('insert into competence (name) values (:name)');
        $query->execute([
            'name' => $name,
        ]);

        echo 'La compétence a été ajoutée.';
    } else {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }
}

$skills = $db->query('select * from competence')->fetchAll(); ?>

<ul>
<?php foreach ($skills as $skill) { ?>
    <li><?= $skill->name; ?></li>
<?php } ?>
</ul>

<h1>Ajouter une compétence</h1>
<form method="post">
    <div>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?= $name; ?>">
    </div>

    <button>Ajouter</button>
</form>
