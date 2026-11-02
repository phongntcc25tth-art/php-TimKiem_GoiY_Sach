<?php
session_start();
require_once __DIR__ . '/../includes/connect.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: index.php'); exit;
    } else {
        $error = 'Sai tên đăng nhập hoặc mật khẩu!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8"><title>Đăng nhập Admin</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="admin-wrap login-box">
  <h1>🔐 Đăng nhập Quản trị</h1>
  <?php if ($error): ?><div class="alert err"><?= $error ?></div><?php endif; ?>
  <form method="post">
    <div class="form-group"><label>Tên đăng nhập</label><input type="text" name="username" required value="admin"></div>
    <div class="form-group"><label>Mật khẩu</label><input type="password" name="password" required></div>
    <button class="btn" type="submit" style="width:100%">Đăng nhập</button>
  </form>
  <p style="margin-top:14px;font-size:.85rem;color:#888">Mặc định: admin / admin123 (chạy <a href="setup.php">setup.php</a> nếu chưa có tài khoản)</p>
  <p style="margin-top:8px"><a href="../index.php">← Về trang chủ</a></p>
</div>
</body></html>
