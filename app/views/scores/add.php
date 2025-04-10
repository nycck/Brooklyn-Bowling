<!-- filepath: c:\Users\veyse\Downloads\v1.2 Examen\Proef\app\views\scores\add.php -->
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Score Toevoegen</h1>
    <?php if (!empty($data['error'])): ?>
        <script>alert('<?= $data['error']; ?>');</script>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/scores/add" method="POST">
        <div class="mb-3">
            <label for="spelerNaam" class="form-label">Speler Naam</label>
            <input type="text" name="spelerNaam" class="form-control" value="<?= $data['spelerNaam']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="score" class="form-label">Score</label>
            <input type="number" name="score" class="form-control" value="<?= $data['score']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="reserveringId" class="form-label">Reservering ID</label>
            <input type="number" name="reserveringId" class="form-control" value="<?= $data['reserveringId']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>