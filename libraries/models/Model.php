<?php

namespace Models;

require_once('libraries/autoload.php');

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    public function findAll(string $order = ""): array
    {

        $sql = "SELECT * FROM {$this->table}";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        return $item;
    }


    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function slugify($text, string $divider = '-')
    {
        // remplacer les ceux qui n'est pas une lettre ou un chiffre par un séparateur $divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // translitérer
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // supprimer les caractères non voulus
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
