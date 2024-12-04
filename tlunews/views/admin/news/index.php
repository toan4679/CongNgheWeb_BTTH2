<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';

$categories = Category::getAll();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Quản lý Tin Tức</h1>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success_message']; ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_message']; ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>


        <div class="d-flex justify-content-end mb-3">
            <a href="/admin/news/add" class="btn btn-primary">Thêm Tin Mới</a>
        </div>

        <form action="/admin/news" method="GET" class="mb-4">
            <div class="d-flex justify-content-end">
                <select name="category_id" class="form-select w-auto">
                    <option value="">Chọn thể loại</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary ms-2">Lọc</button>
            </div>
        </form>

        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col" class="text-center">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($newsList)): ?>
                    <?php foreach ($newsList as $index => $news): ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo htmlspecialchars($news['title']); ?></td>
                            <td><?php echo htmlspecialchars($news['created_at']); ?></td>
                            <td><?php echo substr(htmlspecialchars($news['content']), 0, 100) . '...'; ?></td>
                            <td><img src="/uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="Image" width="100"></td>
                            <td class="text-center">
                                <a href="/admin/news/edit/<?php echo $news['id']; ?>" class="btn btn-warning">Sửa</a>
                                <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete(<?php echo $news['id']; ?>)">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có tin tức nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <script type="text/javascript">
        function confirmDelete(id) {
            var confirmation = confirm("Bạn có chắc chắn muốn xóa tin tức này?");
            if (confirmation) {
                window.location.href = '/admin/news/delete/' + id;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
