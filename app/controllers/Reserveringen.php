<?php

class Reserveringen extends BaseController
{
    private $reserveringModel;

    public function __construct()
    {
        // Check if the user is logged in as test123@gmail.com
        if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'test123@gmail.com') {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

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
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'klantId' => $_SESSION['user_id'], // Gebruik de ingelogde gebruiker
                'baanId' => !empty($_POST['baanId']) ? trim($_POST['baanId']) : null,
                'starttijd' => !empty($_POST['starttijd']) ? trim($_POST['starttijd']) : null,
                'eindtijd' => !empty($_POST['eindtijd']) ? trim($_POST['eindtijd']) : null,
                'aantalVolwassenen' => !empty($_POST['aantalVolwassenen']) ? trim($_POST['aantalVolwassenen']) : null,
                'aantalKinderen' => !empty($_POST['aantalKinderen']) ? trim($_POST['aantalKinderen']) : null,
                'totaalPrijs' => !empty($_POST['totaalPrijs']) ? trim($_POST['totaalPrijs']) : null,
                'banen' => $this->reserveringModel->getBanen(),
                'error' => ''
            ];

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
            $data = [
                'id' => $id,
                'klantId' => !empty($_POST['klantId']) ? trim($_POST['klantId']) : null,
                'baanId' => !empty($_POST['baanId']) ? trim($_POST['baanId']) : null,
                'starttijd' => !empty($_POST['starttijd']) ? trim($_POST['starttijd']) : null,
                'eindtijd' => !empty($_POST['eindtijd']) ? trim($_POST['eindtijd']) : null,
                'aantalVolwassenen' => !empty($_POST['aantalVolwassenen']) ? trim($_POST['aantalVolwassenen']) : null,
                'aantalKinderen' => !empty($_POST['aantalKinderen']) ? trim($_POST['aantalKinderen']) : null,
                'totaalPrijs' => !empty($_POST['totaalPrijs']) ? trim($_POST['totaalPrijs']) : null,
                'banen' => $this->reserveringModel->getBanen() // Haal beschikbare banen op
            ];

            if ($this->reserveringModel->updateReservering($data)) {
                header('Location: ' . URLROOT . '/reserveringen/index');
            }
        } else {
            $reservering = $this->reserveringModel->getReserveringById($id);
            $data = [
                'reservering' => $reservering,
                'banen' => $this->reserveringModel->getBanen() // Haal beschikbare banen op
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

    public function public()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'naam' => trim($_POST['naam']),
                'email' => trim($_POST['email']),
                'baanId' => trim($_POST['baanId']),
                'starttijd' => trim($_POST['starttijd']),
                'eindtijd' => trim($_POST['eindtijd']),
                'aantalVolwassenen' => trim($_POST['aantalVolwassenen']),
                'aantalKinderen' => trim($_POST['aantalKinderen']),
                'error' => ''
            ];

            if (empty($data['naam']) || empty($data['email']) || empty($data['baanId']) || empty($data['starttijd']) || empty($data['eindtijd'])) {
                $data['error'] = 'Vul alle velden in.';
            }

            if (empty($data['error'])) {
                // Voeg reservering toe aan database
                if ($this->reserveringModel->addPublicReservering($data)) {
                    header('Location: ' . URLROOT . '/reserveringen/public');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('reserveringen/public', $data);
        } else {
            $data = [
                'naam' => '',
                'email' => '',
                'baanId' => '',
                'starttijd' => '',
                'eindtijd' => '',
                'aantalVolwassenen' => '',
                'aantalKinderen' => '',
                'error' => ''
            ];

            $this->view('reserveringen/public', $data);
        }
    }
}
