<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container">
    <!-- Titel gecentreerd en met extra marge -->
    <h1 class="text-center my-4"><?php echo $data['title']; ?></h1>

    <!-- Knop naar rechts -->
    <a href="<?php echo URLROOT; ?>/bestellingen/add" class="btn btn-success mb-3 float-end">Bestelling toevoegen</a>

    <!-- Tabel -->
    <?php if (function_exists('flash')) flash('bestelling_message'); ?>
    <table class="table">
    <thead>
        <tr>
            <th>Bestelnummer</th>
            <th>Dienstnaam</th>
            <th>Aantal</th>
            <th>Prijs</th>
            <th>Status</th>
            <th>Acties</th> <!-- Nieuwe kolom voor acties -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['bestellingen'] as $bestelling): ?>
            <tr>
                <td><?php echo $bestelling->ReserveringId; ?></td>
                <td><?php echo $bestelling->DienstNaam; ?></td>
                <td><?php echo $bestelling->Aantal; ?></td>
                <td>€<?php echo number_format($bestelling->Prijs, 2, ',', '.'); ?></td>
                <td><?php echo $bestelling->Status; ?></td>
                <td>
                <!-- Potloodicoontje voor wijzigen -->
                <a href="<?php echo URLROOT; ?>/bestellingen/edit/<?php echo $bestelling->Id; ?>" class="text-warning me-2">
                <i class="fas fa-edit"></i>
                </a>
                <!-- Prullenbakicoontje voor verwijderen -->
                <form action="<?php echo URLROOT; ?>/bestellingen/delete/<?php echo $bestelling->Id; ?>" method="POST" style="display: inline;">
                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?');">
                <i class="fas fa-trash"></i>
            </button>
        </form>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>