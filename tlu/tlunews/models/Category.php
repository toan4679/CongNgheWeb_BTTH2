<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories"; // Giả sử bảng của bạn là 'categories'
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(); // Trả về một mảng các danh mục
    }
}
