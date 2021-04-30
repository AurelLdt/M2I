<?php

$sentences = [
    'Hello world!',
    'Great server',
    'Amazing ajax request',
    'A random sentence',
    'Sentence generator'
];

// On peut renvoyer du texte
// array_rand renvoie un index aléatoire
// du tableau
echo $sentences[array_rand($sentences)];

// On peut aussi renvoyer du json
/*echo json_encode([
    'message' => 'Salut AJAX'
]);*/
