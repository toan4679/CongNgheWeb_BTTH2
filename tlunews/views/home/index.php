<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TLU News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/tlu/tlunews">TLU News</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php foreach ($categories as $category): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="tlunews/category/index/<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form class="d-flex" action="/tlu/tlunews/home/search" method="GET">
                    <input class="form-control me-2" type="search" name="keyword" 
                           placeholder="Tìm kiếm..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                    <button class="btn btn-outline-light" type="submit">Tìm</button>
                </form>
                <?php if (isset($_SESSION['admin'])): ?>
                    <a href="/tlu/tlunews/admin" class="btn btn-light btn-sm ms-2" style="color: #ff6699; font-weight: bold; border: 2px solid #ff6699;">Admin Panel</a>
                <?php else: ?>
                    <a href="/tlu/tlunews/admin/login" class="btn btn-login ms-2">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_GET['keyword'])): ?>
            <h3 class="text-center text-primary">Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($_GET['keyword']); ?>"</h3>
        <?php endif; ?>

        <div class="row">
            <?php if (empty($news)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Không có tin tức nào.</p>
                </div>
            <?php else: ?>
                <?php foreach ($news as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/tlu/tlunews/uploads/image/<?php echo $item['image']; ?>" 
                             class="card-img-top" alt="" style="height: 200px; object-fit: cover;">
<div class="card-body">
                            <h5 class="card-title text-danger"><?php echo $item['title']; ?></h5>
                            <p class="card-text text-muted"><?php echo substr(strip_tags($item['content']), 0, 150); ?>...</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                Danh mục: <strong><?php echo $item['category_name']; ?></strong> | 
                                Ngày: <?php echo date('d/m/Y', strtotime($item['created_at'])); ?>
                            </small>
                            <a href="/tlu/tlunews/news/detail/<?php echo $item['id']; ?>" 
                               class="btn btn-primary float-end">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>