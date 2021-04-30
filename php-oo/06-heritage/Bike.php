<?php

class Bike extends Vehicle {
	public function __construct($brand, $price) {
        parent::__construct($brand, $price);

        $this->wheels = 2;
        $this->maxSpeed = 250;
    }

    /**
     * Augmente la vitesse actuelle de 10 km/h
     */
    public function accelerate() {
        $accelerate = parent::accelerate();

        if ($this->currentSpeed >= 100 && $this->currentSpeed <= 140) {
            $accelerate .= ' et fais du 1 roue';
        }

        return $accelerate;
    }
}
