<?php


namespace Table;


use Snippets\Site;

class Snip extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "snip");
        $this->site = $site;
    }

    public function add($snip) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (snippets_id, text, tag) VALUES (?, ?, ?)';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $tag = $snip['tag'];
            $text = $snip['text'];
            if($tag === 'pre') {
                $text = base64_encode($text);
            }

            $statement->execute([$snip['snippets_id'], $text, $tag]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getBySnippetId($id) {
        try {
            $sql = 'SELECT * FROM '.$this->getTableName().' WHERE snippets_id = ?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
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

    public function deleteSnipById($id) {
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
