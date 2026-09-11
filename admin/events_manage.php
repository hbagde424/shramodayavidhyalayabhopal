<?php
require_once __DIR__ . '/includes/auth_check.php';
$page_title = "गतिविधियां / इवेंट्स प्रबंधन";

$upload_dir = __DIR__ . '/../assets/uploads/events/';

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM events WHERE id=$id"));
    if ($row && $row['image'] && file_exists($upload_dir . $row['image'])) unlink($upload_dir . $row['image']);
    mysqli_query($conn, "DELETE FROM events WHERE id=$id");
    header('Location: events_manage.php?msg=deleted');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $edit_id = (int) ($_POST['edit_id'] ?? 0);

    $image_name = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($ext, $allowed)) {
            $image_name = 'event_' . time() . '_' . rand(100, 999) . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);
        }
    }

    if ($edit_id > 0) {
        if ($image_name) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM events WHERE id=$edit_id"));
            if ($old && $old['image'] && file_exists($upload_dir . $old['image'])) unlink($upload_dir . $old['image']);
            $stmt = mysqli_prepare($conn, "UPDATE events SET title=?, description=?, event_date=?, is_active=?, image=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssisi", $title, $description, $event_date, $is_active, $image_name, $edit_id);
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE events SET title=?, description=?, event_date=?, is_active=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssii", $title, $description, $event_date, $is_active, $edit_id);
        }
        mysqli_stmt_execute($stmt);
        header('Location: events_manage.php?msg=updated');
        exit;
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO events (title, description, event_date, is_active, image) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "sssis", $title, $description, $event_date, $is_active, $image_name);
        mysqli_stmt_execute($stmt);
        header('Location: events_manage.php?msg=added');
        exit;
    }
}

$edit_row = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events WHERE id=$id"));
}

$all_events = mysqli_query($conn, "SELECT * FROM events ORDER BY created_at DESC");

require_once __DIR__ . '/includes/admin_header.php';
?>

<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success auto-alert">सफलतापूर्वक <?php echo $_GET['msg'] == 'added' ? 'जोड़ा गया' : ($_GET['msg']=='updated' ? 'अपडेट किया गया' : 'हटाया गया'); ?>!</div>
<?php endif; ?>

<div class="row g-4">
  <div class="col-md-4">
    <div class="info-card">
      <h6 class="mb-3"><?php echo $edit_row ? 'गतिविधि संपादित करें' : 'नई गतिविधि / इवेंट जोड़ें'; ?></h6>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit_row): ?><input type="hidden" name="edit_id" value="<?php echo $edit_row['id']; ?>"><?php endif; ?>
        <div class="mb-3">
          <label class="form-label">शीर्षक *</label>
          <input type="text" name="title" class="form-control" required value="<?php echo $edit_row ? h($edit_row['title']) : ''; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">विवरण</label>
          <textarea name="description" class="form-control" rows="3"><?php echo $edit_row ? h($edit_row['description']) : ''; ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">तारीख *</label>
          <input type="date" name="event_date" class="form-control" required value="<?php echo $edit_row ? $edit_row['event_date'] : date('Y-m-d'); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">फोटो <?php echo $edit_row ? '(बदलने हेतु ही चुनें)' : ''; ?></label>
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="is_active" class="form-check-input" id="isActive" <?php echo (!$edit_row || $edit_row['is_active']) ? 'checked' : ''; ?>>
          <label class="form-check-label" for="isActive">वेबसाइट पर दिखाएं (Active)</label>
        </div>
        <button type="submit" class="btn btn-success w-100"><?php echo $edit_row ? 'अपडेट करें' : 'जोड़ें'; ?></button>
        <?php if ($edit_row): ?><a href="events_manage.php" class="btn btn-outline-secondary w-100 mt-2">रद्द करें</a><?php endif; ?>
      </form>
    </div>
  </div>

  <div class="col-md-8">
    <div class="info-card">
      <h6 class="mb-3">सभी गतिविधियां / इवेंट्स</h6>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead><tr><th>फोटो</th><th>शीर्षक</th><th>तारीख</th><th>स्थिति</th><th>क्रिया</th></tr></thead>
          <tbody>
          <?php while ($e = mysqli_fetch_assoc($all_events)): ?>
            <tr>
              <td><img src="<?php echo $e['image'] ? SITE_URL.'/assets/uploads/events/'.h($e['image']) : 'https://via.placeholder.com/60'; ?>" width="55" height="45" style="object-fit:cover;border-radius:6px;"></td>
              <td><?php echo h(mb_strimwidth($e['title'],0,40,'...')); ?></td>
              <td><?php echo date('d M Y', strtotime($e['event_date'])); ?></td>
              <td><?php echo $e['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>'; ?></td>
              <td>
                <a href="?edit=<?php echo $e['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?php echo $e['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('क्या आप वाकई हटाना चाहते हैं?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
