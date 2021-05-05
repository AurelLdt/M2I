<?php

class Stagiaire {
    public $id;
    public $created_at;
    public $name;
    public $phone;
    public $birthday;

    public function __construct($name) {
        $this->name = $name;
        $this->created_at = date('Y-m-d');
    }

    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    public function getData()
    {
        $html = '<ul>';
        $html .= '<li>Nom: '.$this->name.'</li>';
        $html .= '<li>Téléphone: '.$this->phone.'</li>';
        $html .= '</ul>';

        return $html;
    }
}
