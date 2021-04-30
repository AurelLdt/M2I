<?php

namespace Rpg\Character;

class Magus extends Character {
    public function __construct($name) {
        parent::__construct($name);
        $this->mana *= 2;
    }

    /**
     * Lance un sort.
     */
    public function castSpell($character) {
        // S'il est déjà mort, on ne fais rien
        if ($character->isDead()) {
            echo 'Vous avez déjà tué le personnage... <br />';
            return $this;
        }

        $character->health -= $this->mana * 3;

        // On s'assure que le personnage a 0 minimum de santé
        if ($character->isDead()) {
            $this->gainExp(); // On augmente l'xp de l'attaquant
        }

        return $this;
    }
}
