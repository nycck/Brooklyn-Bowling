<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Klant Toevoegen</h1>
    <?php if (!empty($data['error'])): ?>
        <script>alert('<?= $data['error']; ?>');</script>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/klanten/add" method="POST">
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
            <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" class="form-control" value="<?= $data['telefoonnummer']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
