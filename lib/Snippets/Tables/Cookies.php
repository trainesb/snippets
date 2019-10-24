<?php


namespace Table;

use Snippets\Site;

class Cookies extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "cookie");
        $this->site = $site;
    }

    public function create($user) {
        try {
            $sql = 'INSERT INTO '.$this->tableName.' (user, salt, hash, date) VALUES (?, ?, ?, ?)';
            $pdo = $this->pdo();

            $salt = $this->random_salt();
            $token = $this->random_salt(32);
            $hash = hash("sha256", $token . $salt);

            $statement = $pdo->prepare($sql);
            $statement->execute([$user->getId(), $salt, $hash, date("h:i:sa")]);
            return $token;
        } catch(\PDOException $e) {
            return NULL;
        }
    }

    public function validate($user, $token) {
        try {
            $sql = 'SELECT * FROM '.$this->tableName.' WHERE user = ? AND token = ?';
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);
            $statement->execute([$user, $token, ]);
            $qry = $statement->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($qry as $record) {
                if($record['salt'] + $token === $record['hash']) {
                    return $record['hash'];
                }
            }
        } catch (\PDOException $e) {
            return NULL;
        }
    }

    public function delete($hash) {
        try {
            $sql = 'DELETE FROM '.$this->tableName.' WHERE hash = ?';
            $pdo = $this->pdo();

            $statement = $pdo->prepare($sql);
            $statement->execute([$hash, ]);
            if($statement->rowCount() === 0) {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
        return true;
    }

    public static function random_salt($len = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }
}
