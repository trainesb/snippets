<?php


namespace Table;


use Snippets\Site;

class Tag extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "tag");
        $this->site = $site;
    }

    public function add($tag) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (doc_id, tag) VALUES (?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$tag['doc_id'], $tag['tag']]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getByDocId($id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE doc_id = ?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updateTagById($tag, $id) {
        try {
            $sql = 'UPDATE '.$this->getTableName().' SET tag=? WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$tag, $id]);
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

    public function deleteByDocId($doc_id) {
        try {
            $sql = 'DELETE FROM '.$this->getTableName().' WHERE doc_id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$doc_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
