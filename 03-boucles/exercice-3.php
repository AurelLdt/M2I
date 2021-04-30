<?php

/*
1. Afficher la table de multiplication du chiffre 5
5 x 1 = 5
5 x 2 = 10
2. Afficher l'ensemble des tables de multiplications de 1 à 10.
*/

echo '<h2>1. Afficher la table de multiplication du chiffre 5</h2>';

for ($i = 1; $i <= 10; $i++) {
    echo '5 x '.$i.' = '.(5 * $i).' <br />';
}

echo '<h2>2. Afficher l\'ensemble des tables de multiplications de 1 à 10.</h2>';

for ($table = 1; $table <= 10; $table++) {
    //echo '<h2>Table de '.$table.'</h2>';

    for ($multiple = 1; $multiple <= 10; $multiple++) {
        //echo $table.' x '.$multiple.' = '.($table * $multiple).' <br />';
    }
}

echo '<h2>Reproduire une table de multiplication en HTML</h2>';

echo '<table cellspacing="0"><tbody>';
// Ici, on affiche la première ligne (la légende)
    echo '<tr>';
        echo '<td class="gris-clair border-bottom border-right"><strong>x</strong></td>';
        for ($i = 0; $i <= 10; $i++) {
            // On vérifie si on doit mettre le gris clair sur la case (Nombre impair)
            if ($i % 2 !== 0) {
                echo '<td class="gris-clair border-bottom"><strong>'.$i.'</strong></td>';
            } else {
                echo '<td class="border-bottom"><strong>'.$i.'</strong></td>';
            }
        }
    echo '</tr>';

// Ici, on va afficher les résultats des tables de multiplication
for ($table = 0; $table <= 10; $table++) {
    echo '<tr>';

        // Ici, c'est la première colonne de chaque ligne qui représente la table
        // On vérifie si on doit mettre le gris clair sur la case
        if ($table % 2 !== 0) {
            echo '<td class="gris-clair border-right"><strong>'.$table.'</strong></td>';
        } else {
            echo '<td class="border-right"><strong>'.$table.'</strong></td>';
        }

        for ($multiple = 0; $multiple <= 10; $multiple++) {
            // Conditions pour gérer le fond de couleur des cases
            if ($table === $multiple) {
                echo '<td class="gris-fonce">'.($table * $multiple).'</td>';
            } else if ($table % 2 === 0 && $multiple % 2 === 0) { // Si le multiple est pair et la table est paire
                echo '<td class="gris-clair">'.($table * $multiple).'</td>';
            } else if ($table % 2 !== 0 && $multiple % 2 !== 0) { // Si le multiple est impair et la table est impaire
                echo '<td class="gris-clair">'.($table * $multiple).'</td>';
            } else {
                echo '<td>'.($table * $multiple).'</td>';
            }
        }

    echo '</tr>';
}
echo '</tbody></table>'; ?>

<style>
    table {
        border: 1px solid #000;
    }

    .gris-fonce {
        background-color: #6d6d6d;
    }

    .gris-clair {
        background-color: #cecece;
    }

    .border-bottom {
        border-bottom: 1px solid #000;
    }

    .border-right {
        border-right: 1px solid #000;
    }

    td {
        text-align: center;
        width: 40px;
    }
</style>

<!-- <table>
    <tbody>
        <tr>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
        </tr>
    </tbody>
</table> -->
