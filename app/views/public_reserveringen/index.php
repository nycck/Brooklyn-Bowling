<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Reservering Maken</h1>
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger"><?= $data['error']; ?></div>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/public_reserveringen/reserve" method="POST">
        <div class="mb-3">
            <label for="naam" class="form-label">Naam</label>
            <input type="text" name="naam" class="form-control" value="<?= $data['naam']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="baanId" class="form-label">Baan</label>
            <input type="number" name="baanId" class="form-control" value="<?= $data['baanId']; ?>" required>
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
        <button type="submit" class="btn btn-primary">Reserveren</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
