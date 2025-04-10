<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1>Reserveringen</h1>
    <a href="<?= URLROOT; ?>/reserveringen/add" class="btn btn-primary mb-3">Reservering Toevoegen</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Klant ID</th>
                <th>Baan ID</th>
                <th>Starttijd</th>
                <th>Eindtijd</th>
                <th>Volwassenen</th>
                <th>Kinderen</th>
                <th>Prijs</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reserveringen'] as $reservering): ?>
                <tr>
                    <td><?= $reservering->Id; ?></td>
                    <td><?= $reservering->KlantId; ?></td>
                    <td><?= $reservering->BaanId; ?></td>
                    <td><?= $reservering->Starttijd; ?></td>
                    <td><?= $reservering->Eindtijd; ?></td>
                    <td><?= $reservering->AantalVolwassenen; ?></td>
                    <td><?= $reservering->AantalKinderen; ?></td>
                    <td><?= $reservering->TotaalPrijs; ?></td>
                    <td>
                        <a href="<?= URLROOT; ?>/reserveringen/edit/<?= $reservering->Id; ?>" class="btn btn-warning btn-sm">Wijzigen</a>
                        <a href="<?= URLROOT; ?>/reserveringen/delete/<?= $reservering->Id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze reservering wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
