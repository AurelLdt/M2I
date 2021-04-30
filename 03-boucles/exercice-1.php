<?php

/*
1. Ecrire une boucle qui affiche les nombres de 10 à 1
2. Ecrire une boucle qui affiche uniquement les nombres pairs entre 1 et 100
3. Ecrire le code permettant de trouver le PGCD de 2 nombres
4. Coder le jeu du FizzBuzz
Parcourir les nombres de 0 à 100
Quand le nombre est un multiple de 3, afficher Fizz.
Quand le nombre est un multiple de 5, afficher Buzz.
Quand le nombre est un multiple de 15, afficher FizzBuzz.
Sinon, afficher le nombre
*/

echo '<h2>1. Ecrire une boucle qui affiche les nombres de 10 à 1</h2>';

for ($i = 10; $i >= 1; $i--) {
    echo $i.' - ';
}

echo '<h2>2. Ecrire une boucle qui affiche uniquement les nombres pairs entre 1 et 100</h2>';

for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 === 0) {
        echo $i.' - ';
    }
}

echo '<h2>3. Ecrire le code permettant de trouver le PGCD de 2 nombres</h2>';

$number1 = 96;
$number2 = 36;

echo "Le PGCD de $number1 et $number2";

while ($number1 !== $number2) {
    if ($number1 > $number2) {
        $number1 -= $number2;
    } else {
        $number2 -= $number1;
    }
}

echo " est $number1";

echo '<h2>4. Coder le jeu du FizzBuzz</h2>';

for ($i = 1; $i <= 100; $i++) {
    if ($i % 15 === 0) {
        echo 'FizzBuzz - ';
    } else if ($i % 5 === 0) {
        echo 'Buzz - ';
    } else if ($i % 3 === 0) { // Quand $i est divisible par 3
        echo 'Fizz - ';
    } else {
        echo $i. ' - ';
    }
}
