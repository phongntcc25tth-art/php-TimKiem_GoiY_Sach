<?php
$tukhoa = trim($_GET['tukhoa'] ?? '');
$page_title = $tukhoa ? "Tìm kiếm: $tukhoa" : 'Tìm kiếm';
require_once __DIR__ . '/includes/header.php';

$books = [];
$suggestions = [];
if ($tukhoa !== '') {
    $like = "%$tukhoa%";
    $stmt = $conn->prepare("SELECT * FROM sach
        WHERE tensach LIKE ? OR tacgia LIKE ? OR theloai LIKE ?
        ORDER BY luotxem DESC");
    $stmt->execute([$like, $like, $like]);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Gợi ý cùng thể loại của cuốn đầu tiên tìm được
    if ($books) {
        $stmt2 = $conn->prepare("SELECT * FROM sach WHERE theloai = ? AND id != ? ORDER BY luotxem DESC LIMIT 4");
        $stmt2->execute([$books[0]['theloai'], $books[0]['id']]);
        $suggestions = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<h2 class="section-title">Kết quả tìm kiếm: "<?= e($tukhoa) ?>" <small style="color:#888;font-weight:normal">(<?= count($books) ?> cuốn)</small></h2>

<?php if ($tukhoa === ''): ?>
<div class="empty">Nhập từ khóa vào ô tìm kiếm ở trên (tên sách, tác giả hoặc thể loại).</div>
<?php elseif (!$books): ?>
<div class="empty">❌ Không tìm thấy sách phù hợp với "<?= e($tukhoa) ?>". Thử từ khóa khác nhé!</div>
<?php else: ?>
<div class="grid">
  <?php foreach ($books as $b): ?>
  <article class="card">
    <div class="cover">📖</div>
    <div class="body">
      <h3><a href="detail.php?id=<?= $b['id'] ?>"><?= e($b['tensach']) ?></a></h3>
      <p class="author"><?= e($b['tacgia']) ?></p>
      <p class="desc"><?= e(excerpt($b['mota'], 80)) ?></p>
      <span class="tag"><?= e($b['theloai']) ?></span>
      <p class="price"><?= fmt_gia($b['gia']) ?></p>
    </div>
  </article>
  <?php endforeach; ?>
</div>

<?php if ($suggestions): ?>
<h2 class="section-title">💡 Gợi ý cùng thể loại "<?= e($books[0]['theloai']) ?>"</h2>
<div class="grid">
  <?php foreach ($suggestions as $s): ?>
  <article class="card">
    <div class="cover">📖</div>
    <div class="body">
      <h3><a href="detail.php?id=<?= $s['id'] ?>"><?= e($s['tensach']) ?></a></h3>
      <p class="author"><?= e($s['tacgia']) ?></p>
      <p class="price"><?= fmt_gia($s['gia']) ?></p>
    </div>
  </article>
  <?php endforeach; ?>
</div>
<?php endif; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
