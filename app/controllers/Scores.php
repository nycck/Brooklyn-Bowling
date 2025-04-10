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
        $scores = $this->scoreModel->getScores();
        $data = [
            'scores' => $scores
        ];
        $this->view('scores/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'spelerNaam' => $_POST['spelerNaam'] ?? '',
                'score' => $_POST['score'] ?? '',
                'reserveringId' => $_POST['reserveringId'] ?? '',
                'error' => ''
            ];

            if (empty($data['spelerNaam']) || empty($data['score']) || empty($data['reserveringId'])) {
                $data['error'] = 'Alle velden zijn verplicht.';
            } elseif ($this->scoreModel->scoreExists($data['spelerNaam'], $data['score'], $data['reserveringId'])) {
                $data['error'] = 'Score bestaat al voor deze speler, score en reservering.';
            }

            if (empty($data['error'])) {
                if ($this->scoreModel->addScore($data)) {
                    header('Location: ' . URLROOT . '/scores/index?message=' . urlencode('Score succesvol toegevoegd.') . '&type=success');
                    exit;
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'spelerNaam' => $_POST['spelerNaam'] ?? '',
                'score' => $_POST['score'] ?? '',
                'reserveringId' => $_POST['reserveringId'] ?? '',
                'error' => ''
            ];

            if (empty($data['spelerNaam']) || empty($data['score']) || empty($data['reserveringId'])) {
                $data['error'] = 'Alle velden zijn verplicht.';
            }

            if (empty($data['error'])) {
                if ($this->scoreModel->updateScore($data)) {
                    header('Location: ' . URLROOT . '/scores/index?message=' . urlencode('Score is succesvol gewijzigd.') . '&type=warning');
                    exit;
                } else {
                    $data['error'] = 'Er is een fout opgetreden.';
                }
            }

            $this->view('scores/edit', $data);
        } else {
            $score = $this->scoreModel->getScoreById($id);

            if (!$score) {
                die('Score niet gevonden.');
            }

            $data = [
                'score' => $score,
                'error' => ''
            ];

            $this->view('scores/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($this->scoreModel->deleteScore($id)) {
            header('Location: ' . URLROOT . '/scores/index?message=' . urlencode('Score is succesvol verwijderd.') . '&type=danger');
            exit;
        } else {
            die('Er is een fout opgetreden bij het verwijderen.');
        }
    }
}