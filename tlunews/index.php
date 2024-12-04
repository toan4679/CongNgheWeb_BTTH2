<?php
session_start();

require_once 'controllers/AdminController.php';
require_once 'models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/config/Database.php';

$adminController = new AdminController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri == '/admin/login') {
    $adminController->login();
} elseif ($uri == '/admin/dashboard') {
    $adminController->dashboard();
} elseif ($uri == '/admin/news') {  
    $adminController->manageNews(); 
} elseif ($uri == '/admin/news/add') { 
    $adminController->manageAdd();   
} elseif ($uri == '/admin/logout') {
    $adminController->logout();
} 

elseif (preg_match('/^\/admin\/news\/edit\/(\d+)$/', $uri, $matches)) {
    $id = $matches[1]; 
    $adminController->manageEdit($id); 
} 

elseif (preg_match('/^\/admin\/news\/delete\/(\d+)$/', $uri, $matches)) {
    $id = $matches[1]; 
    $adminController->deleteNews($id); 
    echo "404 Not Found!";
}
