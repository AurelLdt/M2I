<?php

/**
 * Les interfaces
 * 
 * On peut créer nos propres interfaces pour obliger une ou plusieurs classes à respecter un "contrat".
 * C'est à dire, on définit des méthodes dans l'interface qui devront obligatoirement être implémentée par la classe.
 * 
 * On va utiliser 1 interface native au PHP: JsonSerializable (https://www.php.net/manual/fr/class.jsonserializable.php)
 */

class User implements JsonSerializable {
    public $firstname;
    public $lastname;
    public $securiteSocial;

    public function __construct($firstname, $lastname) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->securiteSocial = uniqid();
    }

    public function jsonSerialize()
    {
        // Ici, on implémente un code pour la méthode jsonSerialize()
        return [
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'fullname' => $this->firstname.' '.$this->lastname,
            'avatar' => 'https://gravatar.com/'.$this->firstname,
        ];
    }
}

$user = new User('Matthieu', 'Mota');
var_dump($user);

echo json_encode($user);
