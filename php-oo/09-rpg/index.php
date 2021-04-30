<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require './app/'.$class.'.php';
});

use Rpg\Character\Hunter;
use Rpg\Character\Magus;
use Rpg\Character\Warrior;
use Rpg\Inventory\Item;

$aragorn = new Warrior('Aragorn');
$legolas = new Hunter('Legolas');
$gandalf = new Magus('Gandalf');

$aragorn->attack($legolas); // Enlève X points de vie en fonction de la force (Force x 2)
$legolas->rangedAttack($gandalf); // Enlève X points de vie si le personnage est chasseur (Force x 3)
$gandalf->castSpell($aragorn); // Enlève X points de vie en fonction du mana (Mana x 3)

$potion = new Item('Potion');
$sword = new Item('Epee');

$aragorn->pick($potion)
        ->pick($sword);

$gandalf->pick($sword);

for ($i = 0; $i < 10; $i++) {
    $aragorn->attack($legolas)
            ->attack($legolas)
            ->attack($legolas);
    // On soigne Legolas pour tester l'expérience
    $legolas->health = 100;
}

var_dump($aragorn);
echo '<br /><br />';
var_dump($legolas);
echo '<br /><br />';
var_dump($gandalf);
echo '<br /><br />';
