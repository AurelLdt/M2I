<?php

/**
 * Les méthodes magiques
 * 
 * Il existe des méthodes qui peuvent ajouter de la "magie" sur nos objets.
 */

class User {
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Ce code sera appellé si on echo l'objet
     */
    public function __toString() {
        return $this->name;
    }

    /**
     * Ce code sera appellé si on appelle l'objet comme une fonction
     */
    public function __invoke($word) {
        return $word.' '.$this->name;
    }
}

$user = 1;
$user2 = $user;
$user2++;
var_dump($user);
var_dump($user2);

$user = new User('Fiorella');
// $user2 = $user fait juste un raccourci vers le premier objet
// Avec clone, on crée un 2ème objet
$user2 = clone $user;
$user2->name = 'Matthieu';
var_dump($user);
var_dump($user2);
// Mon objet est une chaine grâce à __toString
echo $user;
// Mon object est une fonction grâce à __invoke
echo $user('Bonjour');
