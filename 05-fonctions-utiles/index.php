<?php

// Quelques fonctions utiles

// Parfois, on a besoin de savoir si une variable est définie
echo 'La variable $firstname n\'est pas définie <br />';
var_dump(isset($firstname)); // Renvoie false
$firstname = 'Toto';
echo 'La variable $firstname est pas définie <br />';
var_dump(isset($firstname)); // Renvoie true

// On peut vérifier si le contenu d'une variable est
// - Une chaine vide
// - Un tableau vide
// - 0
$firstname = '';
if (empty($firstname)) {
    echo 'La variable $firstname est vide <br />';
}

// On peut vérifier qu'un index existe dans un tableau
$fruits = ['Banane', 'Fraise', 'Tomate'];
echo 'Est-ce que l\'index 0 est vide ? Non il contient Banane <br />';
var_dump(empty($fruits[0])); // Renvoie false
echo 'Est-ce que l\'index 2 est vide ? Oui il n\'est pas présent <br />';
var_dump(empty($fruits[2])); // Renvoie true
if (!empty($fruits[2])) { // Est-ce que l'index n'est PAS vide ?
    echo '$fruits[2] est présent dans le tableau et contient '.$fruits[2].'<br />';
}

// Compter le nombre de caractères d'une chaine en PHP
echo 'Hello world ! contient 13 caractères <br />';
echo strlen('Hello world !'); // Affiche 13
echo '<br />';

echo 'ééééé fait '.strlen('ééééé').' caractères (OCTETS) <br />'; // Affiche 10
echo 'En réalité, ééééé fait '.iconv_strlen('ééééé').' caractères <br />'; // Affiche 5
echo '<br />';

// Pour récupèrer le timestamp actuel
$now = time();

echo $now.'<br />';

// Formater la date à partir d'un timestamp
// Pour retrouver tous les formats https://www.php.net/manual/fr/datetime.format.php
// Ce code nous donne la date qu'il était il y a 2 jours
echo date('d/m/Y', $now - 86400 * 2).'<br />';
echo 'On est le '.date('d/m/Y  H\hi\ms\s O I').'<br />'; // 16/02/2021 10h16m36s +0100 0

// Je voudrais la date du 18/11/1991
// l est un L minuscule
echo date('l d/m/Y', strtotime('18 november 1991')).'<br />';

// Quel jour sera-t-il dans 1 mois exactement ?
echo date('l d/m/Y', strtotime('+ 1 month')).'<br />';
