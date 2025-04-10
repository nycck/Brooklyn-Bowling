<?php

class Score
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getScores()
    {
        $this->db->query('SELECT * FROM Scores');
        return $this->db->resultSet();
    }

    public function addScore($data)
    {
        $this->db->query('INSERT INTO scores (spelerNaam, score, reserveringId) VALUES (:spelerNaam, :score, :reserveringId)');
        $this->db->bind(':spelerNaam', $data['spelerNaam']);
        $this->db->bind(':score', $data['score']);
        $this->db->bind(':reserveringId', $data['reserveringId']);

        return $this->db->execute();
    }

    public function getScoreById($id)
    {
        $this->db->query('SELECT * FROM Scores WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateScore($data)
    {
        $this->db->query('UPDATE Scores SET ReserveringId = :reserveringId, SpelerNaam = :spelerNaam, Score = :score WHERE Id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':reserveringId', $data['reserveringId']);
        $this->db->bind(':spelerNaam', $data['spelerNaam']);
        $this->db->bind(':score', $data['score']);
        return $this->db->execute();
    }

    public function deleteScore($id)
    {
        $this->db->query('DELETE FROM Scores WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function reserveringExists($reserveringId)
    {
        $this->db->query('SELECT COUNT(*) as count FROM Reserveringen WHERE Id = :reserveringId');
        $this->db->bind(':reserveringId', $reserveringId);
        $result = $this->db->single();
    
        return $result && $result->count > 0;
    }

    public function getScoresByUserId($userId)
    {
        $this->db->query('SELECT s.* FROM Scores s 
                          INNER JOIN Reserveringen r ON s.ReserveringId = r.Id 
                          WHERE r.KlantId = :userId');
        $this->db->bind(':userId', $userId);
        return $this->db->resultSet();
    }

    public function scoreExists($spelerNaam, $score, $reserveringId)
    {
        $this->db->query('SELECT COUNT(*) as count FROM scores WHERE SpelerNaam = :spelerNaam AND Score = :score AND ReserveringId = :reserveringId');
        $this->db->bind(':spelerNaam', $spelerNaam);
        $this->db->bind(':score', $score);
        $this->db->bind(':reserveringId', $reserveringId);
        $result = $this->db->single();

        return $result && $result->count > 0;
    }
}