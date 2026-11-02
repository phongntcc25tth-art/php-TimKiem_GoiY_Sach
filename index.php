<?php
$page_title = 'Trang chủ';
require_once __DIR__ . '/includes/header.php';

// Sách nổi bật (luotxem cao nhất)
$featured = $conn->query("SELECT * FROM sach ORDER BY luotxem DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

// Tất cả sách
$books = $conn->query("SELECT * FROM sach ORDER BY ngaynhap DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="section-title">🔥 Sách nổi bật</h2>
<div class="grid">
  <?php foreach ($featured as $b): ?>
  <article class="card">
    <div class="cover">📖</div>
    <div class="body">
      <h3><a href="detail.php?id=<?= $b['id'] ?>"><?= e($b['tensach']) ?></a></h3>
      <p class="author"><?= e($b['tacgia']) ?></p>
      <p class="desc"><?= e(excerpt($b['mota'], 80)) ?></p>
      <span class="tag"><?= e($b['theloai']) ?></span>
      <p class="price"><?= fmt_gia($b['gia']) ?></p>
      <p class="views">👁 <?= $b['luotxem'] ?> lượt xem</p>
    </div>
  </article>
  <?php endforeach; ?>
</div>

<h2 class="section-title">📚 Tất cả sách (<?= count($books) ?> cuốn)</h2>
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>
