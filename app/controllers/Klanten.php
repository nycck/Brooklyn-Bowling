<?php

class Klanten extends BaseController
{
    private $klantModel;

    public function __construct()
    {
        $this->klantModel = $this->model('Klant');
    }

    public function index()
    {
        $klanten = $this->klantModel->getKlanten();
        $data = [
            'klanten' => $klanten,
            'message' => empty($klanten) ? 'Er zijn geen contactgegevens beschikbaar' : ''
        ];
        $this->view('klanten/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'voornaam' => trim($_POST['voornaam']),
                'achternaam' => trim($_POST['achternaam']),
                'email' => trim($_POST['email']),
                'telefoonnummer' => trim($_POST['telefoonnummer']),
                'error' => ''
            ];

            if ($this->klantModel->emailExists($data['email'])) {
                $data['error'] = 'E-mail is al in gebruik.';
            }

            if (empty($data['error'])) {
                if ($this->klantModel->addKlant($data)) {
                    header('Location: ' . URLROOT . '/klanten/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('klanten/add', $data);
        } else {
            $data = [
                'voornaam' => '',
                'achternaam' => '',
                'email' => '',
                'telefoonnummer' => '',
                'error' => ''
            ];

            $this->view('klanten/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'voornaam' => trim($_POST['voornaam']),
                'achternaam' => trim($_POST['achternaam']),
                'email' => trim($_POST['email']),
                'telefoonnummer' => trim($_POST['telefoonnummer']),
                'error' => ''
            ];

            $klant = $this->klantModel->getKlantById($id);
            if (!$klant) {
                header('Location: ' . URLROOT . '/klanten/message?message=' . urlencode('Klant niet gevonden.') . '&type=error');
                exit;
            }

            if (isset($klant->Rol) && $klant->Rol === 'admin' && $klant->Email !== $data['email']) {
                $data['error'] = 'De e-mail van een admin kan niet worden gewijzigd. Neem contact op met een andere beheerder voor wijzigingen.';
            } elseif ($this->klantModel->emailExists($data['email']) && $klant->Email !== $data['email']) {
                $data['error'] = 'E-mail is al in gebruik.';
            }

            if (empty($data['error'])) {
                if ($this->klantModel->updateKlant($data)) {
                    header('Location: ' . URLROOT . '/klanten/index');
                    exit;
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $data['klant'] = $klant; // Ensure the klant data is passed to the view
            $this->view('klanten/edit', $data);
        } else {
            $klant = $this->klantModel->getKlantById($id);

            if (!$klant) {
                header('Location: ' . URLROOT . '/klanten/message?message=' . urlencode('Klant niet gevonden.') . '&type=error');
                exit;
            }

            $data = [
                'klant' => $klant,
                'error' => ''
            ];

            $this->view('klanten/edit', $data);
        }
    }

    public function delete($id)
    {
        $klant = $this->klantModel->getKlantById($id);

        if (!$klant) {
            $message = 'Klant niet gevonden.';
            $type = 'error';
        } elseif (!property_exists($klant, 'Rol') || $klant->Rol === 'admin') {
            $message = 'Contactgegevens van een admin kunnen niet worden verwijderd.';
            $type = 'error';
        } else {
            try {
                if ($this->klantModel->deleteKlant($id)) {
                    $message = 'Contactgegevens succesvol verwijderd.';
                    $type = 'success';
                } else {
                    $message = 'Er is een fout opgetreden bij het verwijderen.';
                    $type = 'error';
                }
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') { // Foreign key constraint violation
                    $message = 'Deze klant kan niet worden verwijderd omdat er reserveringen aan gekoppeld zijn.';
                    $type = 'error';
                } else {
                    $message = 'Er is een onverwachte fout opgetreden.';
                    $type = 'error';
                }
            }
        }

        header('Location: ' . URLROOT . '/klanten/message?message=' . urlencode($message) . '&type=' . $type);
        exit;
    }

    public function message()
    {
        $data = [
            'message' => $_GET['message'] ?? '',
            'type' => $_GET['type'] ?? 'error'
        ];
        $this->view('klanten/message', $data);
    }
}
