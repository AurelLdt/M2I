<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="">
        <input type="file" name="image">

        <button>Upload</button>
    </form>

    <?php
        // Attention, pour l'upload de fichier, il faut utiliser $_FILES et pas $_POST
        var_dump($_FILES);

        // On va définir un tableau avec les types de fichiers qu'on autorise
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 100 * 1024; // 100ko ? 102 400 octets

        // On vérifie si l'utilisateur est en train d'envoyer un fichier
        if (!empty($_FILES['image'])) {

            // On vérifie qu'il n'y a pas d'erreur avant de faire l'upload
            if ($_FILES['image']['error'] === 0 && $_FILES['image']['size'] < $maxSize && in_array($_FILES['image']['type'], $allowedTypes)) {

                // Récupèrer le fichier temporaire et le déplacer dans un dossier
                $file = $_FILES['image']['tmp_name'];
                var_dump($file);
                // On va créer un dossier en PHP pour stocker les fichiers uploadés
                // __DIR__ renvoie C:\wamp64\www\10-upload
                if (!is_dir(__DIR__.'/images')) { // On vérifie que le dossier n'existe pas
                    mkdir(__DIR__.'/images');
                }

                // On récupère le nom du fichier
                $fileName = $_FILES['image']['name']; // deadpool.jpg
                $fileName = uniqid().'-'.$fileName; // deadpool.jpg -> abc123-deadpool.jpg

                // On doit déplacer le fichier dans le dossier
                move_uploaded_file($file, __DIR__.'/images/'.$fileName);

            } else {
                echo 'Veuillez envoyer un fichier au bon format (jpg, jpeg, png, gif) et à la bonne taille (100 ko)...';
            }

        }
    ?>
</body>
</html>
