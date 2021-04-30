<?php

class Transaction {
    public $type;
    public $amount;
    public $date;

    public function __construct($type, $amount) {
        $this->type = $type;
        $this->amount = $amount;

        // On prend une date entre le 23/02 et le 23/03
        // rand(time() - 30 * 24 * 60 * 60, time())
        // rand(1 600 000 000 - 2 592 000, 1 600 000 000)

        $this->date = date('Y-m-d h:i:s', rand(time() - 30 * 24 * 60 * 60, time()));
    }
}
