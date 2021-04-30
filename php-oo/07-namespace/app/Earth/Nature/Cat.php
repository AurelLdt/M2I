<?php

namespace Earth\Nature;

class Cat extends Animal {
    public $birthday;

    public function __construct() {
        // Sur les classes PHP natives,
        // on ajoute un anti slash si
        // la classe actuelle est
        // dans un namespace
        $this->birthday = new \DateTime();
    }
}
