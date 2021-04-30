<?php

class Man {
    public $civility;
    public $name;
    public $firstname;
    public $birthday;
    public $partner;
    public $childs = [];

    public function __construct($firstname, $name, $birthday) {
        $this->firstname = $firstname;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->civility = 'Mr';
    }

    /**
     * Fait à manger.
     */
    public function cook() {
        // On doit calculer à combien de personnes on fait à manger
        $number = 1;

        if ($this->partner) {
            $number++;
        }

        // On compte le nombre d'enfants de l'objet
        $number += count($this->childs);

        return $this->firstname.' fait à manger pour '.$number;
    }

    /**
     * Peut respirer.
     */
    public function breathe() {
        return $this->firstname.' respire';
    }

    /**
     * Peut manger.
     */
    public function eat() {
        // On peut appeller une méthode dans une méthode
        return $this->breathe().' et mange';
    }

    /**
     * Peut être en relation.
     */
    public function relationShip($people) {
        // Si la personne (jean) est déjà en couple,
        // on renvoie une erreur
        if ($this->partner !== null) {
            echo $this->firstname.' est déjà en couple <br />';
            return; // On arrête le code
        }

        // $people représente une personne
        // $this représente la personne qui entre en relation
        $this->partner = $people; // Jean a pour partenaire Sylvie
        $people->partner = $this; // Sylvie a aussi pour partenaire Jean
    }
}
