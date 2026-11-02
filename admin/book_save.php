<?php
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/../includes/connect.php';

$id = (int)($_POST['id'] ?? 0);
$tensach = trim($_POST['tensach'] ?? '');
$tacgia = trim($_POST['tacgia'] ?? '');
$theloai = trim($_POST['theloai'] ?? '');
$mota = trim($_POST['mota'] ?? '');
$gia = (float)($_POST['gia'] ?? 0);

if ($tensach === '' || $tacgia === '' || $theloai === '') {
    header('Location: book_form.php?id=' . $id); exit;
}

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE sach SET tensach=?, tacgia=?, theloai=?, mota=?, gia=? WHERE id=?");
    $stmt->execute([$tensach, $tacgia, $theloai, $mota, $gia, $id]);
    $msg = 'Đã cập nhật sách thành công!';
} else {
    $stmt = $conn->prepare("INSERT INTO sach (tensach, tacgia, theloai, mota, gia) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$tensach, $tacgia, $theloai, $mota, $gia]);
    $msg = 'Đã thêm sách mới thành công!';
}
header('Location: index.php?msg=' . urlencode($msg));
exit;
