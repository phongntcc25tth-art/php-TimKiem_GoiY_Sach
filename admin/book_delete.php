<?php
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require_once __DIR__ . '/../includes/connect.php';
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $conn->prepare("DELETE FROM sach WHERE id = ?");
    $stmt->execute([$id]);
}
header('Location: index.php?msg=' . urlencode('Đã xóa sách!'));
exit;
