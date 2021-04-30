<?php

/*
Nous allons créer un ensemble de véhicules.
Un véhicule possède une immatriculation, un prix, une marque et des roues.
On va devoir incrémenter l'immatriculation à chaque création de véhicule.
Tous les attributs sont privés ou protégés (public si on ne veut pas se prendre la tête).
Un véhicule peut démarrer ou accélérer.
La méthode accélérer renvoie la vitesse du véhicule (10 km/h)
Elle incrémente la vitesse de 10 à chaque fois qu'on l'appelle et s'arrête à la vitesse max du véhicule.
La vitesse du véhicule est un attribut idéalement (et aussi la vitesse max)
- Une voiture possède TOUJOURS 4 roues.
Une voiture peut accélérer jusque 130 km/h
- Une moto possède TOUJOURS 2 roues.
Une moto peut faire du 1 roue (Surcharge de accélérer) à partir de 100 km/h jusque 140 km/h
Une moto peut accélérer jusque 250 km/h
- Un Camion possède un chargement (tableau), une capacité de chargement (à définir dans son constructeur)
Par exemple, si le camion a une capacité de 5, il ne peut avoir que 5 éléments dans son tableau chargement
On doit pouvoir faire $camion->addItem('Tomates');
Si je dépasse la capacité, j'ai une erreur
Un camion peut avoir X roues (constructeur)
Un camion peut accélérer jusque 90 km/h
BONUS:
Un camion peut attacher ou détacher une remorque (méthode)
Le fait d'attacher LA remorque permet d'agrandir la capacité du camion (x2)
Attention, si on détache la remarque, on perd le chargement qui est de trop (array_slice)
BONUS:
Un véhicule ne peut accélérer que s'il a déjà démarré.
*/

/*require 'Vehicle.php';
require 'Car.php';
require 'Bike.php';
require 'Truck.php';*/

// Merci pour la méthode de ce matin
spl_autoload_register();

$car1 = new Car('BMW', 10000);
echo $car1->accelerate().'<br />'; // Reste à 0
echo $car1->start().'<br />'; // Démarre la voiture
echo $car1->accelerate().'<br />'; // Accélère 1 fois à 10km/h
echo $car1->accelerate().'<br />'; // Accélère 1 fois à 20km/h

$moto1 = new Bike('Yamaha', 5000);
echo $moto1->start().'<br />';
for ($i = 0; $i < 26; $i++) {
    echo $moto1->accelerate().'<br />';
}

var_dump($car1);
var_dump($moto1);

$camion1 = new Truck('Mercedes', 50000, 3, 12); // Capacité de 3 et 12 roues
$camion1->addItem('PC')->addItem('iPhone')->addItem('TV');

$camion1->addItem('Tomate'); // Camion plein
var_dump($camion1);

$camion1->attachTrailer(); // Double la capacité (6)
$camion1->addItem('Tomate')->addItem('Salade')->addItem('Frites');
var_dump($camion1->getItems()); // Tableau avec 6 éléments

$camion1->detachTrailer();
var_dump($camion1->getItems()); // Tableau avec 3 éléments

var_dump(Vehicle::$registrations);
