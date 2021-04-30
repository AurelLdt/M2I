<?php

namespace App;

class Contact {
    public $id;
    public $fields = [];
    /**
     * ['civility' => 'Mr', 'email' => 'm@m.fr']
     */
    /*public $civility;
    public $email;
    public $phone;
    public $message;*/

    /**
     * La méthode magique __set() permet de dire :
     * Quand j'écris $contact->email = 'toto@gmail.com'
     * email est $property et toto@gmail.com est $value
     */
    public function __set($property, $value) {
        // dump($property, $value);
        // $this->fields['civility'] = 'Mr';
        $this->fields[$property] = $value;
    }

    /**
     * Renvoie la liste des colonnes de la table.
     */
    public function columns() {
        // ['civility' => 'Mr', 'email' => 'm@m.fr'] devient ['civility', 'email']
        $columns = array_keys($this->fields);

        // ['civility', 'email'] devient civility, email
        return implode(', ', $columns);
    }

    /**
     * Renvoie les paramètres de la requête.
     */
    public function parameters() {
        // Méthode 1 : Simple et explicite
        $parameters = [];

        // ['civility', 'email'] devient [':civility', ':email']
        foreach (array_keys($this->fields) as $column) {
            $parameters[] = ':'.$column;
        }

        // Méthode 2 avec le passage par référence (&column)
        // Le &column correspond EXACTEMENT à la valeur du tableau donc si
        // on modifie la référence (en mémoire RAM), on modifie le tableau
        $parameters = array_keys($this->fields);
        foreach ($parameters as &$column) {
            $column = ':'.$column;
        }

        // [':civility', ':email'] devient :civility, :email
        return implode(', ', $parameters);
    }

    /**
     * Enregistre un contact dans la BDD.
     */
    public function save() {
        // App\Contact -> App/Contact
        $table = str_replace('\\', '/', get_class($this));
        // App/Contact -> Contact -> contact
        $table = strtolower(basename($table)); // /home/matthieu/Fiorella -> fiorella
        // Ici on doit faire un INSERT...
        $sql = "INSERT INTO $table ({$this->columns()})
                VALUES ({$this->parameters()})";
        // dd est un dump et un die
        // dd($sql);

        DB::postQuery($sql, $this->fields);
    }
}
