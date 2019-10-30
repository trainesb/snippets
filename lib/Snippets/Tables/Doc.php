<?php


namespace Table;


use Snippets\Site;

class Doc extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "doc");
        $this->site = $site;
    }

    public function createDoc($topic_id, $author) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (topic_id, author, title, updated) VALUES (?, ?, ?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$topic_id, $author, "Title", date("Y-m-d H:i:s")]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getLastInsertedId() {
        try {
            $sql = 'SELECT MAX(id) FROM '.$this->tableName;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(\PDO::FETCH_ASSOC)['MAX(id)'];
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getSectionDisplay($doc_id) {
        try {
            $sql = 'SELECT section_view FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$doc_id]);
            return $statement->fetch(\PDO::FETCH_ASSOC)["section_view"];
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updateDocDisplay($doc_id, $section_id) {
        try {
            $sql = 'UPDATE '.$this->getTableName().' SET section_view=? WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$section_id, $doc_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getByTopicId($topic_id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE topic_id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$topic_id]);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getById($id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC);
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
