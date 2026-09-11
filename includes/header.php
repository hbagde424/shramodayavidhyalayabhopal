<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($page_title) ? h($page_title) . ' - ' . SITE_NAME : SITE_NAME; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>

<!-- Indian Tricolor Ribbon -->
<div class="tricolor-bar"></div>

<!-- Top Utility & Department Strip -->
<div class="top-strip">
  <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <span class="fw-bold text-warning"><i class="bi bi-bank2"></i> मध्यप्रदेश शासन | श्रम विभाग</span>
      <span class="d-none d-md-inline text-white-50">|</span>
      <span class="small d-none d-md-inline"><i class="bi bi-telephone-fill"></i> 0761-2971377 &nbsp;|&nbsp; <i class="bi bi-envelope-fill"></i> info@sarvodayavidyalaya.in</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <!-- Accessibility Controls -->
      <span class="small text-white-50 d-none d-sm-inline">अक्षर आकार:</span>
      <button class="accessibility-btn" onclick="document.body.style.fontSize='90%'">A-</button>
      <button class="accessibility-btn" onclick="document.body.style.fontSize='100%'">A</button>
      <button class="accessibility-btn" onclick="document.body.style.fontSize='110%'">A+</button>
      <span class="text-white-50 ms-1 me-1">|</span>
      <!-- Google Translate Widget -->
      <div id="google_translate_element" class="d-inline-block me-2"></div>
      <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'hi', includedLanguages: 'hi,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
      </script>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <a href="<?php echo SITE_URL; ?>/admin/login.php" class="accessibility-btn bg-success border-0"><i class="bi bi-person-lock"></i> स्टाफ लॉगिन</a>
    </div>
  </div>
</div>

<!-- Main Header with Emblems & Logos -->
<header class="site-header py-3">
  <div class="container d-flex align-items-center justify-content-between flex-wrap gap-3">
    
    <!-- Left: Official State & National Emblems -->
    <div class="d-flex align-items-center gap-3">
      <a href="<?php echo SITE_URL; ?>/index.php" class="d-flex align-items-center gap-2 text-decoration-none">
        <img src="<?php echo SITE_URL; ?>/assets/images/ashoka_emblem.png" alt="भारत का राष्ट्रीय प्रतीक" class="gov-emblem-img" title="सत्यमेव जयते - भारत सरकार">
        <img src="<?php echo SITE_URL; ?>/assets/images/mp_govt_seal.png" alt="मध्यप्रदेश शासन सील" class="gov-emblem-img" title="मध्यप्रदेश शासन">
      </a>
      <div class="border-start ps-3 border-secondary border-opacity-25">
        <h1 class="mb-0 school-title"><?php echo SITE_NAME; ?></h1>
        <div class="school-sub"><?php echo SITE_TAGLINE; ?></div>
        <div class="school-dept"><i class="bi bi-shield-check text-success"></i> भवन एवं अन्य सन्निर्माण कर्मकार कल्याण मण्डल, म.प्र. शासन</div>
      </div>
    </div>

    <!-- Right: Government Initiative Badges -->
    <div class="d-none d-lg-flex align-items-center gap-3">
      <img src="<?php echo SITE_URL; ?>/assets/images/digital_india.png" alt="Digital India" class="gov-header-logo" title="डिजिटल इंडिया">
      <img src="<?php echo SITE_URL; ?>/assets/images/swachh_bharat.png" alt="Swachh Bharat" class="gov-header-logo" title="स्वच्छ भारत अभियान">
      <img src="<?php echo SITE_URL; ?>/assets/images/azadi_mahotsav.png" alt="Azadi Ka Amrit Mahotsav" class="gov-header-logo" title="आजादी का अमृत महोत्सव">
    </div>

  </div>
</header>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark main-nav sticky-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/index.php"><i class="bi bi-house-door-fill me-1"></i> मुख्य पृष्ठ</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/about.php"><i class="bi bi-building me-1"></i> हमारे बारे में</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/academics.php"><i class="bi bi-book-half me-1"></i> शैक्षणिक</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/admission.php"><i class="bi bi-pencil-square me-1"></i> प्रवेश</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/notices.php"><i class="bi bi-bell-fill me-1"></i> सूचनाएं</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/gallery.php"><i class="bi bi-images me-1"></i> गैलरी</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/contact.php"><i class="bi bi-telephone-outbound me-1"></i> संपर्क करें</a></li>
      </ul>
    </div>
  </div>
</nav>

