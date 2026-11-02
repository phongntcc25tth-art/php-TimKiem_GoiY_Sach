<?php
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/../includes/connect.php';
$id = (int)($_GET['id'] ?? 0);
$book = ['id' => 0, 'tensach' => '', 'tacgia' => '', 'theloai' => '', 'mota' => '', 'gia' => '', 'luotxem' => 0];
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM sach WHERE id = ?");
    $stmt->execute([$id]);
    $b = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($b) $book = $b;
}
?>
<!DOCTYPE html>
<html lang="vi"><head><meta charset="UTF-8"><title><?= $id ? 'Sửa' : 'Thêm' ?> sách</title>
<link rel="stylesheet" href="../assets/style.css"></head>
<body>
<div class="admin-wrap">
  <h1><?= $id ? '✏️ Sửa sách' : '➕ Thêm sách mới' ?></h1>
  <form method="post" action="book_save.php">
    <input type="hidden" name="id" value="<?= $book['id'] ?>">
    <div class="form-group"><label>Tên sách *</label><input type="text" name="tensach" required value="<?= e($book['tensach']) ?>"></div>
    <div class="form-group"><label>Tác giả *</label><input type="text" name="tacgia" required value="<?= e($book['tacgia']) ?>"></div>
    <div class="form-group"><label>Thể loại *</label><input type="text" name="theloai" required value="<?= e($book['theloai']) ?>" placeholder="VD: Kỹ năng sống, Tài chính..."></div>
    <div class="form-group"><label>Mô tả</label><textarea name="mota"><?= e($book['mota']) ?></textarea></div>
    <div class="form-group"><label>Giá (VNĐ) *</label><input type="number" name="gia" required min="0" step="1000" value="<?= e($book['gia']) ?>"></div>
    <button class="btn" type="submit">💾 Lưu</button>
    <a class="btn" href="index.php" style="background:#6b7280">Hủy</a>
  </form>
</div>
</body></html>
