<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Klant Toevoegen</h1>
    <form action="<?= URLROOT; ?>/klanten/add" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" name="voornaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" name="achternaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
