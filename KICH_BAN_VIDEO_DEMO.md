# KỊCH BẢN QUAY VIDEO DEMO SẢN PHẨM (khoảng 5 phút)

> Mẹo: dùng OBS Studio hoặc Xbox Game Bar (Win+G) để quay màn hình. Nói rõ ràng, chậm rãi.
> Bật mic, quay cả màn hình trình duyệt + terminal (nếu cần).

## Phần 1 — Mở đầu (0:00 – 0:40) ~40s
- [Nói] "Chào thầy/cô, em là [tên], MSSV [...]. Em xin demo đề tài tiểu luận môn Công nghệ Web: Xây dựng website Tìm kiếm & Gợi ý Sách."
- [Thao tác] Mở file README hoặc báo cáo, chỉ ra đề tài.
- [Nói] "Website được viết bằng PHP + MySQL, dùng PDO prepared statement chống SQL Injection và htmlspecialchars chống XSS."

## Phần 2 — Cài đặt & CSDL (0:40 – 1:30) ~50s
- [Thao tác] Mở phpMyAdmin → chỉ database `qlsach` → bảng `sach` (12 cuốn sách mẫu) → bảng `users`.
- [Nói] "Dữ liệu gồm 12 cuốn sách thuộc 5 thể loại. Mật khẩu admin được lưu dạng hash bcrypt, không lưu plaintext."
- [Thao tác] Chỉ nhanh file `database/qlsach.sql`.

## Phần 3 — Trang chủ & Tìm kiếm (1:30 – 2:40) ~70s
- [Thao tác] Mở `http://localhost/TimKiem_GoiY_Sach/` → giới thiệu giao diện: sách nổi bật, menu thể loại, ô tìm kiếm.
- [Thao tác] Gõ tìm kiếm "Tài chính" → chỉ kết quả.
- [Thao tác] Gõ tìm kiếm "Nam Cao" → chỉ kết quả tìm theo tác giả.
- [Nói] "Tìm kiếm hỗ trợ theo tên sách, tác giả, thể loại, dùng LIKE không phân biệt hoa thường."

## Phần 4 — Chi tiết & Gợi ý (2:40 – 3:40) ~60s
- [Thao tác] Click vào một cuốn sách (VD: Đắc Nhân Tâm) → xem chi tiết: giá, mô tả, lượt xem tự tăng.
- [Thao tác] Cuộn xuống phần "Có thể bạn cũng thích" → chỉ 4 sách cùng thể loại "Kỹ năng sống", sắp xếp theo lượt xem.
- [Nói] "Đây là thuật toán gợi ý dựa trên nội dung (content-based): cùng thể loại, lấy 4 cuốn xem nhiều nhất, bỏ qua cuốn đang xem."

## Phần 5 — Lọc theo thể loại (3:40 – 4:00) ~20s
- [Thao tác] Click menu "Văn học VN" → chỉ danh sách lọc đúng thể loại.

## Phần 6 — Trang quản trị Admin (4:00 – 4:50) ~50s
- [Thao tác] Mở `admin/login.php` → đăng nhập admin/admin123.
- [Thao tác] Dashboard: danh sách sách, thêm 1 sách mới (điền tên/tác giả/thể loại/giá) → lưu → về trang chủ thấy sách mới.
- [Thao tác] Sửa giá 1 cuốn → xóa 1 cuốn (có confirm) → đăng xuất.
- [Nói] "Admin có thể thêm/sửa/xóa sách. Toàn bộ truy vấn dùng prepared statement nên an toàn."

## Phần 7 — Kết thúc (4:50 – 5:00) ~10s
- [Nói] "Em xin kết thúc phần demo. Em cảm ơn thầy/cô đã theo dõi."
- [Thao tác] Dừng quay.

---
**Lưu ý khi quay:**
- Nói tên + MSSV rõ ràng ở đầu video (bắt buộc để chứng minh làm cá nhân).
- Có thể quay 1 lần liền hoặc cắt ghép các đoạn. Tổng thời gian mục tiêu 4:30–5:30 là được.
- Nếu muốn quay mượt, luyện tập trước 1–2 lần.
