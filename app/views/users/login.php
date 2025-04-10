<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Inloggen</h1>
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error']; ?></div>
    <?php endif; ?>
    <?php if (!empty($data['success'])): ?>
        <div class="alert alert-success"><?= $data['success']; ?></div>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/users/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Wachtwoord</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Inloggen</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
