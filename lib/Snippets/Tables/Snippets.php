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
            $sql = 'INSERT INTO '.$this->tableName.' (lang_id, code, title, description) VALUES (?, ?, ?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$snippet['language'], base64_encode($snippet['snippet']), $snippet['title'], $snippet['description']]);
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
}
