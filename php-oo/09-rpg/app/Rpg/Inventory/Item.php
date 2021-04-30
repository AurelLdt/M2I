<?php

namespace Rpg\Inventory;

class Item {
    public $name;
    public $owned = false;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
