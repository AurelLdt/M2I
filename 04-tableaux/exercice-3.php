<?php

/*
1/ Afficher la liste de tous les éléves avec leurs notes.
Exemple :
Matthieu a eu 10, 8, 16, 20, 17, 16, 15 et 2
Thomas a eu 4, 18, 12, 15, 13 et 7
Jean a eu 17, 14, 6, 2, 16, 18 et 9
2/ Calculer la moyenne de Jean. On part de $eleves[2]['notes']
La fonction count permet de compter les éléments d'un tableau
3/ Combien d'élèves ont la moyenne ?
Exemple :
Matthieu a la moyenne
Jean n'a pas la moyenne
Thomas a la moyenne
Nombre d'éléves avec la moyenne : 2
4/ Quel(s) éléve(s) a(ont) la meilleure note ?
Exemple: Thomas a la meilleure note : 19
5/ Qui a eu au moins un 20 ?
Exemple: Personne n'a eu 20
         Quelqu'un a eu 20
*/

$eleves = [
    0 => [
        'nom' => 'Matthieu',
        'notes' => [10, 8, 16, 20, 17, 16, 15, 2]
    ],
    1 => [
        'nom' => 'Thomas',
        'notes' => [4, 18, 12, 15, 13, 7]
    ],
    2 => [
        'nom' => 'Jean',
        'notes' => [17, 14, 6, 2, 16, 18, 9]
    ],
    3 => [
        'nom' => 'Enzo',
        'notes' => [1, 14, 6, 2, 1, 8, 9]
    ]
];

echo '<h2>1/ Afficher la liste de tous les éléves avec leurs notes.</h2>';

foreach ($eleves as $eleve) {
    echo $eleve['nom'].' a eu ';

    // On fait une boucle pour afficher chacune des notes
    foreach ($eleve['notes'] as $index => $note) {
        echo $note;

        // Si l'index de la note est égal au nombre de notes - 1
        // C'est qu'on est sur la dernière note
        if ($index === count($eleve['notes']) - 1) {
            echo '.';
        } else if ($index === count($eleve['notes']) - 2) { // Si on est sur l'avant dernière note
            echo ' et ';
        } else {
            echo ', ';
        }
    }

    echo '<br />';
}

echo '<h2>2/ Calculer la moyenne de Jean. On part de $eleves[2]["notes"]</h2>';

// Parcourir les notes et faire la somme
$somme = 0;
// Je récupère les notes de Jean
// [17, 14, 6, 2, 16, 18, 9]
$notes = $eleves[2]['notes'];

foreach ($notes as $note) {
    $somme += $note;
}

echo 'La moyenne de Jean est '.round($somme / count($notes), 2);

echo '<h2>3/ Combien d\'élèves ont la moyenne ?</h2>';

$ontLaMoyenne = 0; // Stocke le nombre d'élèves qui ont la moyenne
foreach ($eleves as $eleve) {
    // Calculer la moyenne
    $somme = 0;
    $notes = $eleve['notes'];
    foreach ($notes as $note) {
        $somme += $note;
    }
    $moyenne = round($somme / count($notes), 2);
    echo 'La moyenne de '.$eleve['nom'].' est '.$moyenne.'<br />';

    // On vérifie si l'élève qu'on parcours actuellement a la moyenne ou non
    if ($moyenne >= 10) {
        echo $eleve['nom'].' a la moyenne <br />';
        $ontLaMoyenne++; // On incrémente le compteur de personnes ayant la moyenne
    } else {
        echo $eleve['nom'].' n\'a pas la moyenne <br />';
    }
}

echo 'Nombre d\'éléves avec la moyenne : '.$ontLaMoyenne;

echo '<h2>4/ Quel(s) éléve(s) a(ont) la meilleure note ?</h2>';

// On doit d'abord parcourir chaque note pour découvrir la meilleure
$bestNote = 0;
foreach ($eleves as $eleve) {
    foreach ($eleve['notes'] as $note) {
        if ($note > $bestNote) { // On cherche la meilleure note en parcourant chaque notes
            $bestNote = $note;
        }
    }
}

// On parcours chaque élève pour savoir qui a eu cette note
foreach ($eleves as $eleve) {
    foreach ($eleve['notes'] as $note) {
        if ($note === $bestNote) {
            echo $eleve['nom'].' a la meilleure note: '.$bestNote.' <br />';
            break; // Evite le soucis d'un élève qui a plusieurs fois la meilleure note, on arrête le foreach dès qu'un élève a
            // au moins une fois la meilleure note
        }
    }
}

echo '<h2>5/ Qui a eu au moins un 20 ?</h2>';

$aEu20 = false;
foreach ($eleves as $eleve) {
    foreach ($eleve['notes'] as $note) {
        if ($note === 20) {
            $aEu20 = true;
            break; // On peut faire un break dès qu'on tombe sur un 20
        }
    }
}

if ($aEu20) {
    echo 'Quelqu\'un a eu 20';
} else {
    echo 'Personne n\'a eu 20';
}
