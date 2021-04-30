<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitcoin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

    <div class="container">

        <?php
            // On peut caster (transtyper) une chaine pour la forcer à être un entier
            // (int) 'toto' devient 0
            // (int) '10' devient 10
            $amount = (int) $_POST['amount'] ?? null; // null ou '' fait à peu près la même chose
            $currency = $_POST['currency'] ?? null;
        ?>

        <form method="post" action="">
            <label for="amount">Montant</label>
            <input type="text" name="amount" id="amount" class="form-control">

            <label for="currency">Devise</label>
            <select name="currency" id="currency" class="form-select">
                <option value="eur">Euros vers Bitcoins</option>
                <option value="bit">Bitcoins vers Euros</option>
            </select>

            <button class="btn btn-primary">Convertir</button>
        </form>

        <?php
            if (!empty($_POST)) { // Vérifie que le formulaire est soumis
                $rate = 42106.19;

                if ($currency === 'eur') {
                    $result = number_format($amount / $rate, 6); // 1 euros vaut 0,000024 bitcoins
                    echo "$amount euros valent $result bitcoins.";
                } else if ($currency === 'bit') {
                    $result = $amount * $rate;
                    echo "$amount bitcoins valent $result euros.";
                }
            }
        ?>

    </div>
</body>
</html>
