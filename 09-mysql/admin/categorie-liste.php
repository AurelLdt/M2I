<?php require 'partials/header.php';

global $db;
$categories = $db->query('SELECT * FROM category')->fetchAll();
?>

<?php if (isset($_GET['delete'])) { ?>
    <div class="alert alert-success">
        La catégorie a bien été supprimée.
    </div>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        Votre catégorie a bien été modifiée dans la BDD.
    </div>
<?php } ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) { ?>

            <tr>
                <td><?= $category['id']; ?></td>
                <td><?= $category['name']; ?></td>
                <td>
                    <a href="./categorie-modifier.php?id=<?= $category['id']; ?>"
                       class="btn btn-secondary">
                        Modifier
                    </a>
                    <a href="./categorie-supprimer.php?id=<?= $category['id']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Voulez-vous supprimer cette catégorie ?');">
                        Supprimer
                    </a>
                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<?php require 'partials/footer.php'; ?>
