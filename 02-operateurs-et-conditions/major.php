<?php

// Créer un fichier major.php
// Créer une variable age comprise entre 0 et 20.
// Ecrire une condition qui permet de vérifier si la personne est majeure. Si c'est le cas, on affiche "Vous pouvez entrer" sinon "Interdit"
// Ajouter à la condition:
// - Si la personne a entre 16 ET 18 ans non inclus
// -> "Vous êtes presque majeur"
// - Si la personne a entre 14 ET 16 ans non inclus
// -> "Vous êtes jeune"
// - Si la personne a moins de 14 ans
// -> "Vous êtes trop jeune"

$age = 13;

if ($age >= 18) {
    echo 'Vous pouvez entrer';
} else if ($age >= 16 && $age < 18) {
    echo 'Vous êtes presque majeur';
} else if ($age >= 14 && $age < 16) {
    echo 'Vous êtes jeune';
// } else if ($age < 14) {
//     echo 'Vous êtes trop jeune';
} else {
    echo 'Vous êtes trop jeune <br />';
    echo 'Interdit';
}
