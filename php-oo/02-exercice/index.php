<?php

/**
 * On va créer une classe Car dans un fichier à part.
 * Une voiture possède 4 roues, une couleur, une marque et un modèle.
 * Une voiture peut être construite avec tous ses attributs.
 * Une voiture peut rouler et klaxonner.
 * Faire un getter et un setter pour la couleur (uniquement la couleur en private).
 * On instanciera au moins 2 voitures.
 *
 * BONUS: Une voiture a une jauge d'essence (50 pour 50L).
 * On réduit la jauge de 2L à chaque fois qu'on appelle la méthode rouler.
 */

require 'Car.php';

$car = new Car('Renault', 'Mégane', 'Bleu');
$car2 = new Car('Alfa Roméo', '147', 'Gris');

echo 'Niveau essence de '.$car->brand.': '.$car->fuel.'L <br />';

echo $car->drive().'<br />';
echo $car2->klaxon().'<br />';

echo $car2->drive().' et elle est '.$car2->getColor().'<br />';
echo $car->klaxon().'<br />';

echo $car->drive().'<br />';
echo $car->drive().'<br />';

while ($car->fuel > 0) {
    echo $car->drive().'<br />';
}

echo 'Niveau essence de '.$car->brand.': '.$car->fuel.'L <br />';

// On peut repeindre la voiture
$car2->setColor('Rouge');

// La nouvelle couleur
echo 'On a repeint la '.$car2->brand.' en '.$car2->getColor().'<br />';

// Faire le plein
$car->fillUp();

// Faire un accident
$car->crash();

var_dump($car);
var_dump($car2);
