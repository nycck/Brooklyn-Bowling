<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC OOP PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/style.css">
    <link rel="shortcut icon" href="<?= URLROOT; ?>/public/img/favicon.ico" type="image/x-icon">

    <style>
      .navbar-custom {
        background-color: #3B0A0A;
        padding: 10px 40px;
      }

      .navbar-brand img {
        height: 80px;
        border-radius: 12px;
        background-color: #fff;
        padding: 5px;
      }

      .nav-link {
        color: #fff !important;
        font-weight: bold;
        margin: 0 10px;
      }

      .nav-link::after {
        content: '|';
        margin-left: 15px;
        color: white;
      }

      .nav-link:last-child::after {
        content: '';
      }

      .user-profile {
        color: #f9c978;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .user-profile i {
        font-size: 24px;
      }
    </style>
  </head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?= URLROOT; ?>/public/img/brooklynbowlinglogo.png" alt="">
    </a>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Reserveren</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Eten &amp; Drinken</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Faq</a>
        </li>
      </ul>
    </div>
    <div class="user-profile d-none d-lg-flex">
      <i class="bi bi-person-circle"></i>
      <span>Bejan Afkar</span>
    </div>
  </div>
</nav>
