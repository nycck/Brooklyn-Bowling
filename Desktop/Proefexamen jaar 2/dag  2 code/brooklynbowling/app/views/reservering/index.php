<?php require_once APPROOT . '/views/includes/header.php'; ?>
<style>
  body {
    background-color: #FFE8E8;
  }

  .banner {
    position: relative;
    width: 100%;
    height: 600px;
  }

  .banner-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.5;
    z-index: 1;
  }

  .white-box {
    position: absolute;
    top: 300px;
    left: 50%;
    transform: translateX(-50%);
    width: 704px;
    border-radius: 20px;
    background-color: white;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
    z-index: 2;
    padding: 40px 30px;
  }

  .inner-box {
    width: 100%;
    background-color: #450909;
    padding: 20px;
    border-radius: 10px;
    color: white;
    margin-bottom: 30px;
  }

  .step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #7e3e3e;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    margin: 0 6px;
  }

  .step-circle.active {
    background-color: #ffc107;
    color: black;
  }

  .step {
    display: none;
  }

  .step:not(.d-none) {
    display: block;
  }
  .custom-next-btn {
  background-color: #450909;
  color: white;
  border: none;
  padding: 8px 20px;
  border-radius: 6px;
  font-weight: 500;
  transition: 0.2s ease-in-out;
}

.custom-next-btn:hover {
  background-color: #5a1010;
}



</style>

<!-- Banner -->
<div class="banner position-relative">
  <div class="overlay"></div>
  <img src="<?= URLROOT; ?>/public/img/bowlenbanner.jpg" alt="Banner" class="img-fluid banner-image">
</div>

<!-- Reservering box -->
<div class="white-box">
  <!-- Cirkel stappen (rode bovenbox) -->
  <div class="inner-box d-flex justify-content-center">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <div class="step-circle <?= $i === 1 ? 'active' : '' ?>" id="circle<?= $i ?>"><?= $i ?></div>
    <?php endfor; ?>
  </div>

  <!-- Formulier onder rode blok -->
  <form id="stepForm" method="post" action="#">
    <div class="step step-1">
      <label for="datum">Kies een datum</label>
      <input type="date" id="datum" name="datum" class="form-control mt-2">
    </div>

    <div class="step step-2 d-none">
      <label for="tijd">Kies een tijd</label>
      <input type="time" id="tijd" name="tijd" class="form-control mt-2">
    </div>

    <div class="step step-3 d-none">
      <label for="baan">Kies een bowlingbaan</label>
      <select id="baan" name="baan" class="form-select mt-2">
        <?php for ($i = 1; $i <= 8; $i++): ?>
          <option value="<?= $i ?>">Baan <?= $i ?></option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="step step-4 d-none">
      <label for="naam">Naam</label>
      <input type="text" id="naam" name="naam" class="form-control mt-2">
      <label for="email" class="mt-3">E-mail</label>
      <input type="email" id="email" name="email" class="form-control mt-2">
    </div>

    <div class="step step-5 d-none">
      <label for="extra">Extra's</label>
      <select id="snackbox" name="snackbox" class="form-select mt-2">
      <option value="geen">Geen</option>
        <option value="basis">Snackbox Basis</option>
        <option value="luxe">Snackbox Luxe</option>
      </select>

      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="kinderpartij" value="ja" id="kinderpartij">
        <label class="form-check-label" for="kinderpartij">Kinderpartij</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="vrijgezellenfeest" value="ja" id="vrijgezellenfeest">
        <label class="form-check-label" for="vrijgezellenfeest">Vrijgezellenfeest</label>
      </div>
    </div>

    <!-- Navigatie knoppen -->
    <!-- Navigatie knoppen -->
<!-- Navigatie knoppen -->
<div class="d-flex justify-content-between mt-4">
  <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Vorige</button>
  <button type="button" class="btn custom-next-btn" id="nextBtn">Volgende</button>
</div>


  </form>
</div>

<script>
  let currentStep = 1;
  const totalSteps = 5;

  const updateStep = () => {
    document.querySelectorAll('.step').forEach(step => step.classList.add('d-none'));
    document.querySelector('.step-' + currentStep).classList.remove('d-none');

    document.querySelectorAll('.step-circle').forEach((circle, index) => {
      circle.classList.toggle('active', index + 1 === currentStep);
    });

    document.getElementById('prevBtn').disabled = currentStep === 1;
    document.getElementById('nextBtn').textContent = currentStep === totalSteps ? "Bevestigen" : "Volgende";
  };

  document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentStep < totalSteps) {
      currentStep++;
      updateStep();
    } else {
      document.getElementById('stepForm').submit();
    }
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      updateStep();
    }
  });

  updateStep();
</script>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
