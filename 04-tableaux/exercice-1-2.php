<?php

/*
A partir du tableau, afficher le résultat suivant:
La capitale de France est Paris.
La capitale de Espagne est Madrid.
La capitale de Italie est Rome.
*/

$capitales = [
    'France' => 'Paris',
    'Espagne' => 'Madrid',
    'Italie' => 'Rome',
];

// var_dump($capitales);
echo '<h2>Les capitales</h2>';

foreach ($capitales as $pays => $capitale) {
    echo 'La capitale de '.$pays.' est '.$capitale.'<br />';
}

echo '<h2>Population</h2>';

$populations = [
    'France' => 67595000,
    'Suede' => 9998000,
    'Suisse' => 8417000,
    'Kosovo' => 1820631,
    'Malte' => 434403,
    'Mexique' => 122273500,
    'Allemagne' => 82800000,
];

foreach ($populations as $pays => $population) {
    if ($population >= 20000000) {
        echo $pays.'<br />';
    }
}

echo '<h2>Population Europe (Union Européenne)</h2>';

$total = 0;
foreach ($populations as $pays => $population) {
    if ($pays !== 'Mexique' && $pays !== 'Kosovo') {
        $total += $population;
    }
}

echo 'La population d\'Europe est '.$total;
