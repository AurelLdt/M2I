<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <?php
            // On définit les variables au début pour pouvoir les utiliser dans le formulaire
            $number1 = $_GET['number1'] ?? '';
            $number2 = $_GET['number2'] ?? '';
            $operator = $_GET['operator'] ?? '';
        ?>

        <form method="get" action="">
            <label for="number1">Nombre 1</label>
            <input type="text" name="number1" id="number1" class="form-control" value="<?= $number1; ?>">
            <label for="number2">Nombre 2</label>
            <input type="text" name="number2" id="number2" class="form-control" value="<?= $number2; ?>">
            <label for="operator">Opérateur</label>
            <select class="form-select" name="operator" id="operator">
                <option value="+">Addition (+)</option>
                <option value="-">Soustraction (-)</option>
                <option value="/">Division (/)</option>
                <option value="*">Multiplication (x)</option>
            </select>

            <button class="btn btn-primary">Calculer</button>
        </form>

        <?php
            if (!empty($_GET)) { // On vérifie que le formulaire est soumis
                // Ici, on va vérifier que $number1 et $number2 sont bien des nombres
                if (is_numeric($number1) && is_numeric($number2)) {
                    // Ici, on fait le calcul
                    if ($operator === '+') {
                        $result = $number1 + $number2;
                    } else if ($operator === '-') {
                        $result = $number1 - $number2;
                    } else if ($operator === '/' && $number2 != 0) { // $number2 est une chaine ('0' ou '2')
                        $result = $number1 / $number2;
                    } else if ($operator === '*') {
                        $result = $number1 * $number2;
                    } else {
                        echo 'Attention on ne peut pas diviser par 0. ';
                        $result = '??';
                    }

                    echo "Le résultat de $number1 $operator $number2 = $result";
                } else {
                    echo "Veuillez vérifier vos nombres";
                }
            }
        ?>
    </div>

</body>
</html>
