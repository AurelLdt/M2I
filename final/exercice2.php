<?php

$db = new PDO('mysql:host=localhost;dbname=exam_m2i', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);

$stagiaires = $db->query('select * from stagiaire')->fetchAll();

if (empty($stagiaires)) {
    foreach (['Fiorella', 'Marina', 'Matthieu'] as $stagiaire) {
        $query = $db->prepare(
            'insert into stagiaire (created_at, name, phone, birthday)
             values (NOW(), :name, :phone, :birthday)'
        );
        $query->execute([
            'name' => $stagiaire,
            'phone' => '06'.rand(10000000, 99999999),
            'birthday' => rand(1990, 2019).'-'.str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT).'-'.str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT),
        ]);
    }

    $stagiaires = $db->query('select * from stagiaire')->fetchAll();
}

foreach ($stagiaires as $stagiaire) {
    echo '<p>';
    echo $stagiaire->created_at.' - ';
    echo $stagiaire->name.' - ';
    echo $stagiaire->phone.' - ';
    echo $stagiaire->birthday;
    echo '</p>';
}
