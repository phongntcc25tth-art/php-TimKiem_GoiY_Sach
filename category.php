<?php
$theloai = trim($_GET['theloai'] ?? '');
$page_title = $theloai ? "Thể loại: $theloai" : 'Theo thể loại';
require_once __DIR__ . '/includes/header.php';

$books = [];
if ($theloai !== '') {
    $stmt = $conn->prepare("SELECT * FROM sach WHERE theloai = ? ORDER BY luotxem DESC");
    $stmt->execute([$theloai]);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2 class="section-title">Thể loại: <?= e($theloai) ?> <small style="color:#888;font-weight:normal">(<?= count($books) ?> cuốn)</small></h2>

<?php if (!$books): ?>
<div class="empty">Không có sách nào trong thể loại này. <a href="index.php">Xem tất cả</a></div>
<?php else: ?>
<div class="grid">
  <?php foreach ($books as $b): ?>
  <article class="card">
    <div class="cover">📖</div>
    <div class="body">
      <h3><a href="detail.php?id=<?= $b['id'] ?>"><?= e($b['tensach']) ?></a></h3>
      <p class="author"><?= e($b['tacgia']) ?></p>
      <p class="desc"><?= e(excerpt($b['mota'], 80)) ?></p>
      <p class="price"><?= fmt_gia($b['gia']) ?></p>
      <p class="views">👁 <?= $b['luotxem'] ?> lượt xem</p>
    </div>
  </article>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
