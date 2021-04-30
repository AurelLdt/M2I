/**
 * Représente la connexion avec PDO.
 */
public static $pdo;

/**
 * Retourne la connexion PDO existante
 * ou la créer si elle n'a pas été faite
*/
private static function getPdo() {
    // On s'assure que la connexion à la BDD ne se fait qu'une seule fois
    if (self::$pdo === null) {
        self::$pdo = new PDO('mysql:host=localhost;dbname=webflix;charset=UTF8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    return self::$pdo;
}
