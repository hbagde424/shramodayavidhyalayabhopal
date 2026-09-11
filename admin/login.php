<?php
require_once __DIR__ . '/../includes/config.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: ' . SITE_URL . '/admin/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password, full_name FROM admins WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($admin = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                header('Location: ' . SITE_URL . '/admin/dashboard.php');
                exit;
            } else {
                $error = 'गलत पासवर्ड। कृपया पुनः प्रयास करें।';
            }
        } else {
            $error = 'यूज़रनेम मौजूद नहीं है।';
        }
    } else {
        $error = 'कृपया यूज़रनेम और पासवर्ड दर्ज करें।';
    }
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>स्टाफ लॉगिन - <?php echo SITE_NAME; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
<style>body{font-family:'Noto Sans Devanagari', sans-serif; background: linear-gradient(135deg,#14532d,#1f7a45);}</style>
</head>
<body>
  <div class="login-box">
    <div class="text-center mb-4">
      <i class="bi bi-mortarboard-fill fs-1 text-success"></i>
      <h5 class="mt-2"><?php echo SITE_NAME; ?></h5>
      <p class="text-muted small mb-0">स्टाफ / एडमिन लॉगिन</p>
    </div>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo h($error); ?></div><?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">यूज़रनेम</label>
        <input type="text" name="username" class="form-control" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">पासवर्ड</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">लॉगिन करें</button>
    </form>
    <p class="text-center small text-muted mt-3 mb-0">डिफ़ॉल्ट: admin / admin123</p>
    <p class="text-center small mt-2"><a href="<?php echo SITE_URL; ?>/index.php">&larr; वेबसाइट पर वापस जाएं</a></p>
  </div>
</body>
</html>
