<?php


namespace Table;


use Snippets\Site;

class Languages extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "languages");
        $this->site = $site;
    }

    public function add($lang) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (lang) VALUES (?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$lang]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getId($lang) {
        try {
            $sql = 'SELECT id FROM '.$this->getTableName().' WHERE lang=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$lang]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getNameById($id) {
        try {
            $sql = 'SELECT lang FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }
}
