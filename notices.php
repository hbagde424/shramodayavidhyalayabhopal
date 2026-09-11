<?php
$page_title = "महत्वपूर्ण सूचनाएं";
require_once __DIR__ . '/includes/header.php';

$notices = mysqli_query($conn, "SELECT * FROM notices WHERE is_active=1 ORDER BY created_at DESC");
$news = mysqli_query($conn, "SELECT * FROM news WHERE is_active=1 ORDER BY news_date DESC");
$events = mysqli_query($conn, "SELECT * FROM events WHERE is_active=1 ORDER BY event_date DESC");
?>
<div class="container py-5">
  <div class="section-title"><h3>महत्वपूर्ण सूचनाएं</h3></div>

  <ul class="list-group mb-5">
    <?php if (mysqli_num_rows($notices) > 0): ?>
      <?php while ($n = mysqli_fetch_assoc($notices)): ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <span><i class="bi bi-megaphone-fill text-warning me-2"></i><?php echo h($n['title']); ?></span>
          <?php if ($n['file_link']): ?>
            <a href="<?php echo h($n['file_link']); ?>" target="_blank" class="btn btn-sm btn-outline-success">देखें</a>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    <?php else: ?>
      <li class="list-group-item text-muted text-center">कोई सूचना उपलब्ध नहीं है।</li>
    <?php endif; ?>
  </ul>

  <div class="section-title"><h3>समाचार</h3></div>
  <div class="row g-4 mb-5">
    <?php if (mysqli_num_rows($news) > 0): ?>
      <?php while ($n = mysqli_fetch_assoc($news)): ?>
      <div class="col-md-4">
        <div class="news-card">
          <img src="<?php echo $n['image'] ? SITE_URL.'/assets/uploads/news/'.h($n['image']) : 'https://via.placeholder.com/400x220?text=News'; ?>" alt="">
          <div class="card-body">
            <span class="date-chip"><?php echo date('d M Y', strtotime($n['news_date'])); ?></span>
            <h6><?php echo h($n['title']); ?></h6>
            <p class="small text-muted"><?php echo h($n['description']); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">कोई समाचार उपलब्ध नहीं है।</p>
    <?php endif; ?>
  </div>

  <div class="section-title"><h3>आयोजन / गतिविधियां</h3></div>
  <div class="row g-4">
    <?php if (mysqli_num_rows($events) > 0): ?>
      <?php while ($e = mysqli_fetch_assoc($events)): ?>
      <div class="col-md-4">
        <div class="event-card">
          <img src="<?php echo $e['image'] ? SITE_URL.'/assets/uploads/events/'.h($e['image']) : 'https://via.placeholder.com/400x220?text=Event'; ?>" alt="">
          <div class="card-body">
            <span class="date-chip" style="background:var(--accent);"><?php echo date('d M Y', strtotime($e['event_date'])); ?></span>
            <h6><?php echo h($e['title']); ?></h6>
            <p class="small text-muted"><?php echo h($e['description']); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">कोई आयोजन उपलब्ध नहीं है।</p>
    <?php endif; ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
