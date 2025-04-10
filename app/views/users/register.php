<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Registreren</h1>
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error']; ?></div>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/users/register" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" name="voornaam" class="form-control" value="<?= $data['voornaam']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" name="achternaam" class="form-control" value="<?= $data['achternaam']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Wachtwoord</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Bevestig Wachtwoord</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registreren</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
