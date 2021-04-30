<?php

// J'inclus la connexion à la base de données
require __DIR__.'/../config/database.php';

// On va vider la table avant de la remplir (et on remet les ids à 0)
// On désactiver temporairement la vérification des clés êtrangères
$db->query('SET FOREIGN_KEY_CHECKS = 0');
$db->query('TRUNCATE movie_has_actor');
$db->query('SET FOREIGN_KEY_CHECKS = 1');

$db->query('INSERT INTO movie_has_actor (movie_id, actor_id) VALUES
(1, 1), (1, 2),
(2, 1),
(3, 3), (3, 5),
(4, 1), (4, 3), (4, 10),
(5, 4),
(6, 6), (6, 7),
(9, 7),
(19, 4),
(20, 9),
(21, 8)');

echo 'INSERT INTO movie_has_actor...';
