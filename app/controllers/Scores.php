<?php

class Scores extends BaseController
{
    private $scoreModel;

    public function __construct()
    {
        $this->scoreModel = $this->model('Score');
    }

    public function index()
    {
        if (!isLoggedIn()) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        // If logged in as admin, show all scores
        if (isAdmin()) {
            $scores = $this->scoreModel->getScores();
        } else {
            // Otherwise, show only the scores of the logged-in customer
            $scores = $this->scoreModel->getScoresByUserId($_SESSION['user_id']);
        }

        $data = ['scores' => $scores];
        $this->view('scores/index', $data);
    }

    public function add()
    {
        if (!isAdmin()) {
            header('Location: ' . URLROOT . '/scores/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'spelerNaam' => isset($_POST['spelerNaam']) ? trim($_POST['spelerNaam']) : '',
                'score' => isset($_POST['score']) ? trim($_POST['score']) : '',
                'reserveringId' => isset($_POST['reserveringId']) ? trim($_POST['reserveringId']) : '',
                'error' => ''
            ];

            if (!$this->scoreModel->reserveringExists($data['reserveringId'])) {
                $data['error'] = 'De opgegeven Reservering ID bestaat niet.';
            }

            if (empty($data['error'])) {
                if ($this->scoreModel->addScore($data)) {
                    header('Location: ' . URLROOT . '/scores/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('scores/add', $data);
        } else {
            $data = [
                'spelerNaam' => '',
                'score' => '',
                'reserveringId' => '',
                'error' => ''
            ];

            $this->view('scores/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin()) {
            header('Location: ' . URLROOT . '/scores/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'spelerNaam' => trim($_POST['spelerNaam']),
                'score' => trim($_POST['score']),
                'reserveringId' => trim($_POST['reserveringId']),
                'error' => ''
            ];

            if (!$this->scoreModel->reserveringExists($data['reserveringId'])) {
                $data['error'] = 'De opgegeven Reservering ID bestaat niet.';
            }

            if (empty($data['error'])) {
                if ($this->scoreModel->updateScore($data)) {
                    header('Location: ' . URLROOT . '/scores/index');
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('scores/edit', $data);
        } else {
            $score = $this->scoreModel->getScoreById($id);
            $data = ['score' => $score];
            $this->view('scores/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin()) {
            header('Location: ' . URLROOT . '/scores/index');
            exit;
        }

        if ($this->scoreModel->deleteScore($id)) {
            header('Location: ' . URLROOT . '/scores/index');
        } else {
            echo 'Er is een fout opgetreden bij het verwijderen.';
        }
    }
}