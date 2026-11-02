<?php
$id = (int)($_GET['id'] ?? 0);
require_once __DIR__ . '/includes/connect.php';
require_once __DIR__ . '/includes/functions.php';

$book = get_book($conn, $id);
if (!$book) {
    $page_title = 'Sách không tồn tại';
    require_once __DIR__ . '/includes/header.php';
    echo '<div class="empty">❌ Sách không tồn tại. <a href="index.php">Về trang chủ</a></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

increment_views($conn, $id);
$book['luotxem']++;

// Gợi ý cùng thể loại (bỏ qua sách hiện tại, lấy 4 cuốn xem nhiều nhất)
$stmt = $conn->prepare("SELECT * FROM sach WHERE theloai = ? AND id != ? ORDER BY luotxem DESC LIMIT 4");
$stmt->execute([$book['theloai'], $id]);
$suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = $book['tensach'];
require_once __DIR__ . '/includes/header.php';
?>

<article class="detail">
  <div class="big-cover">📖</div>
  <div>
    <span class="tag"><?= e($book['theloai']) ?></span>
    <h1><?= e($book['tensach']) ?></h1>
    <p class="meta">Tác giả: <strong><?= e($book['tacgia']) ?></strong> • 👁 <?= $book['luotxem'] ?> lượt xem • Nhập ngày <?= fmt_date($book['ngaynhap']) ?></p>
    <p class="price-big"><?= fmt_gia($book['gia']) ?></p>
    <p class="desc-full"><?= nl2br(e($book['mota'])) ?></p>
    <a class="btn" href="index.php">← Quay lại danh sách</a>
  </div>
</article>

<?php if ($suggestions): ?>
<h2 class="section-title">💡 Có thể bạn cũng thích (cùng thể loại "<?= e($book['theloai']) ?>")</h2>
<div class="grid">
  <?php foreach ($suggestions as $s): ?>
  <article class="card">
    <div class="cover">📖</div>
    <div class="body">
      <h3><a href="detail.php?id=<?= $s['id'] ?>"><?= e($s['tensach']) ?></a></h3>
      <p class="author"><?= e($s['tacgia']) ?></p>
      <p class="price"><?= fmt_gia($s['gia']) ?></p>
      <p class="views">👁 <?= $s['luotxem'] ?> lượt xem</p>
    </div>
  </article>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
