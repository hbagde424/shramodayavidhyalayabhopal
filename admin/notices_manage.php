<?php
require_once __DIR__ . '/includes/auth_check.php';
$page_title = "सूचनाएं प्रबंधन";

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM notices WHERE id=$id");
    header('Location: notices_manage.php?msg=deleted');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $file_link = trim($_POST['file_link']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $edit_id = (int) ($_POST['edit_id'] ?? 0);

    if ($edit_id > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE notices SET title=?, file_link=?, is_active=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssii", $title, $file_link, $is_active, $edit_id);
        mysqli_stmt_execute($stmt);
        header('Location: notices_manage.php?msg=updated');
        exit;
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO notices (title, file_link, is_active) VALUES (?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssi", $title, $file_link, $is_active);
        mysqli_stmt_execute($stmt);
        header('Location: notices_manage.php?msg=added');
        exit;
    }
}

$edit_row = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM notices WHERE id=$id"));
}

$all_notices = mysqli_query($conn, "SELECT * FROM notices ORDER BY created_at DESC");

require_once __DIR__ . '/includes/admin_header.php';
?>

<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success auto-alert">सफलतापूर्वक <?php echo $_GET['msg'] == 'added' ? 'जोड़ा गया' : ($_GET['msg']=='updated' ? 'अपडेट किया गया' : 'हटाया गया'); ?>!</div>
<?php endif; ?>

<div class="row g-4">
  <div class="col-md-4">
    <div class="info-card">
      <h6 class="mb-3"><?php echo $edit_row ? 'सूचना संपादित करें' : 'नई सूचना जोड़ें'; ?></h6>
      <form method="POST">
        <?php if ($edit_row): ?><input type="hidden" name="edit_id" value="<?php echo $edit_row['id']; ?>"><?php endif; ?>
        <div class="mb-3">
          <label class="form-label">सूचना पाठ *</label>
          <textarea name="title" class="form-control" rows="3" required><?php echo $edit_row ? h($edit_row['title']) : ''; ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">फाइल / PDF लिंक (वैकल्पिक)</label>
          <input type="text" name="file_link" class="form-control" placeholder="https://..." value="<?php echo $edit_row ? h($edit_row['file_link']) : ''; ?>">
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="is_active" class="form-check-input" id="isActive" <?php echo (!$edit_row || $edit_row['is_active']) ? 'checked' : ''; ?>>
          <label class="form-check-label" for="isActive">वेबसाइट पर दिखाएं (Active)</label>
        </div>
        <button type="submit" class="btn btn-success w-100"><?php echo $edit_row ? 'अपडेट करें' : 'जोड़ें'; ?></button>
        <?php if ($edit_row): ?><a href="notices_manage.php" class="btn btn-outline-secondary w-100 mt-2">रद्द करें</a><?php endif; ?>
      </form>
    </div>
  </div>

  <div class="col-md-8">
    <div class="info-card">
      <h6 class="mb-3">सभी सूचनाएं</h6>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead><tr><th>सूचना</th><th>फाइल</th><th>स्थिति</th><th>क्रिया</th></tr></thead>
          <tbody>
          <?php while ($n = mysqli_fetch_assoc($all_notices)): ?>
            <tr>
              <td><?php echo h(mb_strimwidth($n['title'],0,60,'...')); ?></td>
              <td><?php echo $n['file_link'] ? '<a href="'.h($n['file_link']).'" target="_blank"><i class="bi bi-file-earmark"></i></a>' : '-'; ?></td>
              <td><?php echo $n['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>'; ?></td>
              <td>
                <a href="?edit=<?php echo $n['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                <a href="?delete=<?php echo $n['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('क्या आप वाकई हटाना चाहते हैं?')"><i class="bi bi-trash"></i></a>
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
