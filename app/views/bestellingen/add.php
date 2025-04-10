<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container">
    <h1 class="text-center my-4">Bestelling toevoegen</h1>

    <form action="<?php echo URLROOT; ?>/bestellingen/add" method="POST">
        <div class="mb-3">
            <label for="ReserveringId" class="form-label">Bestelnummer</label>
            <input type="text" name="ReserveringId" class="form-control <?php echo !empty($data['errors']['ReserveringId']) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ReserveringId']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="DienstNaam" class="form-label">Dienstnaam</label>
            <select id="DienstNaam" name="DienstNaam" class="form-select <?php echo !empty($data['errors']['DienstNaam']) ? 'is-invalid' : ''; ?>" required>
                <option value="">Selecteer een dienst</option>
                <option value="Schoenen">Schoenen</option>
                <option value="1 extra speelronde">1 extra speelronde</option>
                <option value="2 extra speelrondes">2 extra speelrondes</option>
                <option value="3 extra speelrondes">3 extra speelrondes</option>
                <option value="Frisdrank">Frisdrank</option>
                <option value="Snacks">Snacks</option>
                <option value="Pizza">Pizza</option>
                <option value="Bier">Bier</option>
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
</script>

<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="errorModalLabel">Foutmelding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Dit bestelnummer bestaat al. Probeer het opnieuw of ga terug naar het overzicht.
            </div>
            <div class="modal-footer">
                <a href="<?php echo URLROOT; ?>/bestellingen/index" class="btn btn-secondary">Terug naar overzicht</a>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Opnieuw proberen</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Controleer of er een foutmelding is
    <?php if (!empty($data['errors']['ReserveringId'])): ?>
        // Toon een pop-up met de foutmelding
        alert('Dit bestelnummer bestaat al. Probeer het opnieuw.');
    <?php endif; ?>
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>