<?php

ob_start();

$title = 'Panier';
require __DIR__.'/partials/header.php';

// On vide le panier ?
$clear = isset($_GET['clear']) ? true : false;

if ($clear) {
    unset($_SESSION['cart']);

    header('Location: cart.php');
}

?>

<div class="container">
    <h1>Panier</h1>

    <?php if (empty(cart())) { ?>
        <h2>Votre panier est vide...</h2>
    <?php } ?>

    <?php if (!empty(cart())) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Format</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (cart() as $cart) { ?>
                    <tr>
                        <td>
                            <img class="img-fluid" width="75" src="./uploads/movies/<?= $cart['cover']; ?>" alt="<?= $cart['title']; ?>">
                        </td>
                        <td class="align-middle">
                            <a href="./film.php?id=<?= $cart['id']; ?>">
                                <?= $cart['title']; ?>
                            </a>
                        </td>
                        <td class="align-middle"><?= $cart['format']; ?></td>
                        <td class="align-middle"><?= $cart['quantity']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a class="btn btn-danger" href="cart.php?clear">Vider le panier</a>
    <?php } ?>
</div>

<?php require __DIR__.'/partials/footer.php';
