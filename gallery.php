<?php
$page_title = "फोटो गैलरी";
require_once __DIR__ . '/includes/header.php';
$gallery = mysqli_query($conn, "SELECT * FROM gallery ORDER BY created_at DESC");
?>
<div class="container py-5">
  <div class="section-title"><h3>फोटो गैलरी</h3></div>
  <div class="row g-3">
    <?php if (mysqli_num_rows($gallery) > 0): ?>
      <?php while ($g = mysqli_fetch_assoc($gallery)): ?>
      <div class="col-6 col-md-3">
        <div class="gallery-thumb">
          <img src="<?php echo SITE_URL.'/assets/uploads/gallery/'.h($g['image']); ?>" alt="<?php echo h($g['caption']); ?>">
        </div>
        <?php if ($g['caption']): ?><p class="small text-center mt-1 mb-0"><?php echo h($g['caption']); ?></p><?php endif; ?>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">अभी कोई फोटो उपलब्ध नहीं है। एडमिन पैनल से फोटो जोड़ें।</p>
    <?php endif; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
