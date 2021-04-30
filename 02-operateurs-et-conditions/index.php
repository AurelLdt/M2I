<?php

// Comme en JS, on peut faire des calculs en PHP
$number1 = 10;

// J'affiche le résultat d'un calcul
echo 'Le résultat de '.$number1.' + 5 est '.($number1 + 5);

echo '<br /> ----------------- <br />';

// Opérateur d'incrémentation
echo $number1 += 3; // $number1 vaut 13 jusque la fin du script (de la page)

echo $number1; // Affiche toujours 13
echo '<br /> ----------------- <br />';
echo $number1 ** 2; // Affiche 13 x 13;
echo $number1.'<br />'; // Affiche ENCORE 13

// On peut écrire des conditions en PHP
$a = 42;
$condition = 0 === false; // On stocke le résultat de la comparaison stricte entre 0 et false

if ($a === 0) {
    echo 'A vaut 0';
} else if ($a > 12 && $a <= 42) {
    echo 'On entre dans le 1er else if';
} else if ($condition) { // $condition doit être true
    echo 'On est dans le dernier else if';
} else {
    echo 'Aucun if n\'est ok';
}

echo '<br /> ----------------- <br />';

if (!$condition) { // On peut aussi écrire $condition === false
    echo 'S\'affiche si la variable $condition est false';
}

echo '<br /> ----------------- <br />';

// Priorité des opérateurs logiques
$a = true;
$b = true;
$c = false;

// On voudrait que si $c est false, tout le if est false

// true || true && false => true || false => true
// (true || true) && false => true && false => false
if ($a || $b && $c) {
    echo 'OK';
}

echo '<br /> ----------------- <br />';

// On a possibilité d'incrémenter ou de décrémenter via un
// raccourci
$a = 0;

// Ce code équivaut à faire $a = $a + 1;
echo ++$a; // $a vaut 1 et on affiche 1 (valeur APRES incrémentation)
echo $a++; // $a vaut 2 et on affiche 1 (valeur AVANT incrémentation)

// Ecrire cela
echo ++$a;

// Evite d'écrire cela
$a++;
echo $a;
