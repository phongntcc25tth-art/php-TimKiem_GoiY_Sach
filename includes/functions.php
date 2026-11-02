<?php
function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function fmt_gia($g) { return number_format((float)$g, 0, ',', '.') . ' VNĐ'; }
function fmt_date($d) { return date('d/m/Y', strtotime($d)); }
function excerpt($s, $len = 100) {
    $s = strip_tags($s ?? '');
    if (mb_strlen($s, 'UTF-8') <= $len) return $s;
    return mb_substr($s, 0, $len, 'UTF-8') . '…';
}
function get_genres($conn) {
    $stmt = $conn->query("SELECT DISTINCT theloai FROM sach ORDER BY theloai");
    return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'theloai');
}
function get_book($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM sach WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function increment_views($conn, $id) {
    $stmt = $conn->prepare("UPDATE sach SET luotxem = luotxem + 1 WHERE id = ?");
    $stmt->execute([$id]);
}
