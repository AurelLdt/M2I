<?php

echo '<h2>Nous cherchons à afficher la date du jour au format "Tuesday 16 february 2021, il est 10h51 et 12 secondes".</h2>';

echo date('l d F Y').', il est '.date('H\hi').' et '.date('s').' secondes <br />';
// date('l d F Y, \i\l \e\s\t')

echo '<h2>Nous voulons récupérer le jour qu\'il sera dans 10 jours exactement.</h2>';

echo 'Dans 10 jours, on sera '.date('l d', strtotime('+ 10 days')).'<br />';

echo '<h2>Combien de jours reste-t-il avant Noël ?</h2>';

// On récupère le timestamp de maintenant et de Noël 2021
$now = time(); // ou strtotime('now'); // 1613471667
$christmas = strtotime('25 december 2021'); // 1640386800

// Calcul des jours restants
$days = $christmas - $now; // 26915019
// Une journée fait (60 * 60 * 24) = 86400 secondes
$days = $days / (60 * 60 * 24);
echo 'Il reste '.round($days, 2).' jours avant Noël <br />';

// Solution 2 plus simple
$days = date('z', $christmas) - date('z'); // 358 - 46
// var_dump(date('z', $christmas));
echo 'Il reste '.$days.' jours avant Noël <br />';
