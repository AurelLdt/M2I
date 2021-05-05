<?php

require 'config.php';

if (!isLogged()) {
    header('Location: login.php');
}

$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$birthday = $_POST['birthday'] ?? null;
$selectedSkills = $_POST['skills'] ?? [];
$errors = [];

$skills = $db->query('select * from competence')->fetchAll();

if (!empty($_POST)) {
    if (empty($name)) {
        $errors['name'] = 'Erreur sur le nom.';
    }

    if (!is_numeric($phone) || strlen($phone) !== 10) {
        $errors['phone'] = 'Erreur sur le téléphone.';
    }

    $timestamp = strtotime($birthday);

    // checkdate(date('n', $timestamp), date('j', $timestamp), date('Y', $timestamp))
    if (!$timestamp) {
        $errors['birthday'] = 'Erreur sur la date.';
    }

    $goodSkills = [];
    foreach ($skills as $skill) {
        $goodSkills[] = $skill->id;
    }

    foreach ($selectedSkills as $selectedSkill) {
        if (!in_array($selectedSkill, $goodSkills)) {
            $errors['skills'] = 'Erreur sur les compétences.';
        }
    }

    if (empty($errors)) {
        $query = $db->prepare(
            'insert into stagiaire (name, phone, birthday, created_at)
            values (:name, :phone, :birthday, :created_at)'
        );
        $query->execute([
            'name' => $name,
            'phone' => $phone,
            'birthday' => $birthday,
            'created_at' => date('Y-m-d'),
        ]);

        $stagiaireId = $db->lastInsertId();

        foreach ($selectedSkills as $selectedSkill) {
            $query = $db->prepare(
                'insert into stagiaire_a_competence (stagiaire_id, competence_id)
                values (:stagiaire_id, :competence_id)'
            );
            $query->execute([
                'stagiaire_id' => $stagiaireId,
                'competence_id' => $selectedSkill,
            ]);
        }

        echo 'Le stagiaire a été ajouté.';
    } else {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
    }
}

$stagiaires = $db->query('select * from stagiaire')->fetchAll();
$count = $db->query('select count(id) from stagiaire')->fetchColumn(); ?>

<h1><?= $count; ?> stagiaires</h1>

<?php
/**
 * Si on veut faire une SEULE requête SQL pour le $skillsCount, on peut faire :
 * SELECT *, COUNT(competence_id) FROM stagiaire
 * LEFT JOIN stagiaire_a_competence ON stagiaire.id = stagiaire_a_competence.stagiaire_id
 * GROUP BY stagiaire.id -- Dédoublonne les résultats par rapport à stagiaire.id --
 */
?>
<ul>
<?php foreach ($stagiaires as $stagiaire) {
    $skillsCount = $db->query('select count(stagiaire_id) from stagiaire_a_competence where stagiaire_id = '.$stagiaire->id)->fetchColumn();
?>
    <li><?= $stagiaire->name; ?> (<?= $skillsCount; ?> compétences)</li>
<?php } ?>
</ul>

<h2>Qui maitrise le HTML et le CSS ?</h2>

<?php
    $masterFront = $db->query(
        'SELECT *, stagiaire.name as stagiaire_name, COUNT(competence_id) as count FROM stagiaire
         INNER JOIN stagiaire_a_competence ON stagiaire.id = stagiaire_a_competence.stagiaire_id
         INNER JOIN competence ON competence.id = stagiaire_a_competence.competence_id
         WHERE competence.name = "html" OR competence.name = "css"
         GROUP BY stagiaire.id'
    )->fetchAll();

    foreach ($masterFront as $front) {
        if ($front->count >= 2) {
            echo $front->stagiaire_name.' <br />';
        }
    }
?>

<h2>Qui maitrise le PHP ou le SQL ?</h2>

<?php
    $masterBack = $db->query(
        'SELECT *, stagiaire.name as stagiaire_name FROM stagiaire
         INNER JOIN stagiaire_a_competence ON stagiaire.id = stagiaire_a_competence.stagiaire_id
         INNER JOIN competence ON competence.id = stagiaire_a_competence.competence_id
         WHERE competence.name = "php" OR competence.name = "sql"
         GROUP BY stagiaire.id'
    )->fetchAll();

    foreach ($masterBack as $back) {
        echo $back->stagiaire_name.' <br />';
    }
?>

<h1>Ajouter un stagiaire</h1>
<form method="post">
    <div>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?= $name; ?>">
    </div>

    <div>
        <label for="phone">Téléphone</label>
        <input type="text" name="phone" id="phone" value="<?= $phone; ?>">
    </div>

    <div>
        <label for="birthday">Date de naissance</label>
        <input type="date" name="birthday" id="birthday" value="<?= $birthday; ?>">
    </div>

    <div>
        <label>Compétences</label>
        <?php foreach ($skills as $skill) { ?>
            <input
                type="checkbox"
                name="skills[]"
                value="<?= $skill->id; ?>"
                id="skill-<?= $skill->id; ?>"
                <?= (in_array($skill->id, $selectedSkills)) ? 'checked' : ''; ?>
            >
            <label for="skill-<?= $skill->id; ?>"><?= $skill->name; ?></label>
        <?php } ?>
    </div>

    <button>Ajouter</button>
</form>
