<?php


namespace Table;


use Snippets\Site;

class Doc extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "doc");
        $this->site = $site;
    }

    public function createDoc($topic_id) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (topic_id, title) VALUES (?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$topic_id, "Title"]);
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

    public function getTitleByDocId($id) {
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
