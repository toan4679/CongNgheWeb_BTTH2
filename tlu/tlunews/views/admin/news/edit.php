<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Sửa Tin Tức</h2>
        <form action="/tlu/tlunews/admin/editNews/<?= $news['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= $news['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" id="content" class="form-control" rows="5" required><?= $news['content']; ?></textarea>
            </div>
            <!-- <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>" <?= $category['id'] == $news['category_id'] ? 'selected' : ''; ?>>
                            <?= $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div> -->
            <div class="mb-3">
                <label for="current_image" class="form-label">Hình ảnh hiện tại</label>
                <img src="/tlu/tlunews/<?= $news['image']; ?>" alt="" class="d-block mb-3" style="max-width: 150px;">
                <input type="hidden" name="current_image" value="<?= $news['image']; ?>">
                <label for="image" class="form-label">Thay đổi hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="/tlu/tlunews/admin" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
