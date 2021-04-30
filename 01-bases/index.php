<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        // L'instruction echo permet d'afficher du texte
        echo 'Salut PHP';

        echo '<br /> Je fais du PHP <br />';

        // Si on a des quotes dans une chaine, on doit les échapper
        echo 'L\'HTML dans le PHP <br />';

        // On peut déclarer des variables
        $age = 29;

        // Je vais afficher le contenu de ma variable
        echo 'J\'ai '.$age.' ans';

        // En PHP, il existe l'interpolation de variables
        // Quand on utilise les doubles quotes, on n'a pas besoin de concaténer
        echo "J'ai $age ans";
    ?>

</body>
</html>
