<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!-- Video als achtergrond -->
<video autoplay muted loop class="video-background">
    <source src="<?= URLROOT; ?>/public/videos/bowling1.mp4" type="video/mp4">
    Je browser ondersteunt geen video.
</video>

<!-- Content -->
<div class="content">
    <div class="container text-center">
        <div class="row mt-5">
            <div class="col-12">
                <h1>Strike na strike bij Brooklyn Bowling!</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h3>Kom nu Bowlen bij ons!</h3>
                <a href="#" class="btn btn-warning mt-3">Meer info!</a>
            </div>
        </div>
    </div>
</div>

<!-- Tweede sectie -->
<div class="content">
    <div class="container text-center">
        <div class="row mt-5">
            <div class="col-12">
                <h1>Welkom bij onze tweede sectie!</h1>
            </div>
        </div>
        <img src="<?= URLROOT; ?>/public/img/bowlen2.jpg" alt=" " class="img-fluid rounded">
        <div class="row mt-5">
            <div class="col-12">
                <h3>Meer informatie over Brooklyn Bowling!</h3>
                <a href="#" class="btn btn-primary mt-3">Lees meer!</a>
            </div>
        </div>
        <!-- Foto toegevoegd -->
        <div class="row mt-5">
            <div class="col-12">
                
            </div>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>