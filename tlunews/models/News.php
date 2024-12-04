<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/config/Database.php';

class News {
    public static function getAll($categoryId = null) {
        $db = Database::getInstance();
                $query = "SELECT * FROM news";
        if ($categoryId) {
            $query .= " WHERE category_id = :category_id";
        }
    
        $stmt = $db->prepare($query);
    
        if ($categoryId) {
            $stmt->bindParam(':category_id', $categoryId);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getInstance();
        $query = "SELECT * FROM news WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }


    public static function add($title, $content, $image, $categoryId, $createdAt) {
        $db = Database::getInstance();
        $query = "INSERT INTO news (title, content, image, created_at, category_id) 
                  VALUES (:title, :content, :image, :created_at, :category_id)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':created_at', $createdAt);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
    }


    public static function edit($id, $title, $content, $image, $categoryId) {
        $db = Database::getInstance();   
        $sql = "UPDATE news SET title = :title, content = :content, image = :image, category_id = :category_id WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        
        try {
            $stmt->execute();
                if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log('Lỗi khi cập nhật tin tức: ' . $e->getMessage());
            return false; 
        }
    }
    
    
    public static function deleteById($id) {
        $db = Database::getInstance();
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log('Lỗi khi xóa tin tức: ' . $e->getMessage());
            return false; 
        }
    }
    
    

    
    
}
