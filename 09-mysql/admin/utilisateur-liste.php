<?php require 'partials/header.php';

global $db;
$users = $db->query('SELECT * FROM user')->fetchAll();
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['email']; ?></td>
                <td>
                    <a href="utilisateur-promotion.php?id=<?= $user['id']; ?>"
                       class="btn btn-<?= $user['role'] === 'user' ? 'success' : 'danger' ?>">
                        Promouvoir en <?= $user['role'] === 'user' ? 'administrateur' : 'utilisateur' ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require 'partials/footer.php'; ?>
