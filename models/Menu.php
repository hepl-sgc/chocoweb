<?php

class Menu
{
    public $id;
    public $src;
    public $alt;
    public $price;
    public $name;
    public $ingredients;

    function __construct($id = null, $locale = null)
    {
        $result = $this->queryMenu($id, $locale);

        $this->id = $result['id'];
        $this->src = $result['img_src'];
        $this->alt = $result['img_alt'];
        $this->price = $result['price'];
        $this->name = $result['name'];
        $this->ingredients = $this->queryIngredients($locale);
    }

    public function queryMenu($id, $locale)
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

        $query = $pdo->prepare('SELECT m.id, mt.name, m.price, m.img_src, mt.img_alt FROM menus m JOIN menu_translations mt ON mt.menu_id = m.id AND mt.locale = ? WHERE m.id = ?;');
        $query->execute([$locale, $id]);
        return $query->fetch();
    }

    public function queryIngredients($locale)
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
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
             $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $query = $pdo->prepare('SELECT i.id, it.name FROM ingredients i JOIN ingredient_translations it ON it.ingredient_id = i.id AND it.locale = :locale JOIN ingredient_menu im ON im.ingredient_id = i.id WHERE im.menu_id = :id;');
        $query->execute([
            ':id' => $this->id,
            ':locale' => $locale
        ]);
        return $query->fetchAll();
    }

    public function getIngredients()
    {
        // retourner la version "string" du tableau $this->ingredients
        // dans lequel on n'a gardé que $ingredient->name
        // "coller" chaque élément du tableau avec " / "

        return implode(' / ', array_map(function($ingredient) {
            return $ingredient->name;
        }, $this->ingredients));
    }

    public function getPrice()
    {
        // transformer le prix en cents en euros
        // formater ce montant pour l'affichage (en utilisant 2 chiffres après la virgule, le symbole "," pour séparer les décimales et un espace " " pour séparer les milliers)
        // concaténer la string "&nbsp;€" au chiffre obtenu
        return number_format($this->price / 100, 2, ',', '&nbsp;') . '&nbsp;€';
    }
}