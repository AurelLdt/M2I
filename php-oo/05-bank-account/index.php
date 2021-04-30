<?php

require 'BankAccount.php';
require 'Owner.php';
require 'Transaction.php';

$bankAccount01 = new BankAccount(123456, 'Matthieu'); // Matthieu a 0 sur son compte
echo $bankAccount01->getBalance(); // Renvoie 0
$bankAccount01->depositMoney(1000); // Matthieu a 1000 sur son compte
echo $bankAccount01->getBalance(); // Renvoie 1000
$bankAccount01->withdrawMoney(1000); // Matthieu a 0 sur son compte

// On renvoie une erreur si le montant du compte tombe en dessous de 0
$bankAccount01->withdrawMoney(1000);
$bankAccount01->depositMoney(-2000);

var_dump(BankAccount::$increment); // Renvoie 2

$bankAccount02 = new BankAccount(123457, 'Matthieu');
$bankAccount03 = new BankAccount(123458, 'Matthieu');
$bankAccount04 = new BankAccount(123459, 'Matthieu');

var_dump($bankAccount01);
var_dump($bankAccount02);
var_dump($bankAccount03);
var_dump($bankAccount04);
var_dump(BankAccount::$increment); // Renvoie 5

$matthieu = new Owner('Matthieu');
$marina = new Owner('Marina');
var_dump($matthieu);

$bankAccount05 = new BankAccount(123456);
$bankAccount05->addOwner($matthieu)
    ->addOwner($marina) // Même chose que ->addOwner(new Owner('Marina'))
    ->addOwner(new Owner('Fiorella', 2000));
var_dump($bankAccount05);

// Retourne la liste des propriétaires du compte
echo strtoupper($bankAccount05->getOwners());

// Partie virement
$bankAccount01->depositMoney(10000);
$bankAccount01->wireTo($bankAccount02, 2000); // On vire 2000 du compte 1 au compte 2

echo $bankAccount01->getBalance(); // Renvoie 8000
echo $bankAccount02->getBalance(); // Renvoie 2000

$bankAccount02->wireTo($bankAccount01, 1999); // Renvoie une erreur

echo $bankAccount01->getBalance(); // Renvoie 9999
echo $bankAccount02->getBalance(); // Renvoie 1

var_dump($bankAccount01);

// Pour tester les salaires
$bankAccount05->payDay();
var_dump($bankAccount05->getBalance());

// Afficher la liste des transactions
echo $bankAccount01->getHistory();

// Créer des transactions
$t1 = new Transaction('test', 10);
$t2 = new Transaction('test2', 100);

var_dump($t1);
var_dump($t2);
