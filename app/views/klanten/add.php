<?php require_once APPROOT . '/views/includes/header.php'; ?>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger text-center" style="position: fixed; top: 56px; width: 100%; z-index: 1000;">
        <?= htmlspecialchars($data['error']); ?>
    </div>
<?php endif; ?>

<div class="container mt-5" style="padding-top: <?= !empty($data['error']) ? '70px' : '0'; ?>;">
    <h1>Klant Toevoegen</h1>
    <form action="<?= URLROOT; ?>/klanten/add" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" name="voornaam" class="form-control" value="<?= htmlspecialchars($data['voornaam']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" name="achternaam" class="form-control" value="<?= htmlspecialchars($data['achternaam']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" class="form-control" value="<?= htmlspecialchars($data['telefoonnummer']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
