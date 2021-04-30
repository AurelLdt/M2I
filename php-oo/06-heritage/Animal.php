<?php

class Animal {
    // Si $name est private, il n'est accessible que dans Animal
    // Si $name est protected, il est accessible dans Animal et ses classes filles
    // Si $name est public, il est accessible partout
    protected $name;
    protected $type;

    public function __construct($name) {
        $this->name = $name;
    }

    public function move() {
        return $this->name.' se déplace';
    }
}
