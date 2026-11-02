<?php
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/../includes/connect.php';
require_once __DIR__ . '/../includes/functions.php';
$msg = $_GET['msg'] ?? '';
$books = $conn->query("SELECT * FROM sach ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi"><head><meta charset="UTF-8"><title>Quản lý sách</title>
<link rel="stylesheet" href="../assets/style.css"></head>
<body>
<div class="admin-wrap">
  <h1>📚 Quản lý sách <span style="font-size:.85rem;font-weight:normal;color:#888">(<?= count($books) ?> cuốn)</span></h1>
  <p style="margin-bottom:14px">
    <a class="btn" href="book_form.php">➕ Thêm sách mới</a>
    <a class="btn" href="../index.php" style="background:#6b7280">Xem trang chủ</a>
    <a class="btn btn-danger" href="logout.php" style="float:right">Đăng xuất (<?= e($_SESSION['admin_username']) ?>)</a>
  </p>
  <?php if ($msg): ?><div class="alert ok"><?= e($msg) ?></div><?php endif; ?>
  <table class="admin-table">
    <thead><tr><th>ID</th><th>Tên sách</th><th>Tác giả</th><th>Thể loại</th><th>Giá</th><th>Lượt xem</th><th>Thao tác</th></tr></thead>
    <tbody>
    <?php foreach ($books as $b): ?>
      <tr>
        <td><?= $b['id'] ?></td>
        <td><?= e($b['tensach']) ?></td>
        <td><?= e($b['tacgia']) ?></td>
        <td><?= e($b['theloai']) ?></td>
        <td><?= fmt_gia($b['gia']) ?></td>
        <td><?= $b['luotxem'] ?></td>
        <td>
          <a href="book_form.php?id=<?= $b['id'] ?>">Sửa</a> |
          <a href="book_delete.php?id=<?= $b['id'] ?>" onclick="return confirm('Xóa sách này?')" style="color:#dc2626">Xóa</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body></html>
