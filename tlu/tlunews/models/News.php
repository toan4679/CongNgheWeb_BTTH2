<?php
class News {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAllNews() {
        $sql = "SELECT n.*, c.name as category_name 
                FROM news n 
                JOIN categories c ON n.category_id = c.id 
                ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }
    
    public function getNewsById($id) {
        $sql = "SELECT n.*, c.name as category_name 
                FROM news n 
                JOIN categories c ON n.category_id = c.id 
                WHERE n.id = ?";
        return $this->db->query($sql, [$id])->fetch();
    }
    
    public function getNewsByCategory($category_id) {
        $sql = "SELECT n.*, c.name as category_name 
                FROM news n 
                JOIN categories c ON n.category_id = c.id 
                WHERE category_id = ? 
                ORDER BY created_at DESC";
        return $this->db->query($sql, [$category_id])->fetchAll();
    }
    
    public function searchNews($keyword) {
        $sql = "SELECT n.*, c.name as category_name 
                FROM news n 
                JOIN categories c ON n.category_id = c.id 
                WHERE title LIKE ? OR content LIKE ? 
                ORDER BY created_at DESC";
        $searchTerm = "%$keyword%";
        return $this->db->query($sql, [$searchTerm, $searchTerm])->fetchAll();
    }
    
    public function addNews($title, $content, $image, $category_id) {
        $sql = "INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, [$title, $content, $image, $category_id]);
    }
    
    public function updateNews($id, $title, $content, $image, $category_id) {
        $sql = "UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?";
        return $this->db->query($sql, [$title, $content, $image, $category_id, $id]);
    }
    
    public function deleteNews($id) {
        $sql = "DELETE FROM news WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
}
