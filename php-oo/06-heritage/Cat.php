<?php

class Cat extends Animal {
    public $fur;

    public function climbsOnRoof() {
        return $this->name.' se déplace sur le toit';
    }

    public function move() {
        // parent représente la classe Animal
        // évite de copier coller ou de modifier le code X fois
        return parent::move().' silencieusement';
    }
}
