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
        $data = ['klanten' => $klanten];
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
            $data = [
                'id' => $id,
                'voornaam' => trim($_POST['voornaam']),
                'achternaam' => trim($_POST['achternaam']),
                'email' => trim($_POST['email']),
                'telefoonnummer' => trim($_POST['telefoonnummer']),
            ];

            if ($this->klantModel->updateKlant($data)) {
                header('Location: ' . URLROOT . '/klanten/index');
            }
        } else {
            $klant = $this->klantModel->getKlantById($id);
            $data = ['klant' => $klant];
            $this->view('klanten/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($this->klantModel->deleteKlant($id)) {
            header('Location: ' . URLROOT . '/klanten/index');
        }
    }
}
