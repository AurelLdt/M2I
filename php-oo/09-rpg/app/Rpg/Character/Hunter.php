<?php

namespace Rpg\Character;

class Hunter extends Character {
    /**
     * Attaque à distance.
     */
    public function rangedAttack($character) {
        // S'il est déjà mort, on ne fais rien
        if ($character->isDead()) {
            echo 'Vous avez déjà tué le personnage... <br />';
            return $this;
        }

        $character->health -= $this->strength * 3;

        // On s'assure que le personnage a 0 minimum de santé
        if ($character->isDead()) {
            $this->gainExp(); // On augmente l'xp de l'attaquant
        }

        return $this;
    }
}
