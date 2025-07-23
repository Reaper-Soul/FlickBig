<?php
if (isset($_SESSION['alert'])) {
    $type = $_SESSION['alert']['type'];
    $message = $_SESSION['alert']['message'];
    unset($_SESSION['alert']);
}
?>

<?php if (!empty($message)): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
        <div class="alert alert-<?= htmlspecialchars($type ?? 'info') ?> alert-dismissible fade show mt-3" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
          bootstrap.Alert.getOrCreateInstance(alert).close();
        }
      }, 4000);
</script>
