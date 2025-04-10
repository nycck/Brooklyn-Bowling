<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container">
    <h1 class="text-center my-4">Bestelling wijzigen</h1>

    <form action="<?php echo URLROOT; ?>/bestellingen/edit/<?php echo $data['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="ReserveringId" class="form-label">Bestelnummer</label>
            <input type="text" name="ReserveringId" class="form-control <?php echo !empty($data['errors']['ReserveringId']) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ReserveringId']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="DienstNaam" class="form-label">Dienstnaam</label>
            <select id="DienstNaam" name="DienstNaam" class="form-select <?php echo !empty($data['errors']['DienstNaam']) ? 'is-invalid' : ''; ?>" required>
                <option value="">Selecteer een dienst</option>
                <option value="Schoenen" <?php echo $data['DienstNaam'] == 'Schoenen' ? 'selected' : ''; ?>>Schoenen</option>
                <option value="1 extra speelronde" <?php echo $data['DienstNaam'] == '1 extra speelronde' ? 'selected' : ''; ?>>1 extra speelronde</option>
                <option value="2 extra speelrondes" <?php echo $data['DienstNaam'] == '2 extra speelrondes' ? 'selected' : ''; ?>>2 extra speelrondes</option>
                <option value="3 extra speelrondes" <?php echo $data['DienstNaam'] == '3 extra speelrondes' ? 'selected' : ''; ?>>3 extra speelrondes</option>
                <option value="Frisdrank" <?php echo $data['DienstNaam'] == 'Frisdrank' ? 'selected' : ''; ?>>Frisdrank</option>
                <option value="Snacks" <?php echo $data['DienstNaam'] == 'Snacks' ? 'selected' : ''; ?>>Snacks</option>
                <option value="Pizza" <?php echo $data['DienstNaam'] == 'Pizza' ? 'selected' : ''; ?>>Pizza</option>
                <option value="Bier" <?php echo $data['DienstNaam'] == 'Bier' ? 'selected' : ''; ?>>Bier</option>
            </select>
            <div class="invalid-feedback"><?php echo $data['errors']['DienstNaam'] ?? ''; ?></div>
        </div>
        <div class="mb-3">
            <label for="Aantal" class="form-label">Aantal</label>
            <input type="number" id="Aantal" name="Aantal" class="form-control <?php echo !empty($data['errors']['Aantal']) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Aantal']; ?>" required>
            <div class="invalid-feedback"><?php echo $data['errors']['Aantal'] ?? ''; ?></div>
        </div>
        <div class="mb-3">
            <label for="Prijs" class="form-label">Prijs</label>
            <input type="text" id="Prijs" name="Prijs" class="form-control <?php echo !empty($data['errors']['Prijs']) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Prijs']; ?>" readonly required>
            <div class="invalid-feedback"><?php echo $data['errors']['Prijs'] ?? ''; ?></div>
        </div>
        <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select name="Status" class="form-select" required>
                <option value="In behandeling" <?php echo $data['Status'] == 'In behandeling' ? 'selected' : ''; ?>>In behandeling</option>
                <option value="Betaald" <?php echo $data['Status'] == 'Betaald' ? 'selected' : ''; ?>>Betaald</option>
                <option value="Geannuleerd" <?php echo $data['Status'] == 'Geannuleerd' ? 'selected' : ''; ?>>Geannuleerd</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="<?php echo URLROOT; ?>/bestellingen/index" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<script>
    // Prijzen voor de diensten
    const prijzen = {
        "Schoenen": 10,
        "1 extra speelronde": 5,
        "2 extra speelrondes": 9,
        "3 extra speelrondes": 12,
        "Frisdrank": 2,
        "Snacks": 3,
        "Pizza": 8,
        "Bier": 4
    };

    // Elementen ophalen
    const dienstNaamSelect = document.getElementById('DienstNaam');
    const prijsInput = document.getElementById('Prijs');
    const aantalInput = document.getElementById('Aantal');

    // Event listener toevoegen
    dienstNaamSelect.addEventListener('change', updatePrijs);
    aantalInput.addEventListener('input', updatePrijs);

    function updatePrijs() {
        const dienst = dienstNaamSelect.value;
        const aantal = parseInt(aantalInput.value) || 1; // Standaard aantal is 1
        if (prijzen.hasOwnProperty(dienst)) {
            const totaalPrijs = prijzen[dienst] * aantal; // Prijs berekenen
            prijsInput.value = totaalPrijs.toFixed(2); // Prijs met 2 decimalen
        } else {
            prijsInput.value = ''; // Leeg laten als geen dienst is geselecteerd
        }
    }

    // Controleer of er een foutmelding is
    <?php if (!empty($data['errors']['ReserveringId'])): ?>
        // Toon een pop-up met de foutmelding
        alert('Dit bestelnummer bestaat al. Probeer het opnieuw.');
    <?php endif; ?>
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>