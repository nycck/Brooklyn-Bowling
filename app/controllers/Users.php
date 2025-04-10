<?php

class Users extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        // Redirect naar loginpagina als standaardactie
        header('Location: ' . URLROOT . '/users/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error' => ''
            ];

            $user = $this->userModel->findUserByEmail($data['email']);
            if ($user && password_verify($data['password'], $user->Wachtwoord)) {
                if ($data['email'] === 'test123@gmail.com') {
                    $this->createUserSession($user);
                    echo "<script>alert('Succesvol ingelogd!');</script>";
                    header('Refresh: 5; url=' . URLROOT . '/homepages/index');
                } else {
                    $data['error'] = 'U heeft geen toegang tot het dashboard.';
                    $this->view('users/login', $data);
                }
            } else {
                $data['error'] = 'Onjuiste inloggegevens.';
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'error' => ''
            ];
            $this->view('users/login', $data);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'voornaam' => trim($_POST['voornaam']),
                'achternaam' => trim($_POST['achternaam']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'error' => ''
            ];

            // Validatie
            if (empty($data['voornaam']) || empty($data['achternaam']) || empty($data['email']) || empty($data['password']) || empty($data['confirm_password'])) {
                $data['error'] = 'Vul alle velden in.';
            } elseif ($data['password'] !== $data['confirm_password']) {
                $data['error'] = 'Wachtwoorden komen niet overeen.';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['error'] = 'E-mailadres is al geregistreerd.';
            }

            if (empty($data['error'])) {
                // Hash het wachtwoord
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Voeg de gebruiker toe
                if ($this->userModel->register($data)) {
                    header('Location: ' . URLROOT . '/users/login');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('users/register', $data);
        } else {
            $data = [
                'voornaam' => '',
                'achternaam' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'error' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        header('Location: ' . URLROOT . '/users/login');
        exit;
    }

    private function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->Id;
        $_SESSION['user_email'] = $user->Email;
        $_SESSION['user_name'] = $user->Voornaam . ' ' . $user->Achternaam;
        header('Location: ' . URLROOT . '/dashboard/index');
    }
}
