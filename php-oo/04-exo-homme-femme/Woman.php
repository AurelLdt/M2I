<?php

class Woman {
    public $civility;
    public $name;
    public $firstname;
    public $birthday;
    public $partner;
    public $childs = [];
    public $pregnant = false;

    public function __construct($firstname, $name, $birthday) {
        $this->firstname = $firstname;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->civility = 'Mme';
    }

    /**
     * Répare quelque chose.
     */
    public function repair() {
        // Si la personne a un partenaire, elle répare la voiture du partenaire
        // Si elle n'en a pas, c'est sa propre voiture
        $sentence = 'sa voiture';

        if ($this->partner) {
            $sentence = 'la voiture de '.$this->partner->firstname;
        }

        return $this->firstname.' répare '.$sentence;
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

    /**
     * Deviens enceinte.
     */
    public function pregnant() {
        $this->pregnant = true;

        return $this;
    }

    /**
     * Donne naissance à un nouvel homme / femme.
     */
    public function giveBirth($boyName, $girlName) {
        // On arrête tout de suite le code si la femme n'est pas enceinte
        if (!$this->pregnant) {
            echo $this->firstname.' n\'est pas enceinte';
            return;
        }

        // Si elle l'est...
        if (rand(0, 1)) { // 0 c'est false, 1 c'est true
            $child = new Man($boyName, $this->name, date('Y-m-d'));
        } else {
            $child = new Woman($girlName, $this->name, date('Y-m-d'));
        }

        // On ajoute $child à la propriété tableau $childs
        $this->childs[] = $child;
        // On ajoute l'enfant aux enfants du partenaire également
        if ($this->partner) {
            $this->partner->childs[] = $child;
        }
        $this->pregnant = false;

        return $child;
    }

    /**
     * Affiche les enfants de la personne
     */
    public function getChilds()
    {
        $childrens = '';

        foreach ($this->childs as $child) {
            // On concaténe dans la chaine
            $childrens .= $child->firstname.', ';
        }

        return $childrens;
    }
}
