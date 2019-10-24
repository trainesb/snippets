<?php


namespace Table;

use Snippets\Site;

class Table {

    protected $site;
    protected $tableName;

    public function __construct(Site $site, $name) {
        $this->site = $site;
        $this->tableName = $site->getTablePrefix() . $name;
    }

    public function getTableName() { return $this->tableName; }

    public function pdo() { return $this->site->pdo(); }

    public function sub_sql($query, $params) {
        $keys = array();
        $values = array();

        foreach ($params as $key => $value) {
            if(is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            if(is_numeric($value)) {
                $values[] = intval($value);
            } else {
                $values[] = '"' . $value . '"';
            }
        }

        $query = preg_replace($keys, $values, $query, 1, $count);
        return $query;
    }

    public function getAll() {
        $sql = <<<SQL
SELECT * FROM $this->tableName
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) {
            return null;
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
