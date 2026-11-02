<?php
// Kết nối MySQL bằng PDO. Đã sửa lỗi: $host = "localhost" (KHÔNG phải đường dẫn file).
$host     = "localhost";
$dbname   = "qlsach";
$username = "root";
$password = ""; // XAMPP/WAMP để trống; nếu có mật khẩu thì điền vào

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("❌ Kết nối CSDL thất bại: " . $e->getMessage() .
        "<br>→ Đã tạo database 'qlsach' và import database/qlsach.sql chưa? MySQL đang chạy chưa?");
}
