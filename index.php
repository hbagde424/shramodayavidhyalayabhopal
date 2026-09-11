<?php
$page_title = "मुख्य पृष्ठ";
require_once __DIR__ . '/includes/header.php';

// Fetch active notices (latest 5)
$notices = mysqli_query($conn, "SELECT * FROM notices WHERE is_active=1 ORDER BY created_at DESC LIMIT 5");

// Fetch latest 3 news
$news = mysqli_query($conn, "SELECT * FROM news WHERE is_active=1 ORDER BY news_date DESC LIMIT 3");

// Fetch latest 3 events
$events = mysqli_query($conn, "SELECT * FROM events WHERE is_active=1 ORDER BY event_date DESC LIMIT 3");

// Fetch 8 gallery images for preview
$gallery = mysqli_query($conn, "SELECT * FROM gallery ORDER BY created_at DESC LIMIT 8");
?>

<!-- HERO BANNER -->
<section class="hero-banner" style="background: linear-gradient(rgba(11, 60, 93, 0.82), rgba(11, 60, 93, 0.88)), url('<?php echo SITE_URL; ?>/assets/images/school_campus.png') center/cover no-repeat; padding: 75px 0;">
  <div class="container text-center text-white">
    <div class="mb-3">
      <span class="gov-seal-badge text-white border-white border-opacity-25" style="background: rgba(255,255,255,0.15);">
        <img src="<?php echo SITE_URL; ?>/assets/images/ashoka_emblem.png" alt="Emblem"> मध्यप्रदेश शासन | श्रम विभाग की विशेष आवासीय योजना
      </span>
    </div>
    <h2 class="display-5 fw-bold text-white mb-2"><?php echo SITE_NAME; ?></h2>
    <p class="lead max-w-700 mx-auto text-light">पंजीकृत निर्माण श्रमिकों के बालक-बालिकाओं हेतु निःशुल्क, सुरक्षित एवं गुणवत्तापूर्ण आवासीय शिक्षा संस्थान</p>
    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
      <a href="admission.php" class="btn btn-accent btn-lg px-4 fs-6 shadow"><i class="bi bi-file-earmark-text-fill me-1"></i> प्रवेश प्रक्रिया 2026-27</a>
      <a href="about.php" class="btn btn-outline-light btn-lg px-4 fs-6"><i class="bi bi-info-circle-fill me-1"></i> विद्यालय परिचय</a>
    </div>
  </div>
</section>

