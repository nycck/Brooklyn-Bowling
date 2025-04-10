<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Dashboard</h1>
    <a href="<?= URLROOT; ?>/dashboard/add" class="btn btn-primary mb-3">Klant Toevoegen</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Telefoonnummer</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['klanten'] as $klant): ?>
                <tr>
                    <td><?= $klant->Id; ?></td>
                    <td><?= $klant->Voornaam; ?></td>
                    <td><?= $klant->Achternaam; ?></td>
                    <td><?= $klant->Email; ?></td>
                    <td><?= $klant->Telefoonnummer; ?></td>
                    <td>
                        <a href="<?= URLROOT; ?>/dashboard/edit/<?= $klant->Id; ?>" class="btn btn-warning btn-sm">Wijzigen</a>
                        <a href="<?= URLROOT; ?>/dashboard/delete/<?= $klant->Id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
