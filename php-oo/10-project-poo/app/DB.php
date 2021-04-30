<?php

namespace App;

class DB {
    /**
     * Permet de lancer une requête SQL
     * et retourne les résultats.
     */
    public static function query($sql, $bindings = []) {
        $query = self::postQuery($sql, $bindings);

        return $query->fetchAll();
    }

    /**
     * Permet de lancer une requête SQL
     * qui ne retourne pas de résultat (INSERT, UPDATE, DELETE)
     */
    public static function postQuery($sql, $bindings = []) {
        $db = new \PDO('mysql:host=localhost;dbname=project-poo;charset=UTF8', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        ]);

        $query = $db->prepare($sql);
        $query->execute($bindings);

        // On retourne la requête pour l'utiliser dans la méthode query()
        return $query;
    }
}
