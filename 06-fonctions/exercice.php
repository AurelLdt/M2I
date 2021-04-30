<?php

// Créer une fonction calculant le carré d'un nombre

function square($number) {
    return $number * $number;
}

echo 'Le carré de 5 est '.square(5).'<br />';

// Créer une fonction calculant l'aire d'un rectangle et une fonction pour celle d'un cercle

function areaRectangle($width, $length) {
    return $width * $length;
}

function areaCircle($radius) {
    // pow($radius, 2)
    return round(square($radius) * pi(), 2);
}

echo 'L\'aire d\'un rectangle de 10 sur 5 est '.areaRectangle(10, 5).'<br />';
echo 'L\'aire d\'un cercle de rayon 3 est '.areaCircle(3).'<br />';

// Créer une fonction calculant le prix TTC d'un prix HT. Nous aurons besoin de 2 paramètres, le prix HT et le taux.

function convert($price, $rate, $withTax = true) {
    if ($withTax) {
        // On veut un prix HT vers TTC
        return round($price * (1 + $rate / 100), 2); // 10 * (1 + 20 / 100);
    } else {
        // On veut un prix TTC vers HT
        return round($price / (1 + $rate / 100), 2); // 12 / (1 + 20 / 100);
    }
}

echo 'Le prix TTC de 10 est ' . convert(10, 20).'<br />';

// Ajouter un 3ème paramètre à cette fonction permettant de l'utiliser dans les 2 sens (HT vers TTC ou TTC vers HT)

echo 'Le prix HT de 12 est ' . convert(12, 20, false).'<br />';

echo 'Le prix d\'un restaurant est 10 HT et '.convert(10, 10).' TTC <br />';
echo 'Le prix d\'un sandwich au magasin est 3 HT et '.convert(3, 5.5).' TTC';
