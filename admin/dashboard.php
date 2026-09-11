<?php
require_once __DIR__ . '/includes/auth_check.php';
$page_title = "डैशबोर्ड";

$news_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM news"))['c'];
$events_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM events"))['c'];
$notices_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM notices"))['c'];
$gallery_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM gallery"))['c'];
$enquiries_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM enquiries"))['c'];

require_once __DIR__ . '/includes/admin_header.php';
?>

<div class="row g-4">
  <div class="col-md-3">
    <div class="info-card text-center">
      <i class="bi bi-newspaper"></i>
      <h3 class="mt-2 mb-0"><?php echo $news_count; ?></h3>
      <p class="text-muted small mb-0">समाचार</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-card text-center">
      <i class="bi bi-calendar-event"></i>
      <h3 class="mt-2 mb-0"><?php echo $events_count; ?></h3>
      <p class="text-muted small mb-0">गतिविधियां / इवेंट्स</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-card text-center">
      <i class="bi bi-megaphone"></i>
      <h3 class="mt-2 mb-0"><?php echo $notices_count; ?></h3>
      <p class="text-muted small mb-0">सूचनाएं</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-card text-center">
      <i class="bi bi-images"></i>
      <h3 class="mt-2 mb-0"><?php echo $gallery_count; ?></h3>
      <p class="text-muted small mb-0">गैलरी फोटो</p>
    </div>
  </div>
</div>

<div class="row g-4 mt-1">
  <div class="col-md-4">
    <div class="info-card text-center">
      <i class="bi bi-envelope-open"></i>
      <h3 class="mt-2 mb-0"><?php echo $enquiries_count; ?></h3>
      <p class="text-muted small mb-0">संपर्क संदेश</p>
    </div>
  </div>
</div>

<div class="alert alert-success mt-4">
  <i class="bi bi-info-circle-fill"></i> यहां से आप वेबसाइट पर दिखाए जाने वाले <strong>समाचार, गतिविधियां/इवेंट्स, सूचनाएं</strong> और <strong>फोटो गैलरी</strong> जोड़/संपादित/हटा सकते हैं। कोई भी बदलाव तुरंत वेबसाइट के मुख्य पृष्ठ पर दिखाई देगा।
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
