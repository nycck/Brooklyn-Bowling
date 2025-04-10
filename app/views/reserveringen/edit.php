<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Reservering Wijzigen</h1>
    <?php if (!empty($data['error'])): ?>
        <script>alert('<?= $data['error']; ?>');</script>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/reserveringen/edit/<?= $data['reservering']->Id; ?>" method="POST">
        <div class="mb-3">
            <label for="klantId" class="form-label">Klant ID</label>
            <input type="number" name="klantId" class="form-control" value="<?= $data['reservering']->KlantId ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="baanId" class="form-label">Baan</label>
            <select name="baanId" class="form-select" required>
                <option value="">Selecteer een baan</option>
                <?php foreach ($data['banen'] as $baan): ?>
                    <option value="<?= $baan->Id; ?>" <?= $baan->Id == ($data['reservering']->BaanId ?? '') ? 'selected' : ''; ?>>
                        <?= $baan->BaanNummer; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="starttijd" class="form-label">Starttijd</label>
            <input type="datetime-local" name="starttijd" class="form-control" value="<?= $data['reservering']->Starttijd ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="eindtijd" class="form-label">Eindtijd</label>
            <input type="datetime-local" name="eindtijd" class="form-control" value="<?= $data['reservering']->Eindtijd ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aantalVolwassenen" class="form-label">Aantal Volwassenen</label>
            <input type="number" name="aantalVolwassenen" class="form-control" value="<?= $data['reservering']->AantalVolwassenen ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="aantalKinderen" class="form-label">Aantal Kinderen</label>
            <input type="number" name="aantalKinderen" class="form-control" value="<?= $data['reservering']->AantalKinderen ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="totaalPrijs" class="form-label">Totaal Prijs</label>
            <input type="number" step="0.01" name="totaalPrijs" class="form-control" value="<?= $data['reservering']->TotaalPrijs ?? ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
