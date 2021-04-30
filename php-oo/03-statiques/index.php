<?php

class Cat {
    public $count = 0;
    public static $count2 = 0; // La valeur est statique donc elle est partagée entre les instances

    public function __construct() {
        $this->count++;

        // self représente la classe elle-même (Cat) et non l'instance ($cat)
        // :: est l'opérateur de résolution de portée -> Paamayim Nekudotayim
        self::$count2++;
    }

    public static function howMany() {
        return self::$count2;
    }
}

echo Cat::$count2;

$cat = new Cat();
$cat2 = new Cat();

var_dump($cat);
var_dump($cat2);

// On accéde à une propriété statique de la classe
echo Cat::$count2;

// On accéde à une méthode statique
echo Cat::howMany();
