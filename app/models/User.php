<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM Klanten WHERE Email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO Klanten (Voornaam, Achternaam, Email, Wachtwoord, Telefoonnummer, IsActief, DatumAangemaakt) 
                          VALUES (:voornaam, :achternaam, :email, :password, NULL, 1, NOW())');
        $this->db->bind(':voornaam', $data['voornaam']);
        $this->db->bind(':achternaam', $data['achternaam']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }
}
