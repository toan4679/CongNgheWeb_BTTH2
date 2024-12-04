<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ? AND password = ? AND role = 1";
        return $this->db->query($sql, [$username, $password])->fetch();
    }
    
    public function register($username, $password, $role = 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        return $this->db->query($sql, [$username, $hashedPassword, $role]);
    }
    
    public function checkRole($id) {
        $sql = "SELECT role FROM users WHERE id = ?";
        return $this->db->query($sql, [$id])->fetch()['role'];
    }
}
