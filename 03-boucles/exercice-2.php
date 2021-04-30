<?php

/*
Créer une boucle qui affiche 10 étoiles (*)
Imbriquer la boucle dans une autre boucle afin d'afficher 10 lignes de 10 étoiles
Nous obtenons un carré. Trouver un moyen de modifier le code pour obtenir un triangle rectangle.
*/

echo '<h2>Créer une boucle qui affiche 10 étoiles (*)</h2>';

for ($i = 0; $i < 10; $i++) {
    echo '⭐';
}

echo '<h2>Imbriquer la boucle dans une autre boucle afin d\'afficher 10 lignes de 10 étoiles</h2>';

for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        echo '⭐';
    }

    echo '<br />';
}

echo '<h2>Nous obtenons un carré. Trouver un moyen de modifier le code pour obtenir un triangle rectangle.</h2>';

for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j <= $i; $j++) {
        echo '⭐';
    }

    echo '<br />';
}
