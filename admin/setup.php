<?php
// Chạy MỘT LẦN để tạo tài khoản admin (admin / admin123). Sau đó XÓA file này đi.
require_once __DIR__ . '/../includes/connect.php';
$username = 'admin';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo "⚠️ Tài khoản admin đã tồn tại. Bạn có thể <a href='login.php'>đăng nhập</a>.<br>";
    echo "👉 Hãy XÓA file setup.php này đi để đảm bảo an toàn!";
} else {
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash, hoten) VALUES (?, ?, 'Quản trị viên')");
    $stmt->execute([$username, $hash]);
    echo "✅ Đã tạo tài khoản admin thành công!<br>";
    echo "👉 Tên đăng nhập: <strong>admin</strong> | Mật khẩu: <strong>admin123</strong><br>";
    echo "👉 Bây giờ hãy <a href='login.php'>đăng nhập</a> và <strong>XÓA file setup.php</strong>!";
}
