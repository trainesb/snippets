<?php


namespace Table;


use Snippets\Site;

class Sections extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "sections");
        $this->site = $site;
    }

    public function add($section) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (doc_id, text, tag) VALUES (?, ?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $tag = $section['tag'];
            $text = $section['text'];
            if($tag === 'pre') {
                $text = base64_encode($text);
            }

            $statement->execute([$section['doc_id'], $text, $tag]);
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

    public function getById($id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE id = ?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updateTextById($text, $id) {
        try {
            $sql = 'UPDATE '.$this->getTableName().' SET text=? WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$text, $id]);
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
