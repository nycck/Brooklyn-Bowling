<?php

class Dashboard extends BaseController
{
    private $klantModel;

    public function __construct()
    {
        if (!isAdmin()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        $this->klantModel = $this->model('Klant');
    }

    public function index()
    {
        $klanten = $this->klantModel->getKlanten();
        $data = ['klanten' => $klanten];
        $this->view('dashboard/index', $data);
    }

    public function delete($id)
    {
        if ($this->klantModel->deleteKlant($id)) {
            header('Location: ' . URLROOT . '/dashboard/index');
        }
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

            if (empty($data['voornaam']) || empty($data['achternaam']) || empty($data['email']) || empty($data['telefoonnummer'])) {
                $data['error'] = 'Vul alle velden in.';
            }

            if (empty($data['error'])) {
                if ($this->klantModel->addKlant($data)) {
                    header('Location: ' . URLROOT . '/dashboard/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('dashboard/add', $data);
        } else {
            $data = [
                'voornaam' => '',
                'achternaam' => '',
                'email' => '',
                'telefoonnummer' => '',
                'error' => ''
            ];

            $this->view('dashboard/add', $data);
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

            if (empty($data['voornaam']) || empty($data['achternaam']) || empty($data['email']) || empty($data['telefoonnummer'])) {
                $data['error'] = 'Vul alle velden in.';
            }

            if (empty($data['error'])) {
                if ($this->klantModel->updateKlant($data)) {
                    header('Location: ' . URLROOT . '/dashboard/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('dashboard/edit', $data);
        } else {
            $klant = $this->klantModel->getKlantById($id);
            $data = [
                'id' => $klant->Id,
                'voornaam' => $klant->Voornaam,
                'achternaam' => $klant->Achternaam,
                'email' => $klant->Email,
                'telefoonnummer' => $klant->Telefoonnummer,
                'error' => ''
            ];

            $this->view('dashboard/edit', $data);
        }
    }
}
