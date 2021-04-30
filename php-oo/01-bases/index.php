<?php

// Les classes doivent être chacune dans leur fichier
require 'Cat.php';

// $bianca est une instance de la classe Cat
$bianca = new Cat('Bianca');

// On peut affecter une valeur aux propriétés de l'instance
$bianca->name = 'Bianca';
$bianca->type = 'Chat de gouttière';

echo 'Mon chat se nomme '.$bianca->name.' et il fait '.$bianca->cry().' <br />';

// $mina est une autre instance
$mina = new Cat('Mina');
$mina->name = 'Mina'; // ['nimportequoi', 12, 14];

echo $mina->cry().'<br />';

// Manipuler une propriété privée
// $mina->size = 50; // Fatal error
// echo $mina->size; // Fatal error
$mina->setSize(50);
echo 'Mina mesure '.$mina->setSize(75)->getSize().'<br />';

// Utilisation avec un constructeur
$leon = new Cat('Léon', 34);
var_dump($leon);

var_dump($bianca);
var_dump($mina);
