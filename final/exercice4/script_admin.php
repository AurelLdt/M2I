<?php

require 'config.php';

$query = $db->prepare('insert into admin (email, password) values (:email, :password)');
$query->execute([
    'email' => 'matthieumota@gmail.com',
    'password' => password_hash('password', PASSWORD_DEFAULT),
]);
