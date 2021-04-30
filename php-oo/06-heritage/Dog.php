<?php

class Dog extends Animal {
    public function __construct($name, $type) {
        parent::__construct($name); // On appelle le constructeur de Animal
        $this->type = $type;
    }

    public function move() {
        return parent::move().' bruyamment';
    }

    public function takeAWalk() {
        return $this->name.' sort avec son maître';
    }
}
