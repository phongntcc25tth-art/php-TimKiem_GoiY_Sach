<?php
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/functions.php';
$genres = get_genres($conn);
$page_title = $page_title ?? 'Tìm kiếm & Gợi ý Sách';
$tukhoa = $_GET['tukhoa'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?> — Thư viện Sách</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="logo">📚 Sách<span>Hay</span></a>
    <form class="search-form" action="search.php" method="get">
      <input type="text" name="tukhoa" placeholder="Tìm theo tên sách, tác giả, thể loại..." value="<?= e($tukhoa) ?>">
      <button type="submit">Tìm</button>
    </form>
    <a href="admin/login.php" class="admin-link">🔐 Quản trị</a>
  </div>
  <nav class="main-nav">
    <div class="container">
      <a href="index.php">Tất cả</a>
      <?php foreach ($genres as $g): ?>
        <a href="category.php?theloai=<?= urlencode($g) ?>"><?= e($g) ?></a>
      <?php endforeach; ?>
    </div>
  </nav>
</header>
<main class="container">
