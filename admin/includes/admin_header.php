<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($page_title) ? h($page_title) . ' - एडमिन पैनल' : 'एडमिन पैनल'; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
<style>body{font-family:'Noto Sans Devanagari', sans-serif; background:#f4f6f5;}</style>
</head>
<body>
<div class="d-flex">
  <div class="admin-sidebar" style="width:250px;">
    <div class="text-center py-4 border-bottom border-light border-opacity-25">
      <i class="bi bi-mortarboard-fill fs-2"></i>
      <h6 class="mt-2 mb-0">एडमिन पैनल</h6>
    </div>
    <a href="<?php echo SITE_URL; ?>/admin/dashboard.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>"><i class="bi bi-speedometer2 me-2"></i> डैशबोर्ड</a>
    <a href="<?php echo SITE_URL; ?>/admin/news_manage.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'news_manage.php') ? 'active' : ''; ?>"><i class="bi bi-newspaper me-2"></i> समाचार प्रबंधन</a>
    <a href="<?php echo SITE_URL; ?>/admin/events_manage.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'events_manage.php') ? 'active' : ''; ?>"><i class="bi bi-calendar-event me-2"></i> गतिविधियां / इवेंट्स</a>
    <a href="<?php echo SITE_URL; ?>/admin/notices_manage.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'notices_manage.php') ? 'active' : ''; ?>"><i class="bi bi-megaphone me-2"></i> सूचनाएं</a>
    <a href="<?php echo SITE_URL; ?>/admin/gallery_manage.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'gallery_manage.php') ? 'active' : ''; ?>"><i class="bi bi-images me-2"></i> फोटो गैलरी</a>
    <a href="<?php echo SITE_URL; ?>/admin/enquiries.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'enquiries.php') ? 'active' : ''; ?>"><i class="bi bi-envelope-open me-2"></i> संपर्क संदेश</a>
    <a href="<?php echo SITE_URL; ?>/admin/logout.php" class="mt-3 text-warning"><i class="bi bi-box-arrow-left me-2"></i> लॉगआउट</a>
  </div>

  <div class="flex-grow-1">
    <div class="admin-topbar d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><?php echo isset($page_title) ? h($page_title) : ''; ?></h5>
      <div class="text-muted small"><i class="bi bi-person-circle"></i> <?php echo h($_SESSION['admin_name'] ?? 'Admin'); ?></div>
    </div>
    <div class="p-4">
