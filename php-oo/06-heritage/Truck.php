<?php

class Truck extends Vehicle {
    protected $maxSpeed = 90;
    protected $capacity;
    protected $items = [];
    protected $trailer = false;

	public function __construct($brand, $price, $capacity, $wheels) {
        parent::__construct($brand, $price);

        $this->capacity = $capacity;
        $this->wheels = $wheels;
    }

	/**
     * Ajoute un élément dans le camion
     */
	public function addItem($item) {
        // Je vérifie la capacité du camion
        // On compare la taille du tableau $items avec $capacity
        if (count($this->items) >= $this->capacity) {
            echo 'Vous avez dépassé la capacité du camion...';
            return $this;
        }

		$this->items[] = $item;

        return $this;
	}

    /**
     * Renvoie la cargaison en array
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Attache la remorque
     */
    public function attachTrailer() {
        // On ajoute la remorque si possible
        if (!$this->trailer) {
            $this->trailer = true;
            $this->capacity *= 2;
        }
    }

    /**
     * Détache la remorque
     */
    public function detachTrailer() {
        // On retire la remorque si possible
        if ($this->trailer) {
            $this->trailer = false;
            $this->capacity /= 2;

            // Si on veut récupérer les X derniers (Hors capacité)
            // ['A', 'B', 'C', 'D', 'E', 'F'] devient ['D', 'E', 'F']
            $lastItems = array_slice($this->items, $this->capacity, $this->capacity);

            // Retirer les items qui sont en trop dans le chargement ($this->items)
            // Le tableau ['A', 'B', 'C', 'D', 'E', 'F'] devient ['A', 'B', 'C']
            $this->items = array_slice($this->items, 0, $this->capacity);
        }
    }
}
