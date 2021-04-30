<?php

// Cat est une classe, une structure, un moule
class Cat {
    // Une classe possède des propriétés, attributs ou caractéristiques
    public $name;
    var $type;
    var $fur; // Pelage...

    // Une propriété public est visible partout en dehors de la classe
    // Une privée est visible uniquement dans la classe
    private $size;

    // Le constructeur est appelé au moment de l'instance
    public function __construct($name, $size = null) {
        $this->name = $name;
        $this->size = $size;
    }

    function cry() {
        // $this permet de récupérer l'objet sur lequel on
        // appelle la méthode
        return $this->name.' miaule !';
    }

    // Pour une propriété privée, on doit créer un getter et un setter
    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        // Pour l'exemple, on peut lever une exception pour vérifier
        // que l'utilisation de la classe est correcte.
        if (is_array($size)) {
            throw new \Exception('Size doit être un nombre valide.');
        }

        $this->size = $size;

        return $this; // Retourne l'instance actuelle
    }
}
