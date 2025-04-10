<?php

class Reserveringen extends BaseController
{
    private $reserveringModel;

    public function __construct()
    {
        $this->reserveringModel = $this->model('Reservering');
    }

    public function index()
    {
        $reserveringen = $this->reserveringModel->getReserveringen();
        $data = ['reserveringen' => $reserveringen];
        $this->view('reserveringen/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'klantId' => !empty($_POST['klantId']) ? trim($_POST['klantId']) : null,
                'baanId' => !empty($_POST['baanId']) ? trim($_POST['baanId']) : null,
                'starttijd' => !empty($_POST['starttijd']) ? trim($_POST['starttijd']) : null,
                'eindtijd' => !empty($_POST['eindtijd']) ? trim($_POST['eindtijd']) : null,
                'aantalVolwassenen' => !empty($_POST['aantalVolwassenen']) ? trim($_POST['aantalVolwassenen']) : null,
                'aantalKinderen' => !empty($_POST['aantalKinderen']) ? trim($_POST['aantalKinderen']) : null,
                'totaalPrijs' => !empty($_POST['totaalPrijs']) ? trim($_POST['totaalPrijs']) : null,
                'banen' => $this->reserveringModel->getBanen(),
                'error' => ''
            ];

            if (empty($data['klantId'])) {
                $data['error'] = 'Klant ID is verplicht.';
            }

            if (empty($data['error'])) {
                if ($this->reserveringModel->addReservering($data)) {
                    header('Location: ' . URLROOT . '/reserveringen/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('reserveringen/add', $data);
        } else {
            $data = [
                'klantId' => '',
                'baanId' => '',
                'starttijd' => '',
                'eindtijd' => '',
                'aantalVolwassenen' => '',
                'aantalKinderen' => '',
                'totaalPrijs' => '',
                'banen' => $this->reserveringModel->getBanen(),
                'error' => ''
            ];

            $this->view('reserveringen/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'klantId' => !empty($_POST['klantId']) ? trim($_POST['klantId']) : null,
                'baanId' => !empty($_POST['baanId']) ? trim($_POST['baanId']) : null,
                'starttijd' => !empty($_POST['starttijd']) ? trim($_POST['starttijd']) : null,
                'eindtijd' => !empty($_POST['eindtijd']) ? trim($_POST['eindtijd']) : null,
                'aantalVolwassenen' => !empty($_POST['aantalVolwassenen']) ? trim($_POST['aantalVolwassenen']) : null,
                'aantalKinderen' => !empty($_POST['aantalKinderen']) ? trim($_POST['aantalKinderen']) : null,
                'totaalPrijs' => !empty($_POST['totaalPrijs']) ? trim($_POST['totaalPrijs']) : null,
                'banen' => $this->reserveringModel->getBanen(),
                'error' => ''
            ];

            // Fetch the current reservation to compare the KlantId
            $currentReservering = $this->reserveringModel->getReserveringById($id);

            if ($currentReservering && $currentReservering->KlantId == $data['klantId']) {
                $data['error'] = 'Je kunt niet wijzigen naar hetzelfde Klant ID.';
            }

            if (empty($data['error'])) {
                if ($this->reserveringModel->updateReservering($data)) {
                    header('Location: ' . URLROOT . '/reserveringen/index');
                    exit;
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('reserveringen/edit', $data);
        } else {
            $reservering = $this->reserveringModel->getReserveringById($id);

            if (!$reservering) {
                die('Reservering niet gevonden.');
            }

            $data = [
                'reservering' => $reservering,
                'banen' => $this->reserveringModel->getBanen(),
                'error' => ''
            ];

            $this->view('reserveringen/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($this->reserveringModel->deleteReservering($id)) {
            header('Location: ' . URLROOT . '/reserveringen/index');
        }
    }
}
