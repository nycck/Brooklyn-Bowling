<?php

class Klant
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getKlanten()
    {
        $this->db->query('SELECT * FROM Klanten');
        return $this->db->resultSet();
    }

    public function addKlant($data)
    {
        $this->db->query('INSERT INTO klanten (Voornaam, Achternaam, Email, Telefoonnummer, DatumAangemaakt) 
                          VALUES (:voornaam, :achternaam, :email, :telefoonnummer, NOW())');
        $this->db->bind(':voornaam', $data['voornaam']);
        $this->db->bind(':achternaam', $data['achternaam']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoonnummer', $data['telefoonnummer']);

        return $this->db->execute();
    }

    public function getKlantById($id)
    {
        $this->db->query('SELECT * FROM Klanten WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateKlant($data)
    {
        $this->db->query('UPDATE Klanten SET Voornaam = :voornaam, Achternaam = :achternaam, Email = :email, Telefoonnummer = :telefoonnummer WHERE Id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':voornaam', $data['voornaam']);
        $this->db->bind(':achternaam', $data['achternaam']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoonnummer', $data['telefoonnummer']);

        return $this->db->execute();
    }

    public function deleteKlant($id)
    {
        $this->db->query('DELETE FROM Klanten WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function emailExists($email)
    {
        $this->db->query('SELECT COUNT(*) as count FROM Klanten WHERE Email = :email');
        $this->db->bind(':email', $email);
        $result = $this->db->single();

        return $result && $result->count > 0;
    }
}
