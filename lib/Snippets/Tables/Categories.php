<?php


namespace Table;


use Snippets\Site;

class Categories extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "categories");
        $this->site = $site;
    }

    public function add($cat) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (category) VALUES (?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$cat]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getId($cat) {
        try {
            $sql = 'SELECT id FROM '.$this->getTableName().' WHERE category=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$cat]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getCatById($id) {
        try {
            $sql = 'SELECT category FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }
}
