<?php


namespace Table;


use Snippets\Site;

class Snippets extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "snippets");
        $this->site = $site;
    }

    public function add($snippet) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (lang_id, title) VALUES (?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$snippet['language'], $snippet['title']]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getTitleBySnippetId($id) {
        try {
            $sql = 'SELECT title FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC)["title"];
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getById($lang_id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE lang_id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$lang_id]);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updateTitleById($title, $id) {
        try {
            $sql = 'UPDATE '.$this->getTableName().' SET title=? WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$title, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteById($id) {
        try {
            $sql = 'DELETE FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
