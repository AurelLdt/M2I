<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

        // On a possibilité d'écrire des boucles en PHP
        echo '<h2>La boucle for</h2>';
        echo '<ul>';
        for ($i = 0; $i <= 10; $i++) {
            echo "<li>$i</li>";
        }
        echo '</ul>';

        echo '<h2>La boucle foreach</h2>';
        // On peut parcourir facilement un tableau
        $students = ['Anakin', 'Obi-wan', 'Yoda'];

        // Avant le as, c'est le tableau
        // Après le as, c'est la valeur actuelle qu'on parcours dans le tableau
        foreach ($students as $student) {
            echo $student.'<br />';
        }

        echo '<h2>La boucle foreach avec les index</h2>';

        // Optionnellement, je peux récupèrer les index de chaque élément du tableau
        foreach ($students as $index => $student) {
            echo $index.' : '.$student.'<br />';
        }

        // Si on a besoin de compter le nombre de valeurs d'un tableau
        echo 'Le nombre d\'élèves est '.count($students).' <br />'; ?>

        <h2>Les tableaux associatifs</h2>
        <?php
        // En PHP, on peut modifier l'index dans les tableaux, on appelle cela un
        // tableau associatif. Par défaut, un tableau est numérique.
        // L'index d'Abricot est 10 (PAS 0).
        // L'index de Banane n'est PAS 1 mais B.
        // L'index de Cerise est 11
        $fruits = [10 => 'Abricot', 'B' => 'Banane', 'Cerise'];
        // On ne peut pas afficher directement un tableau, on peut
        // utiliser un var_dump
        var_dump($fruits);

        echo '<h2>La boucle while</h2>';

        $i = 0;
        while ($i <= 10) {
            echo $i++.' - ';
        }

        echo '<h2>La boucle do...while</h2>';

        // Le do...while est un while qui s'exécute au moins une fois
        $i = 0;
        do {
            echo $i++;
        } while ($i < 0);

    ?>

</body>
</html>
