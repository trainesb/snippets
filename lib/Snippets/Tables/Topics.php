<?php


namespace Table;


use Snippets\Site;

class Topics extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "topics");
        $this->site = $site;
    }

    public function getLastInsertedId() {
        try {
            $sql = 'SELECT MAX(id) FROM '.$this->tableName;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function add($topic) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (topic, category_id) VALUES (?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$topic['topic'], $topic['category_id']]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getTopicById($id) {
        try {
            $sql = 'SELECT topic FROM '.$this->getTableName().' WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch(\PDO::FETCH_ASSOC)["topic"];
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getByCategoryId($category_id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE category_id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$category_id]);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updateTopicById($topic, $id) {
        try {
            $sql = 'UPDATE '.$this->getTableName().' SET topic=? WHERE id=?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$topic, $id]);
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
