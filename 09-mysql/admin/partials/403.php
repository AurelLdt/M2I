<?php
http_response_code(403);
// Le require_once permet de s'assurer que le header
// n'apparait pas 2 fois
// __DIR__ (Directory) renvoie le dossier dans lequel
// est le script PHP: C:\wamp64\www\php\09-mysql\partials
require_once __DIR__.'/header.php'; ?>

<div class="container">
    <h1>403 interdit</h1>
</div>

<?php
require_once __DIR__.'/footer.php';
exit; // Permet d'être sûr que le code s'arrête
?>
