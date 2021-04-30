<?php

// En PHP, on va être amené à faire des erreurs.
// En tant que dév', il faut être capable de "debuger" les erreurs.

echo $a; // Affiche une NOTICE, mais le script ne s'arrête pas

echo 1 / 0; // Affiche un WARNING, division par zéro

echo 3;
echo 4; // Affiche une ERROR Parse error...
echo 6;

// Parfois on va avoir un "unexpected end of file"
$b = 10;

if ($b < 15) {
    echo $b;
}

// Pour s'aider à debug, on a des fonctions utiles
$boolean = false;
// Le var_dump affiche le détails de ce que contient une variable
var_dump($boolean);

// Le die permet d'arrêter le code pour nous aider à debuger
// die('JE SUIS ICI');

echo 'Salut';
