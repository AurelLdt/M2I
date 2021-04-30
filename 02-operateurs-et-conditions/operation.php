<?php

// Créer un fichier operation.php
// Stocker 15 dans une variable.
// Stocker 5 dans une autre variable.
// Stocker 8 dans une autre variable.
// Afficher ceci dans la page (en dynamique) :
// ​15 + 5 + 8 = 28
// 15 x (5 - 8) = -45
// (8 - 5) / 15 = 0.2

// Si une des opérations a un résultat inférieur à 20, afficher "Une des opérations renvoie moins de 20" en bas de la page

$number1 = 15;
$number2 = 5;
$number3 = 8;

$result1 = $number1 + $number2 + $number3;
$result2 = $number1 * ($number2 - $number3);
$result3 = ($number3 - $number2) / $number1;

echo $number1.' + '.$number2.' + '.$number3.' = '.$result1.' <br />';
echo "$number1 x ($number2 - $number3) = $result2 <br />";
echo "($number3 - $number2) / $number1 = $result3 <br />";

if ($result1 < 20 || $result2 < 20 || $result3 < 20) {
    echo 'Une des opérations renvoie moins de 20';
}
