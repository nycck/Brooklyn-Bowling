<?php

// Zorg ervoor dat de Controller-klasse wordt geladen
require_once APPROOT . '/libraries/Controller.php'; // Gebruik APPROOT voor een absoluut pad

class Reservering extends Controller
{
    public function __construct()
    {
        // Eventuele modellen kunnen hier worden geladen
        // $this->reserveringModel = $this->model('ReserveringModel');
    }

    public function index()
    {
        // Laad de reserveringspagina
        $this->view('reservering/index');
    }
}