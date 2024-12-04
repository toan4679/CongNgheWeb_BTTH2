<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/config/Database.php';

class Category {

    public static function getAll() {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();  
    }


    public static function exists($categoryId) {
        $db = Database::getInstance();
        $query = "SELECT COUNT(*) FROM categories WHERE id = :category_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

}
