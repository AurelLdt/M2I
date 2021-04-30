<?php

namespace Rpg\Character;

class Warrior extends Character {
    public function __construct($name) {
        parent::__construct($name);
        $this->strength *= 2;
    }
}
