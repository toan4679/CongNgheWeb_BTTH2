<!DOCTYPE html>
<html>
<link rel="stylesheet" href="detail.css">
<head>
    <title><?php echo $news['title']; ?></title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #ffe6f2;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

article {
    max-width: 900px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #2c3e50;
}

img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
}

.meta {
    font-size: 1em;
    color: #7f8c8d;
    margin-bottom: 20px;
}

.content {
    font-size: 1.2em;
    line-height: 1.8;
    color: #34495e;
}

.meta a {
    color: #2980b9;
    text-decoration: none;
}

.meta a:hover {
    text-decoration: underline;
}
@media (max-width: 768px) {
    h1 {
        font-size: 2em;
    }

    .content {
        font-size: 1em;
    }
}
</style>
<body>
    <article>
        <h1><?php echo $news['title']; ?></h1>
        <img src="/tlu/tlunews/uploads/image/<?php echo $news['image']; ?>" alt="">
        <div class="meta">
            Danh mục: <?php echo $news['category_name']; ?> |
            Ngày đăng: <?php echo $news['created_at']; ?>
        </div>
        <div class="content">
            <?php echo $news['content']; ?>
        </div>
    </article>
</body>

</html>
