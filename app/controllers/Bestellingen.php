<?php

class Bestellingen extends BaseController
{
    private $bestellingenModel;

    public function __construct()
    {
        // Laad het model
        $this->bestellingenModel = $this->model('BestellingenModel');
    }

    public function index()
    {
        // Haal alle bestellingen op via het model
        $bestellingen = $this->bestellingenModel->getAllBestellingen();

        // Data doorgeven aan de view
        $data = [
            'title' => 'Overzicht Bestellingen',
            'bestellingen' => $bestellingen
        ];

        // Laad de view
        $this->view('bestellingen/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verwerk het formulier
            $_POST = filter_input_array(INPUT_POST, [
                'ReserveringId' => FILTER_SANITIZE_SPECIAL_CHARS,
                'DienstNaam' => FILTER_SANITIZE_SPECIAL_CHARS,
                'Aantal' => FILTER_SANITIZE_NUMBER_INT,
                'Prijs' => [
                    'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                    'flags' => FILTER_FLAG_ALLOW_FRACTION
                ],
                'Status' => FILTER_SANITIZE_SPECIAL_CHARS
            ]);

            $data = [
                'ReserveringId' => trim($_POST['ReserveringId']),
                'DienstNaam' => trim($_POST['DienstNaam']),
                'Aantal' => trim($_POST['Aantal']),
                'Prijs' => trim($_POST['Prijs']),
                'Status' => trim($_POST['Status']),
                'errors' => []
            ];

            // Validatie
        
            if (empty($data['ReserveringId'])) {
            $data['errors']['ReserveringId'] = 'Bestelnummer is verplicht.';
            } elseif ($this->bestellingenModel->checkDuplicateReserveringId($data['ReserveringId'])) {
            $data['errors']['ReserveringId'] = 'Dit bestelnummer bestaat al.';
            }

            if (empty($data['DienstNaam'])) {
                $data['errors']['DienstNaam'] = 'Dienstnaam is verplicht.';
            }
            if (empty($data['Aantal']) || !is_numeric($data['Aantal']) || $data['Aantal'] <= 0) {
                $data['errors']['Aantal'] = 'Aantal is verplicht en moet een positief getal zijn.';
            }

            if (empty($data['Prijs']) || !is_numeric($data['Prijs']) || $data['Prijs'] <= 0) {
                $data['errors']['Prijs'] = 'Prijs is verplicht en moet een positief getal zijn.';
            }
            if (empty($data['Status'])) {
                $data['errors']['Status'] = 'Status is verplicht.';
            }

            // Als er geen fouten zijn, sla de bestelling op
            if (empty($data['errors'])) {
                if ($this->bestellingenModel->addBestelling($data)) {
                    flash('bestelling_message', 'Bestelling succesvol toegevoegd');
                    redirect('bestellingen/index');
                } else {
                    die('Er is iets misgegaan.');
                }
            } else {
                // Laad de view opnieuw met fouten
                $this->view('bestellingen/add', $data);
            }
        } else {
            // Laad het formulier
            $data = [
                'ReserveringId' => '',
                'DienstNaam' => '',
                'Aantal' => '',
                'Prijs' => '',
                'Status' => '',
                'errors' => []
            ];

            $this->view('bestellingen/add', $data);
        }
    }
    

public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verwerk het formulier
        $_POST = filter_input_array(INPUT_POST, [
            'ReserveringId' => FILTER_SANITIZE_SPECIAL_CHARS,
            'DienstNaam' => FILTER_SANITIZE_SPECIAL_CHARS,
            'Aantal' => FILTER_SANITIZE_NUMBER_INT,
            'Prijs' => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_FRACTION
            ],
            'Status' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        $data = [
            'id' => $id,
            'ReserveringId' => trim($_POST['ReserveringId']),
            'DienstNaam' => trim($_POST['DienstNaam']),
            'Aantal' => trim($_POST['Aantal']),
            'Prijs' => trim($_POST['Prijs']),
            'Status' => trim($_POST['Status']),
            'errors' => []
        ];

        // Validatie
        if (empty($data['ReserveringId'])) {
            $data['errors']['ReserveringId'] = 'Bestelnummer is verplicht.';
        } elseif ($this->bestellingenModel->checkDuplicateReserveringIdExceptCurrent($data['ReserveringId'], $id)) {
            $data['errors']['ReserveringId'] = 'Dit bestelnummer bestaat al.';
        }

        if (empty($data['DienstNaam'])) {
            $data['errors']['DienstNaam'] = 'Dienstnaam is verplicht.';
        }
        if (empty($data['Aantal']) || !is_numeric($data['Aantal']) || $data['Aantal'] <= 0) {
            $data['errors']['Aantal'] = 'Aantal is verplicht en moet een positief getal zijn.';
        }
        if (empty($data['Prijs']) || !is_numeric($data['Prijs']) || $data['Prijs'] <= 0) {
            $data['errors']['Prijs'] = 'Prijs is verplicht en moet een positief getal zijn.';
        }
        if (empty($data['Status'])) {
            $data['errors']['Status'] = 'Status is verplicht.';
        }

        // Als er geen fouten zijn, werk de bestelling bij
        if (empty($data['errors'])) {
            if ($this->bestellingenModel->updateBestelling($data)) {
                flash('bestelling_message', 'Bestelling succesvol gewijzigd');
                redirect('bestellingen/index');
            } else {
                die('Er is iets misgegaan.');
            }
        } else {
            // Laad de view opnieuw met fouten
            $this->view('bestellingen/edit', $data);
        }
    } else {
        // Haal de bestaande bestelling op
        $bestelling = $this->bestellingenModel->getBestellingById($id);

        if (!$bestelling) {
            redirect('bestellingen/index');
        }

        $data = [
            'id' => $id,
            'ReserveringId' => $bestelling->ReserveringId,
            'DienstNaam' => $bestelling->DienstNaam,
            'Aantal' => $bestelling->Aantal,
            'Prijs' => $bestelling->Prijs,
            'Status' => $bestelling->Status,
            'errors' => []
        ];

        $this->view('bestellingen/edit', $data);
    }
}  


public function delete($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verwijder de bestelling
        if ($this->bestellingenModel->deleteBestelling($id)) {
            flash('bestelling_message', 'Bestelling succesvol verwijderd');
            redirect('bestellingen/index');
        } else {
            die('Er is iets misgegaan.');
        }
    } else {
        redirect('bestellingen/index');
    }
}
}
