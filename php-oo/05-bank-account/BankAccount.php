<?php

class BankAccount {
    public $identifier;
    public $owner;
    public $balance = 0;
    public static $increment = 1;
    public $owners = [];
    public $transactions = [];

    public function __construct($identifier, $owner = '', $balance = 0) {
        $this->identifier = $identifier;
        $this->owner = $owner;
        $this->balance = $balance;
        // Identifiant aléatoire
        // $this->identifier = uniqid();
        // Identifiant auto incrémenté
        $this->identifier = self::$increment++;
    }

    /**
     * Renvoie le montant sur le compte.
     */
    public function getBalance() {
        return $this->owner.' a '.$this->balance.' € sur son compte <br />';
    }

    /**
     * Depôt d'argent sur le compte
     */
    public function depositMoney($amount) {
        if ($amount < 0) {
            echo 'Vous ne pouvez pas ajouter de montant négatif <br />';
            return;
        }

        $this->balance += $amount;
        $this->transactions[] = new Transaction('deposit', $amount);
    }

    /**
     * Retrait d'argent sur le compte
     */
    public function withdrawMoney($amount) {
        if ($this->balance < $amount || $amount < 0) {
            echo 'Vous ne pouvez pas retirer <br />';
            return;
        }

        $this->balance -= $amount;
        $this->transactions[] = new Transaction('withdraw', $amount);
    }

    /**
     * Ajouter un propriétaire au compte
     */
    public function addOwner($owner) {
        $this->owners[] = $owner;

        return $this;
    }

    /**
     * Afficher la liste des propriétaires du compte
     */
    public function getOwners() {
        $display = '';

        foreach ($this->owners as $owner) {
            $display .= $owner->name.', ';
        }

        return $display;
    }

    /**
     * Fais un virement sur un autre compte
     */
    public function wireTo($bankAccount, $amount) {
        if ($this->balance < $amount || $amount < 0) {
            echo 'Vous ne pouvez pas faire de virement <br />';
            return;
        }

        // On retire sur le premier compte
        $this->withdrawMoney($amount);
        // On dépose sur le second compte
        $bankAccount->depositMoney($amount);
    }

    /**
     * Afficher l'historique des transactions
     */
    public function getHistory() {
        $history = '<ul>';

        foreach ($this->transactions as $transaction) {
            $history .= "<li>
                $transaction->type de $transaction->amount euros le $transaction->date
            </li>";
        }

        $history .= '</ul>';

        return $history;
    }

    /**
     * Permet de virer la paye de chaque propriétaire sur le compte
     */
    public function payDay() {
        foreach ($this->owners as $owner) {
            $this->depositMoney($owner->salary);
        }
    }
}
