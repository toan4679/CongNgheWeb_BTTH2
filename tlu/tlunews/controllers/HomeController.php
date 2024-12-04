<?php
class HomeController
{
    private $newsModel;
    private $categoryModel;

    public function __construct()
    {
        $this->newsModel = new News();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $news = $this->newsModel->getAllNews(); // Lấy tin tức
        $categories = $this->categoryModel->getAllCategories(); // Lấy danh mục
        require 'views/home/index.php';
    }

    public function search()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $news = $this->newsModel->searchNews($keyword);
        $categories = $this->categoryModel->getAllCategories();
        require 'views/home/index.php';
    }
}
