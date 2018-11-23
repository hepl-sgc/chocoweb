<?php

class Slide
{
    
    function __construct($id, $locale)
    {
        // 1. Récupérer le slide $id avec sa traduction $locale en base de données
        $result = $this->querySlide($id, $locale);
        // 2. On va convertir la structure de la base de données en attributs
    }

    public function querySlide($id, $locale)
    {
        // CONFIGURER PDO
        $host = '127.0.0.1';
        $db   = 'sgc_chocolat';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
             $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        // TODO : Préparer la requête
        // $query = $pdo->query('');

        // TODO : Retourner le résultat de la requête SQL
        return $query->fetch();
    }
}