<?php

class Owner {
    public $name;
    public $salary = 1150;

    public function __construct($name, $salary = 1150)
    {
        $this->name = $name;
        $this->salary = $salary;
    }
}
