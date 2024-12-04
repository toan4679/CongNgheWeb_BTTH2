<?php
session_start();
require_once 'config/database.php';

// Include các Model
require_once 'models/News.php';
require_once 'models/Category.php';
require_once 'models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = intval($_POST['id']);
    
    // Kiểm tra id có hợp lệ không
    if ($id > 0) {
        require_once 'models/News.php';
        $newsModel = new News();
        
        // Lấy thông tin tin tức để xóa ảnh cũ
        $news = $newsModel->getNewsById($id);
        if ($news && file_exists($news['image'])) {
            unlink($news['image']); // Xóa file ảnh
        }

        // Gọi phương thức xóa từ model
        $success = $newsModel->deleteNews($id);

        // Thêm thông báo vào session
        if ($success) {
            $_SESSION['message'] = "Đã xóa tin tức thành công.";
        } else {
            $_SESSION['message'] = "Xóa tin tức thất bại.";
        }
    } else {
        $_SESSION['message'] = "ID không hợp lệ.";
    }

    // Chuyển hướng về trang admin
    header('Location: /tlu/tlunews/admin');
    exit;
}

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Xác định controller và action
$controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$action = isset($url[1]) ? $url[1] : 'index';
$param = isset($url[2]) ? $url[2] : null;

// Kiểm tra file controller tồn tại
$controllerFile = "controllers/$controller.php";
if (!file_exists($controllerFile)) {
    header("HTTP/1.0 404 Not Found");
    require 'views/404.php';
    exit;
}

require_once $controllerFile;
$controllerInstance = new $controller();

// Kiểm tra method tồn tại
if (!method_exists($controllerInstance, $action)) {
    $action = 'index';
}

// Gọi method
$controllerInstance->$action($param);
