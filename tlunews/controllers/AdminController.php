<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/News.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';
class AdminController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = User::getByUsername($username);  

            if ($user) {
                if ($user->checkPassword($password)) {
                    if ($user->getRole() == 1) { // Quản trị viên
                        $_SESSION['user'] = [
                            'id' => $user->getId(),
                            'username' => $user->getUsername(),
                            'role' => $user->getRole()
                        ];
                        header('Location: /admin/dashboard');
                        exit();
                    } else { 
                        $error = "Bạn không có quyền truy cập vào trang quản trị.";
                    }
                } else {
                    $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                }
            } else {
                $error = "Tên đăng nhập không tồn tại.";
            }
        }
        require_once 'views/admin/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /admin/login');
        exit();
    }

    public function dashboard() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            header('Location: /admin/login');
            exit();
        }

        require_once 'views/admin/dashboard.php';
    }

    public function manageNews() {
        $categories = Category::getAll();
        $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;
        $newsList = News::getAll($categoryId); 
    
        require_once 'views/admin/news/index.php';
    }

    public function manageAdd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
    
            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
    
                if ($file['error'] === 0) {
                    $fileName = $file['name'];
                    $fileTmpPath = $file['tmp_name'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $newFileName;
    
                    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                        $createdAt = date('Y-m-d H:i:s');
    
                        News::add($title, $content, $newFileName, $categoryId, $createdAt);
                        header('Location: /admin/news');
                        exit();
                    } else {
                        $error = "Lỗi khi tải ảnh lên.";
                    }
                } else {
                    $error = "Không có ảnh được chọn hoặc file không hợp lệ.";
                }
            } else {
                $error = "Vui lòng chọn một ảnh.";
            }
        }
    
        $categories = Category::getAll();
        require_once 'views/admin/news/add.php';
    }

    public function manageEdit($id) {
        $news = News::getById($id);
        if (!$news) {
            echo "Tin tức không tồn tại.";
            exit();
        }
        $categories = Category::getAll();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category_id'];
            $image = $news['image'];
    
            if (!empty($_FILES['image']['name'])) {
                $newImage = $this->uploadImage($_FILES['image']);
    
                if ($newImage) {
                    $image = $newImage; 
                } else {
                    echo "Lỗi khi upload ảnh.";
                    exit();
                }
            }
                $updateSuccess = News::edit($id, $title, $content, $image, $categoryId);
    
            if ($updateSuccess) {
                $_SESSION['success_message'] = "Sửa tin tức thành công!";
            } else {
                $_SESSION['error_message'] = "Có lỗi xảy ra khi sửa tin tức.";
            }
            header('Location: /admin/news');
            exit();
        }
        require_once 'views/admin/news/edit.php';
    }
    

public function uploadImage($file) {
    $fileName = basename($file['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; 

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        return false; 
    }
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

    if (file_exists($uploadDir . $newFileName)) {
        return $newFileName; 
    }

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
        return $newFileName; 
    } else {
        return false; 
    }
}


public function deleteNews($id) {
    if ($_SESSION['user']['role'] != 1) {
        $_SESSION['error_message'] = "Bạn không có quyền xóa tin tức.";
        header('Location: /admin/news');
        exit();
    }
    $deleteSuccess = News::deleteById($id);
    if ($deleteSuccess) {
        $_SESSION['success_message'] = "Tin tức đã được xóa thành công!";
    } else {
        $_SESSION['error_message'] = "Có lỗi xảy ra khi xóa tin tức.";
    }
    header('Location: /admin/news');
    exit();
}
   
}
