<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Reservering Toevoegen</h1>
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error']; ?></div>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/reserveringen/add" method="POST">
        <div class="mb-3">
            <label for="klantId" class="form-label">Klant ID</label>
            <input type="number" name="klantId" class="form-control" value="<?= $data['klantId']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="baanId" class="form-label">Baan</label>
            <select name="baanId" class="form-select" required>
                <option value="">Selecteer een baan</option>
                <?php foreach ($data['banen'] as $baan): ?>
                    <option value="<?= $baan->Id; ?>"><?= $baan->BaanNummer; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="starttijd" class="form-label">Starttijd</label>
            <input type="datetime-local" name="starttijd" class="form-control" value="<?= $data['starttijd']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="eindtijd" class="form-label">Eindtijd</label>
            <input type="datetime-local" name="eindtijd" class="form-control" value="<?= $data['eindtijd']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aantalVolwassenen" class="form-label">Aantal Volwassenen</label>
            <input type="number" name="aantalVolwassenen" class="form-control" value="<?= $data['aantalVolwassenen']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aantalKinderen" class="form-label">Aantal Kinderen</label>
            <input type="number" name="aantalKinderen" class="form-control" value="<?= $data['aantalKinderen']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="totaalPrijs" class="form-label">Totaal Prijs</label>
            <input type="number" step="0.01" name="totaalPrijs" class="form-control" value="<?= $data['totaalPrijs']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