<div class="container">

  <!-- NOTICE MARQUEE -->
  <?php if (mysqli_num_rows($notices) > 0): ?>
  <div class="notice-bar shadow-sm">
    <span class="badge-new"><i class="bi bi-bell-fill"></i> मुख्य सूचना</span>
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" class="marquee-text" style="flex:1;">
      <?php
      $items = [];
      while ($n = mysqli_fetch_assoc($notices)) { $items[] = h($n['title']); }
      echo implode(' &nbsp;&nbsp;🚩&nbsp;&nbsp; ', $items);
      ?>
    </marquee>
    <a href="notices.php" class="btn btn-sm btn-outline-secondary">सभी देखें <i class="bi bi-chevron-right"></i></a>
  </div>
  <?php endif; ?>

  <!-- DIGNITARIES & LEADERSHIP SECTION -->
  <div class="my-5">
    <div class="section-title mb-4">
      <h3>नेतृत्व एवं प्रेरणा स्रोत</h3>
      <p class="text-muted small">मध्यप्रदेश शासन एवं विद्यालय का मार्गदर्शन व प्रेरणा स्तंभ</p>
    </div>
    <div class="row g-4 justify-content-center">
      
      <!-- PM Card -->
      <div class="col-6 col-md-3">
        <div class="dignitary-card">
          <div class="dignitary-img-wrapper">
            <img src="<?php echo SITE_URL; ?>/assets/images/school_leader.png" alt="श्री नरेंद्र मोदी">
          </div>
          <div class="dignitary-name">श्री नरेंद्र मोदी</div>
          <div class="dignitary-role">माननीय प्रधानमंत्री</div>
          <span class="dignitary-badge">भारत सरकार</span>
        </div>
      </div>

      <!-- CM Card -->
      <div class="col-6 col-md-3">
        <div class="dignitary-card">
          <div class="dignitary-img-wrapper">
            <img src="<?php echo SITE_URL; ?>/assets/images/mp_govt_seal.png" alt="डॉ. मोहन यादव">
          </div>
          <div class="dignitary-name">डॉ. मोहन यादव</div>
          <div class="dignitary-role">माननीय मुख्यमंत्री</div>
          <span class="dignitary-badge">मध्यप्रदेश शासन</span>
        </div>
      </div>

      <!-- Labour Minister Card -->
      <div class="col-6 col-md-3">
        <div class="dignitary-card">
          <div class="dignitary-img-wrapper">
            <img src="<?php echo SITE_URL; ?>/assets/images/ashoka_emblem.png" alt="श्री प्रहलाद सिंह पटेल">
          </div>
          <div class="dignitary-name">श्री प्रहलाद सिंह पटेल</div>
          <div class="dignitary-role">माननीय श्रम मंत्री</div>
          <span class="dignitary-badge">मध्यप्रदेश शासन</span>
        </div>
      </div>

      <!-- Principal Card -->
      <div class="col-6 col-md-3">
        <div class="dignitary-card">
          <div class="dignitary-img-wrapper">
            <img src="<?php echo SITE_URL; ?>/assets/images/smart_classroom.png" alt="डॉ. आर. के. शर्मा">
          </div>
          <div class="dignitary-name">डॉ. आर. के. शर्मा</div>
          <div class="dignitary-role">प्राचार्य एवं प्रशासक</div>
          <span class="dignitary-badge">श्रमोदय विद्यालय</span>
        </div>
      </div>

    </div>
  </div>

  <!-- ABOUT SNIPPET -->
  <div class="row align-items-center py-4 bg-white rounded-3 shadow-sm p-4 mb-5 border">
    <div class="col-md-6">
      <div class="section-title text-md-start mb-3">
        <h3>विद्यालय का परिचय एवं उद्देश्य</h3>
      </div>
      <p class="text-secondary" style="line-height:1.7;">यह विद्यालय मध्यप्रदेश शासन श्रम विभाग के अंतर्गत <strong>भवन एवं अन्य सन्निर्माण कर्मकार कल्याण मण्डल</strong> द्वारा संचालित एक उत्कृष्ट शैक्षणिक संस्थान है। इसका मुख्य उद्देश्य पंजीकृत निर्माण श्रमिकों के बालक-बालिकाओं को निःशुल्क गुणवत्तापूर्ण आवासीय शिक्षा, भोजन, पुस्तकें एवं गणवेश उपलब्ध कराना है।</p>
      <ul class="facility-list list-unstyled">
        <li><i class="bi bi-check-circle-fill text-success"></i> 100% निःशुल्क उच्च गुणवत्ता आवासीय व्यवस्था</li>
        <li><i class="bi bi-check-circle-fill text-success"></i> स्मार्ट क्लासरूम एवं आधुनिक कंप्यूटर प्रयोगशाला</li>
        <li><i class="bi bi-check-circle-fill text-success"></i> खेल-कूद, योग एवं सर्वांगीण व्यक्तित्व विकास</li>
        <li><i class="bi bi-check-circle-fill text-success"></i> पौष्टिक भोजन, चिकित्सा एवं सुरक्षा की 24x7 सुविधा</li>
      </ul>
      <a href="about.php" class="btn btn-success mt-2"><i class="bi bi-arrow-right-circle me-1"></i> विस्तृत जानकारी पढ़ें</a>
    </div>
    <div class="col-md-6">
      <div class="row g-3">
        <div class="col-6">
          <div class="info-card text-center p-4">
            <i class="bi bi-mortarboard-fill text-warning"></i>
            <h6 class="mt-2 fw-bold text-dark">गुणवत्तापूर्ण शिक्षा</h6>
            <p class="small text-muted mb-0">अनुभवी एवं समर्पित शिक्षक</p>
          </div>
        </div>
        <div class="col-6">
          <div class="info-card text-center p-4">
            <i class="bi bi-building-fill-check text-success"></i>
            <h6 class="mt-2 fw-bold text-dark">सुरक्षित आवास</h6>
            <p class="small text-muted mb-0">सुरक्षित एवं स्वच्छ छात्रावास</p>
          </div>
        </div>
        <div class="col-6">
          <div class="info-card text-center p-4">
            <i class="bi bi-cup-hot-fill text-danger"></i>
            <h6 class="mt-2 fw-bold text-dark">निःशुल्क भोजन</h6>
            <p class="small text-muted mb-0">संतुलित एवं पौष्टिक आहार</p>
          </div>
        </div>
        <div class="col-6">
          <div class="info-card text-center p-4">
            <i class="bi bi-trophy-fill text-primary"></i>
            <h6 class="mt-2 fw-bold text-dark">खेल एवं गतिविधियां</h6>
            <p class="small text-muted mb-0">इनडोर एवं आउटडोर खेल</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- GOVERNMENT INITIATIVES & CAMPAIGNS BANNER -->
  <div class="initiatives-section my-5">
    <div class="section-title mb-4">
      <h3>शासकीय योजनाएं एवं अभियान</h3>
      <p class="text-muted small">डिजिटल भारत एवं समग्र विकास के प्रमुख राष्ट्रीय कार्यक्रम</p>
    </div>
    <div class="row g-3">
      
      <div class="col-md-3 col-6">
        <div class="initiative-box">
          <img src="<?php echo SITE_URL; ?>/assets/images/digital_india.png" alt="Digital India" class="initiative-img">
          <div>
            <div class="initiative-title">डिजिटल इंडिया</div>
            <div class="initiative-desc">डिजिटल साक्षरता एवं स्मार्ट क्लासरूम</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-6">
        <div class="initiative-box">
          <img src="<?php echo SITE_URL; ?>/assets/images/swachh_bharat.png" alt="Swachh Bharat" class="initiative-img">
          <div>
            <div class="initiative-title">स्वच्छ भारत अभियान</div>
            <div class="initiative-desc">स्वच्छता एवं स्वस्थ परिसर</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-6">
        <div class="initiative-box">
          <img src="<?php echo SITE_URL; ?>/assets/images/azadi_mahotsav.png" alt="Azadi Ka Amrit Mahotsav" class="initiative-img">
          <div>
            <div class="initiative-title">अमृत महोत्सव</div>
            <div class="initiative-desc">राष्ट्र निर्माण में सहभागिता</div>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-6">
        <div class="initiative-box">
          <img src="<?php echo SITE_URL; ?>/assets/images/mp_govt_seal.png" alt="MP Shiksha" class="initiative-img">
          <div>
            <div class="initiative-title">म.प्र. श्रम कल्याण</div>
            <div class="initiative-desc">निर्माण श्रमिक कल्याण योजना</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- NEWS SECTION -->
  <div class="section-title"><h3>महत्वपूर्ण समाचार</h3></div>
  <div class="row g-4 mb-5">
    <?php if (mysqli_num_rows($news) > 0): ?>
      <?php while ($n = mysqli_fetch_assoc($news)): ?>
      <div class="col-md-4">
        <div class="news-card">
          <img src="<?php echo $n['image'] ? SITE_URL.'/assets/uploads/news/'.h($n['image']) : 'https://via.placeholder.com/400x220?text=News'; ?>" alt="">
          <div class="card-body">
            <span class="date-chip"><?php echo date('d M Y', strtotime($n['news_date'])); ?></span>
            <h6><?php echo h($n['title']); ?></h6>
            <p class="small text-muted"><?php echo mb_strimwidth(h($n['description']), 0, 90, '...'); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">वर्तमान में कोई समाचार उपलब्ध नहीं है।</p>
    <?php endif; ?>
  </div>

  <!-- EVENTS SECTION -->
  <div class="section-title"><h3>विद्यालय गतिविधियां / आयोजन</h3></div>
  <div class="row g-4 mb-5">
    <?php if (mysqli_num_rows($events) > 0): ?>
      <?php while ($e = mysqli_fetch_assoc($events)): ?>
      <div class="col-md-4">
        <div class="event-card">
          <img src="<?php echo $e['image'] ? SITE_URL.'/assets/uploads/events/'.h($e['image']) : 'https://via.placeholder.com/400x220?text=Event'; ?>" alt="">
          <div class="card-body">
            <span class="date-chip" style="background:var(--accent);"><?php echo date('d M Y', strtotime($e['event_date'])); ?></span>
            <h6><?php echo h($e['title']); ?></h6>
            <p class="small text-muted"><?php echo mb_strimwidth(h($e['description']), 0, 90, '...'); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">वर्तमान में कोई आयोजन उपलब्ध नहीं है।</p>
    <?php endif; ?>
  </div>

  <!-- GALLERY PREVIEW -->
  <div class="section-title"><h3>फोटो गैलरी</h3></div>
  <div class="row g-3 mb-5">
    <?php if (mysqli_num_rows($gallery) > 0): ?>
      <?php while ($g = mysqli_fetch_assoc($gallery)): ?>
      <div class="col-6 col-md-3">
        <div class="gallery-thumb">
          <img src="<?php echo SITE_URL.'/assets/uploads/gallery/'.h($g['image']); ?>" alt="<?php echo h($g['caption']); ?>">
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">फोटो जल्द ही जोड़े जाएंगे।</p>
    <?php endif; ?>
  </div>
  <div class="text-center mb-5">
    <a href="gallery.php" class="btn btn-outline-success">संपूर्ण गैलरी देखें</a>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
