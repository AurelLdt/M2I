<?php

/**
 * On va essayer de représenter un homme et une femme en objet.
 *
 * Un homme et une femme ont les mêmes caractéristiques (On les distinguera par la civilité)
 * Chacun aura un partenaire. Une femme a la caractéristique de pouvoir être enceinte.
 * Ils auront tous les deux un nom, un prénom et une date de naissance.
 *
 * Ils pourront effectuer des actions. Un homme peut faire la cuisine.
 * Une femme peut réparer la voiture. Les deux peuvent manger, respirer ou peuvent se mettre en couple.
 * 
 * Il faudra pouvoir lier des hommes ou des femmes comme étant des enfants d'hommes ou de femmes.
 */

require 'Man.php';
require 'Woman.php';

$jean = new Man('Jean', 'Doe', '1985-11-05');
$sylvie = new Woman('Sylvie', 'Dum', '1990-12-01');
$edouard = new Man('Edouard', 'Gugu', '1970-01-02');
$jeanne = new Woman('Jeanne', 'Darc', '1987-11-01');

$edouard->relationShip($jeanne);
$jeanne->pregnant()->giveBirth('Georges', 'Laura');
$jeanne->pregnant()->giveBirth('Georges', 'Laura');

// Un homme peut faire la cuisine
echo $edouard->cook().'<br />';
echo $sylvie->repair().'<br />';
echo $jean->breathe().'<br />';
echo $jean->eat().'<br />';

// Un homme peut se mettre en couple
$jean->relationShip($sylvie);

echo $sylvie->repair().'<br />';

// S'il est déjà en couple, on renvoie une erreur
$jean->relationShip($edouard);

// Une femme peut tomber enceinte
$sylvie->pregnant();

// Une femme peut donner naissance à un homme ou une femme
// On définit un prénom garçon et un prénom fille
$child = $sylvie->giveBirth('Matthieu', 'Fiorella');

// Sylvie a un 2ème enfant
$sylvie->pregnant();
$sylvie->giveBirth('Léo', 'Léa');

var_dump($jean);
var_dump($sylvie);
var_dump($edouard);

// On peut avoir la liste des enfants de Sylvie
echo $sylvie->getChilds(); // Fiorella, Léo, 
