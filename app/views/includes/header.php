<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brooklyn Bowling</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/style.css">
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/scores.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= URLROOT; ?>/public/img/favicon.ico" type="image/x-icon">
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= URLROOT; ?>">Brooklyn Bowling</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT; ?>/reserveringen/index">Reserveringen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT; ?>/scores/index">Scores</a>
        </li>
        
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT; ?>/klanten/index">Klanten</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>