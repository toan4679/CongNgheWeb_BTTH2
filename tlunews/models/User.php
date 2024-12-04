<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/config/Database.php';

class User {
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct($id, $username, $password, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public static function getByUsername($username) {
        $db = Database::getInstance();  
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        $userData = $stmt->fetch();
        if ($userData) {
            return new self($userData['id'], $userData['username'], $userData['password'], $userData['role']);
        }

        return null;  
    }

    public function checkPassword($password) {
        return $this->password === $password;  
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }

    
}

