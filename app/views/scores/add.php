<!-- filepath: c:\Users\veyse\Downloads\v1.2 Examen\Proef\app\views\scores\add.php -->
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-danger text-center" style="position: fixed; top: 56px; width: 100%; z-index: 1000;">
        <?= htmlspecialchars($data['error']); ?>
    </div>
<?php endif; ?>

<div class="container mt-5" style="padding-top: <?= !empty($data['error']) ? '70px' : '0'; ?>; min-height: calc(100vh - 56px);">
    <h1>Score Toevoegen</h1>
    <form action="<?= URLROOT; ?>/scores/add" method="POST">
        <div class="mb-3">
            <label for="spelerNaam" class="form-label">Speler Naam</label>
            <input type="text" name="spelerNaam" class="form-control" value="<?= htmlspecialchars($data['spelerNaam']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" name="score" class="form-control" value="<?= htmlspecialchars($data['score']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="reserveringId" class="form-label">Reservering ID</label>
            <input type="number" name="reserveringId" class="form-control" value="<?= htmlspecialchars($data['reserveringId']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>