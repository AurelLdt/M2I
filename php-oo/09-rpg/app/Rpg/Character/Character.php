<?php

namespace Rpg\Character;

class Character {
    public $name;
    public $health = 100;
    public $strength = 10;
    public $mana = 10;
    public $inventory = [];
    public $level = 1;
    public $experience = 0;
    // public $killed = false;

    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Vérifie si un personnage est mort.
     */
    protected function isDead() {
        if ($this->health < 0) {
            $this->health = 0;
        }

        return $this->health === 0;
    }

    protected function gainExp() {
        $this->experience++;

        if ($this->experience % 3 === 0) {
            $this->level++;
        }
    }

    /**
     * Attaque un autre personnage.
     */
    public function attack($character) {
        // S'il est déjà mort, on ne fais rien
        if ($character->isDead()) {
            echo 'Vous avez déjà tué le personnage... <br />';
            return $this;
        }

        $character->health -= $this->strength * 2;

        // On s'assure que le personnage a 0 minimum de santé
        if ($character->isDead()) {
            $this->gainExp(); // On augmente l'xp de l'attaquant
        }

        return $this;
    }

    /**
     * Ramasse un objet.
     */
    public function pick($item) {
        if ($item->owned) {
            echo 'Objet déjà ramassé. <br />';
            return;
        }

        $this->items[] = $item;
        $item->owned = true;

        return $this;
    }
}
