-- ============================================================
-- qlsach.sql - CSDL Quan Ly Sach (Tìm kiếm & Gợi ý Sách)
-- MySQL 5.7+/8.0, charset utf8mb4
-- Cách dùng: tạo database 'qlsach' rồi import file này.
-- ============================================================

CREATE DATABASE IF NOT EXISTS qlsach CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE qlsach;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sach;

-- Bảng sách (mở rộng: có ảnh bìa, ngày nhập)
CREATE TABLE sach (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    tensach  VARCHAR(255) NOT NULL,
    tacgia   VARCHAR(255) NOT NULL,
    theloai  VARCHAR(100) NOT NULL,
    mota     TEXT,
    gia      DECIMAL(10,2) NOT NULL,
    luotxem  INT DEFAULT 0,
    anhbia   VARCHAR(255) DEFAULT NULL,
    ngaynhap DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO sach (tensach, tacgia, theloai, mota, gia, luotxem) VALUES
('Đắc Nhân Tâm', 'Dale Carnegie', 'Kỹ năng sống', 'Nghệ thuật đối nhân xử thế, giao tiếp và gây thiện cảm.', 65000, 350),
('Đời Ngắn Đừng Ngủ Dài', 'Robin Sharma', 'Kỹ năng sống', 'Sống có mục tiêu, đánh thức tiềm năng bên trong bạn.', 68000, 210),
('7 Thói Quen Thành Công', 'Stephen Covey', 'Kỹ năng sống', 'Xây dựng 7 thói quen hiệu quả cho cuộc sống và công việc.', 98000, 280),
('Cha Giàu Cha Nghèo', 'Robert Kiyosaki', 'Tài chính', 'Tư duy làm giàu, quản lý tiền bạc thông minh.', 110000, 320),
('Người Giàu Nhất Babylon', 'George Clason', 'Tài chính', 'Bí quyết quản lý tiền bạc từ những câu chuyện cổ.', 45000, 200),
('Tư Duy Nhanh Và Chậm', 'Daniel Kahneman', 'Tâm lý', 'Hai hệ thống tư duy và cách chúng ta ra quyết định.', 89000, 150),
('Lược Sử Loài Người', 'Yuval Harari', 'Tâm lý', 'Sự phát triển của loài người từ thời đại đồ đá đến ngày nay.', 115000, 280),
('Tắt Đèn', 'Ngô Tất Tố', 'Văn học VN', 'Bức tranh xã hội nông thôn Việt Nam trước Cách mạng.', 52000, 220),
('Chí Phèo', 'Nam Cao', 'Văn học VN', 'Bi kịch của người nông dân lạc lối trong xã hội cũ.', 48000, 190),
('Nhà Giả Kim', 'Paulo Coelho', 'Văn học nước ngoài', 'Hành trình theo đuổi ước mơ và vận mệnh của mỗi người.', 58000, 310),
('Harry Potter và Hòn Đá Phù Thủy', 'J.K. Rowling', 'Văn học nước ngoài', 'Bước vào thế giới phép thuật kỳ ảo của phù thủy.', 85000, 420),
('Nghĩ Giàu Làm Giàu', 'Napoleon Hill', 'Tài chính', 'Triết lý thành công từ những người vĩ đại nhất.', 75000, 175);

-- Bảng quản trị viên (mật khẩu được hash bằng password_hash)
-- Tài khoản admin mặc định được tạo bằng file admin/setup.php (admin / admin123)
CREATE TABLE users (
    id            INT PRIMARY KEY AUTO_INCREMENT,
    username      VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    hoten         VARCHAR(100),
    created_at    DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
