<?php
class AdminController {
    private $userModel;
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->newsModel = new News();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $this->checkAdmin();
        $news = $this->newsModel->getAllNews();
        require 'views/admin/index.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['admin'] = $user;
                header('Location: /tlu/tlunews/admin');
                exit;
            }
        }
        require 'views/admin/login.php';
    }
    
    public function logout() {
        unset($_SESSION['admin']);
        header('Location: /tlu/tlunews');
        exit;
    }
    
    public function addNews() {
        $this->checkAdmin(); // Kiểm tra quyền admin
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
    
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
            // Gọi model để thêm tin
            $success = $this->newsModel->addNews(
                $_POST['title'], 
                $_POST['content'], 
                $target_file, 
                $_POST['category_id']
            );
    
            if ($success) {
                $_SESSION['message'] = "Thêm tin tức thành công!";
            } else {
                $_SESSION['message'] = "Thêm tin tức thất bại.";
            }
    
            // Chuyển hướng về danh sách tin tức
            header('Location: /tlu/tlunews/admin');
            exit;
        }
    
        $categories = $this->categoryModel->getAllCategories();
        require 'views/admin/news/add.php';
    }
    
    
    
    public function editNews($id) {
        $this->checkAdmin(); // Kiểm tra quyền admin
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = $_POST['current_image'];
    
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $target_file;
            }
    
            $this->newsModel->updateNews(
                $id, 
                $_POST['title'], 
                $_POST['content'], 
                $image, 
                $_POST['category_id']
            );
    
            $_SESSION['message'] = "Cập nhật tin tức thành công!";
            header('Location: /tlu/tlunews/admin');
            exit;
        }
    
        $news = $this->newsModel->getNewsById($id);
        $categories = $this->categoryModel->getAllCategories();
        require 'views/admin/news/edit.php';
    }
    
    
    private function checkAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: /tlu/tlunews/admin/login');
            exit;
        }
    }
}
