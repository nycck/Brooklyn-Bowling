<!-- filepath: c:\Users\veyse\Downloads\v1.2 Examen\Proef\app\views\scores\index.php -->
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Scores</h1>
    <?php if ($_SESSION['user_email'] === 'test123@gmail.com'): ?>
        <a href="<?= URLROOT; ?>/scores/add" class="btn btn-primary mb-3">Score Toevoegen</a>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Speler Naam</th>
                <th>Score</th>
                <th>Reservering ID</th>
                <?php if ($_SESSION['user_email'] === 'test123@gmail.com'): ?>
                    <th>Acties</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['scores'] as $score): ?>
                <tr>
                    <td><?= $score->Id; ?></td>
                    <td><?= $score->SpelerNaam; ?></td>
                    <td><?= $score->Score; ?></td>
                    <td><?= $score->ReserveringId; ?></td>
                    <?php if ($_SESSION['user_email'] === 'test123@gmail.com'): ?>
                        <td>
                            <a href="<?= URLROOT; ?>/scores/edit/<?= $score->Id; ?>" class="btn btn-warning btn-sm">Wijzigen</a>
                            <a href="<?= URLROOT; ?>/scores/delete/<?= $score->Id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze score wilt verwijderen?');">Verwijderen</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>