<?php

class Car {
    public $brand;
    public $model;
    private $color;
    public $wheel; // On peut faire private $wheel = 4;
    public $fuel = 50;

    public function __construct($brand, $model, $color, $wheel = 4) {
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->wheel = $wheel;
    }

    /**
     * Permet de récupérer la couleur
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Permet de définir la couleur.
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * Fait rouler la voiture.
     */
    public function drive() {
        $this->fuel -= 2;

        // On va vérifier que le réservoir ne tombe pas dans le négatif
        if ($this->fuel <= 0) {
            $this->fuel = 0;

            return $this->brand.' est en panne';
        }

        return 'La voiture '.$this->brand.' roule';
    }

    /**
     * Fait klaxonner la voiture.
     */
    public function klaxon() {
        return 'La voiture '.$this->brand.' qui est '.$this->color.' klaxonne';
    }

    /**
     * Faire le plein.
     */
    public function fillUp() {
        $this->fuel = 50;

        return $this;
    }

    /**
     * Simuler un accident
     */
    public function crash() {
        $this->wheel = rand(0, 3);

        return $this->brand.' a fait un accident';
    }
}
