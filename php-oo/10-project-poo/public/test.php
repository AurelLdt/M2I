<?php

// On peut inclure toutes les bibliothèques de Composer
require __DIR__.'/../vendor/autoload.php';

// On va tester le VarDumper de Symfony
class Test {
    public $name;
}

$objet = new Test();
$objet->name = 'Hello';

$test = [
    'Une chaine',
    12,
    ['a' => 'b'],
    $objet
];

dump($test, $objet, 12);
