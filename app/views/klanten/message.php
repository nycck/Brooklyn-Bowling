<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5 text-center">
    <div class="alert <?= $data['type'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
        <?= $data['message']; ?>
    </div>
    <p>Je wordt binnen 3 seconden teruggestuurd...</p>
</div>

<script>
    setTimeout(function() {
        window.location.href = '<?= URLROOT; ?>/klanten/index';
    }, 3000);
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
