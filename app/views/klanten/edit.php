<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Klant Wijzigen</h1>
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error']; ?></div>
    <?php endif; ?>
    <?php if (!empty($data['klant'])): ?>
        <form action="<?= URLROOT; ?>/klanten/edit/<?= $data['klant']->Id; ?>" method="POST">
            <div class="mb-3">
                <label for="voornaam" class="form-label">Voornaam</label>
                <input type="text" name="voornaam" class="form-control" value="<?= $data['klant']->Voornaam ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="achternaam" class="form-label">Achternaam</label>
                <input type="text" name="achternaam" class="form-control" value="<?= $data['klant']->Achternaam ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $data['klant']->Email ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
                <input type="text" name="telefoonnummer" class="form-control" value="<?= $data['klant']->Telefoonnummer ?? ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Klantgegevens niet gevonden.</div>
    <?php endif; ?>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
