<?php
require_once __DIR__ . '/includes/auth_check.php';
$page_title = "फोटो गैलरी प्रबंधन";

$upload_dir = __DIR__ . '/../assets/uploads/gallery/';

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM gallery WHERE id=$id"));
    if ($row && $row['image'] && file_exists($upload_dir . $row['image'])) unlink($upload_dir . $row['image']);
    mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
    header('Location: gallery_manage.php?msg=deleted');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = trim($_POST['caption']);

    if (!empty($_FILES['image']['name'][0])) {
        foreach ($_FILES['image']['name'] as $key => $name) {
            if (empty($name)) continue;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (in_array($ext, $allowed)) {
                $image_name = 'gallery_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'][$key], $upload_dir . $image_name);
                $stmt = mysqli_prepare($conn, "INSERT INTO gallery (caption, image) VALUES (?, ?)");
                mysqli_stmt_bind_param($stmt, "ss", $caption, $image_name);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    header('Location: gallery_manage.php?msg=added');
    exit;
}

$all_gallery = mysqli_query($conn, "SELECT * FROM gallery ORDER BY created_at DESC");

require_once __DIR__ . '/includes/admin_header.php';
?>

<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success auto-alert">सफलतापूर्वक <?php echo $_GET['msg'] == 'added' ? 'जोड़ा गया' : 'हटाया गया'; ?>!</div>
<?php endif; ?>

<div class="row g-4">
  <div class="col-md-4">
    <div class="info-card">
      <h6 class="mb-3">नई फोटो जोड़ें (एक से अधिक चुन सकते हैं)</h6>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">कैप्शन (वैकल्पिक)</label>
          <input type="text" name="caption" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">फोटो चुनें *</label>
          <input type="file" name="image[]" class="form-control" accept="image/*" multiple required>
        </div>
        <button type="submit" class="btn btn-success w-100">अपलोड करें</button>
      </form>
    </div>
  </div>

  <div class="col-md-8">
    <div class="info-card">
      <h6 class="mb-3">सभी फोटो</h6>
      <div class="row g-3">
        <?php while ($g = mysqli_fetch_assoc($all_gallery)): ?>
        <div class="col-6 col-lg-4">
          <div class="gallery-thumb position-relative">
            <img src="<?php echo SITE_URL.'/assets/uploads/gallery/'.h($g['image']); ?>" alt="">
          </div>
          <div class="d-flex justify-content-between mt-1">
            <span class="small text-truncate" style="max-width:120px;"><?php echo h($g['caption']); ?></span>
            <a href="?delete=<?php echo $g['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('हटाएं?')"><i class="bi bi-trash"></i></a>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
