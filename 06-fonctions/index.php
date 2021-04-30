<?php

// On peut créer des fonctions en PHP

// On veut réutiliser facilement le code suivant
echo 'Bonjour Fiorella <br />';
echo 'Hello Fiorella <br />';

// Déclarer une fonction
// Une fonction peut contenir un ou plusieurs arguments
// On peut rendre un argument optionnel en lui donnant une valeur par défaut
function hello($name, $lang = 'fr') {
    // On écrit le global si la variable est définie en dehors de la fonction
    // global $translations;

    // Par défaut, une fonction retourne toujours quelque chose (même si c'est RIEN => void)
    // return;

    // Pour gérer les langues, on pourrait utiliser un tableau avec comme index la langue et comme valeur le mot
    $translations = [
        'fr' => 'Bonjour',
        'en' => 'Hello',
        'es' => 'Hola',
    ];

    // La fonction retourne une chaine mais ne l'affiche pas
    return $translations[$lang].' '.$name.'<br />';
}

// Ne fonctionne pas
// echo $translations['fr'];

// On peut utiliser une fonction
echo hello('Fiorella'); // Je fais un echo pour affiche le retour de la fonction
// L'avantage de return est que l'on peut modifier le retour de la fonction strtoupper(hello('Fiorella'));
echo hello('Fiorella', 'en');
echo hello('Fiorella', 'es');
