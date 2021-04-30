<?php

/**
 * Les Namespaces
 * 
 * Quand on crée des classes, on peut les ranger dans des namespaces. On considére
 * un espace de nom comme un dossier. L'espace de nom doit être tout en haut du fichier.
 */

// require 'app/Earth/Nature/Animal.php';

/**
 * Autoload de classes
 * 
 * Dès que je fais new Toto(); PHP va faire
 * require './Toto.php';
 * 
 * Si je fais new Earth\Nature\Animal(); PHP va faire
 * require './Earth/Nature/Animal.php';
 */
spl_autoload_register(function ($class) {
    // $class vaut Earth/Nature/Animal
    var_dump('./app/'.$class.'.php');
    // Ce code permet de corriger le soucis sur Mac ou Linux
    $class = str_replace('\\', '/', $class);

    require './app/'.$class.'.php';
});

// Le use permet d'écrire new Animal()
// au lieu de new Earth\Nature\Animal()
// !!!!! Le use ne fait pas le require

use Earth\Nature\Alien;
use Earth\Nature\Animal;
use Earth\Nature\Cat;
use Mars\Animal as MarsAnimal;

$animal = new Animal();
var_dump($animal);

$animalMars = new MarsAnimal();
var_dump($animalMars);

$cat = new Cat();
var_dump($cat);

$alien = new Alien();
var_dump($alien instanceof MarsAnimal);
