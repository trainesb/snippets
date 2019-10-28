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
    private $notes;		// Notes for this user
    private $joined;	// When user was added
    private $role;		// User role

    public function __construct($row) {
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
        $this->phone = $row['phone'];
        $this->notes = $row['notes'];
        $this->joined = strtotime($row['joined']);
        $this->role = $row['role'];
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

    public function setNotes($notes) { $this->notes = $notes; }

    public function setRole($role) { $this->role = $role; }

    public function getId() { return $this->id; }

    public function getEmail() { return $this->email; }

    public function getName() { return $this->name; }

    public function getPhone() { return $this->phone; }

    public function getNotes() { return $this->notes; }

    public function getRole() { return $this->role; }
}
