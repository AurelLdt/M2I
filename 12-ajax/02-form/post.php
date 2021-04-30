<?php

// On ralentit le script volontairement pour
// voir le loader
sleep(1);

$message = $_POST['message'] ?? null;
$errors = [];

if (strlen($message) < 5) {
    $errors['message'] = 'Le message est trop court';
}

if (empty($errors)) {
    // Si tout va bien, on renvoie simplement le message
    echo json_encode(['message' => $message]);
} else {
    // S'il y a des erreurs, on les renvoie pour les récupérer
    // côté JS
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
}
