<?php

spl_autoload_register();
require __DIR__.'/vendor/autoload.php';

$stagiaire = new Stagiaire('Fiorella');
$stagiaire
    ->setPhone('0600000102')
    ->setBirthday('2019-12-31');

echo $stagiaire->getData();
dump($stagiaire);

$stagiaire = new Stagiaire('Toto');
$stagiaire->setPhone('06000');
echo $stagiaire->getData();
