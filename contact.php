<?php
$page_title = "संपर्क करें";
require_once __DIR__ . '/includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = mysqli_prepare($conn, "INSERT INTO enquiries (name, email, phone, message) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $message);
        if (mysqli_stmt_execute($stmt)) {
            $success = "आपका संदेश सफलतापूर्वक भेज दिया गया है। हम शीघ्र आपसे संपर्क करेंगे।";
        } else {
            $error = "संदेश भेजने में त्रुटि हुई। कृपया पुनः प्रयास करें।";
        }
    } else {
        $error = "कृपया सभी आवश्यक फ़ील्ड भरें।";
    }
}
?>
<div class="container py-5">
  <div class="section-title"><h3>संपर्क करें</h3></div>

  <div class="row g-4">
    <div class="col-md-5">
      <div class="info-card h-100">
        <h5 class="mb-3">विद्यालय जानकारी</h5>
        <p><i class="bi bi-geo-alt-fill text-success"></i> स्कूल रोड, निकट बस स्टैंड, मध्यप्रदेश</p>
        <p><i class="bi bi-telephone-fill text-success"></i> 0761-2971377</p>
        <p><i class="bi bi-envelope-fill text-success"></i> info@sarvodayavidyalaya.in</p>
        <p><i class="bi bi-clock-fill text-success"></i> कार्यालय समय: 08:00 - 17:00 (सोम-शनि)</p>
      </div>
    </div>
    <div class="col-md-7">
      <div class="info-card">
        <?php if ($success): ?><div class="alert alert-success auto-alert"><?php echo h($success); ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger auto-alert"><?php echo h($error); ?></div><?php endif; ?>
        <form id="contactForm" method="POST">
          <div class="mb-3">
            <label class="form-label">पूरा नाम *</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">ईमेल *</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">मोबाइल नंबर</label>
              <input type="text" name="phone" class="form-control">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">संदेश *</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">संदेश भेजें <i class="bi bi-send"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
