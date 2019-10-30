<?php


namespace Snippets;


class User {

    const ADMIN = "A";
    const STAFF = "S";
    const CLIENT = "C";
    const SESSION_NAME = 'user';

    private $id;		// The internal ID for the user
    private $email;		// Email address
    private $name; 		// Name as last, first
    private $phone; 	// Phone number
    private $joined;	// When user was added
    private $role;		// User role
    private $img;

    public function __construct($row) {
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
        $this->phone = $row['phone'];
        $this->joined = strtotime($row['joined']);
        $this->role = $row['role'];
        $this->img = $row['img'];
    }

    public function isStaff() {
        return $this->role === self::ADMIN ||
            $this->role === self::STAFF;
    }

    public function isAdmin() {
        return $this->role === self::ADMIN;
    }

    public function setEmail($email) { $this->email = $email; }

    public function setName($name) { $this->name = $name; }

    public function setPhone($phone) { $this->phone = $phone; }

    public function setRole($role) { $this->role = $role; }

    public function setImg($img) { $this->img = $img; }

    public function getId() { return $this->id; }

    public function getEmail() { return $this->email; }

    public function getName() { return $this->name; }

    public function getPhone() { return $this->phone; }

    public function getRole() { return $this->role; }

    public function getJoined() { return $this->joined; }

    public function getImg() { return $this->img; }
}
