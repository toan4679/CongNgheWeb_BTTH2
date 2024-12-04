<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Sửa Tin Tức</h1>
        <form action="/admin/news/edit/<?php echo $news['id']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return confirmUpdate();">
    <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Nội dung</label>
        <textarea class="form-control" id="content" name="content" rows="4" required><?php echo htmlspecialchars($news['content']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $news['category_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Chọn ảnh</label>
        <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
        <img id="imagePreview" src="/uploads/<?php echo htmlspecialchars($news['image']); ?>" alt="Current Image" class="mt-3" width="200" />
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<script>
    // Hàm thay đổi ảnh hiển thị khi chọn tệp
    function previewImage(event) {
        const output = document.getElementById('imagePreview');
        output.src = URL.createObjectURL(event.target.files[0]); // Cập nhật ảnh khi chọn tệp
    }

    // Xác nhận sửa tin tức
    function confirmUpdate() {
        return confirm("Bạn có chắc chắn muốn sửa tin tức này?");
    }
</script>

</body>
</html>
