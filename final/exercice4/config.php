<?php

session_start();

$db = new PDO('mysql:host=localhost;dbname=exam_m2i', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);

function isLogged() {
    return $_SESSION['user'] ?? false;
}
