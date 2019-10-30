<?php


namespace Table;

use Snippets\Site;
use Snippets\User;

class Users extends Table {

    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }

    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);
    }

    public function get($id) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));

    }

    public function getIdByName($name) {
        $sql = 'SELECT id FROM '.$this->tableName.' WHERE name=?';

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($name));
        if($statement->rowCount() === 0) {
            return null;
        }

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function update(User $user) {
        $sql = 'UPDATE $this->tablename SET email=?, name=?, phone=?, address=?, notes=?, role=? WHERE id=?';
        $pdo = $this->pdo();
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute(array($user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(), $user->getNotes(), $user->getRole(), $user->getId(),));
            if ($statement->rowCount() === 0) {
                return false;
            }
        } catch(\PDOException $e) {
            return false;
        }

        return true;
    }

    public function exists($email) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE email = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;
    }

    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(),
            $user->getNotes(), date("Y-m-d H:i:s"), $user->getRole()
        ]);
        $id = $this->pdo()->lastInsertId();

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);

        // Send email with the validator in it
        $link = $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }

    public function setPassword($userid, $password) {
        $sql =<<<SQL
INSERT INTO $this->tableName (password)
VALUES (?) WHERE id=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($password, $userid));
    }

    public function getAll() {
        $sql =<<<SQL
SELECT name, email, role FROM $this->tableName;
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) {
            return null;
        }

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function getIdByEmail($email) {
        $sql = <<<SQL
SELECT id FROM $this->tableName
WHERE email=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
