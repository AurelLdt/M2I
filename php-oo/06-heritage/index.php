<?php

require 'Animal.php';
require 'Cat.php';
require 'Dog.php';

/**
 * L'héritage en POO
 * 
 * Le principe est d'étendre une classe, c'est à dire reprendre le comportement d'une classe A
 * dans une classe B. On peut donc utiliser la classe B comme-ci c'était une classe A et on peut
 * aussi modifier son comportement.
 */

$bianca = new Cat('Bianca');

echo $bianca->move().'<br />';
echo $bianca->climbsOnRoof().'<br />';
var_dump($bianca);

// Avec l'héritage, on a ce qu'on appelle le polymorphisme
var_dump($bianca instanceof Cat); // $bianca est un Cat (true)
var_dump($bianca instanceof Animal); // $bianca est un Animal (true)
var_dump($bianca instanceof Dog); // $bianca n'est pas un Dog (false)

$pongo = new Dog('Pongo', 'Dalmatien');
echo $pongo->move().'<br />';
echo $pongo->takeAWalk().'<br />';
var_dump($pongo instanceof Animal); // $bianca est un Animal (true)
var_dump($pongo);
