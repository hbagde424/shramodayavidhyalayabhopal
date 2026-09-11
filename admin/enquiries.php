<?php
require_once __DIR__ . '/includes/auth_check.php';
$page_title = "संपर्क संदेश";

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM enquiries WHERE id=$id");
    header('Location: enquiries.php?msg=deleted');
    exit;
}

$all = mysqli_query($conn, "SELECT * FROM enquiries ORDER BY created_at DESC");

require_once __DIR__ . '/includes/admin_header.php';
?>

<?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-success auto-alert">सफलतापूर्वक हटाया गया!</div>
<?php endif; ?>

<div class="info-card">
  <h6 class="mb-3">वेबसाइट से प्राप्त संपर्क संदेश</h6>
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead><tr><th>नाम</th><th>ईमेल</th><th>फोन</th><th>संदेश</th><th>तारीख</th><th>क्रिया</th></tr></thead>
      <tbody>
      <?php if (mysqli_num_rows($all) > 0): ?>
        <?php while ($e = mysqli_fetch_assoc($all)): ?>
          <tr>
            <td><?php echo h($e['name']); ?></td>
            <td><?php echo h($e['email']); ?></td>
            <td><?php echo h($e['phone']); ?></td>
            <td><?php echo h(mb_strimwidth($e['message'],0,60,'...')); ?></td>
            <td><?php echo date('d M Y H:i', strtotime($e['created_at'])); ?></td>
            <td><a href="?delete=<?php echo $e['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('हटाएं?')"><i class="bi bi-trash"></i></a></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="6" class="text-center text-muted">अभी तक कोई संदेश प्राप्त नहीं हुआ है।</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
