<?php

class Reservering
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getReserveringen()
    {
        $this->db->query('SELECT * FROM Reserveringen');
        return $this->db->resultSet();
    }

    public function addReservering($data)
    {
        $this->db->query('INSERT INTO reserveringen (KlantId, BaanId, Starttijd, Eindtijd, AantalVolwassenen, AantalKinderen, TotaalPrijs) 
                          VALUES (:klantId, :baanId, :starttijd, :eindtijd, :aantalVolwassenen, :aantalKinderen, :totaalPrijs)');
        $this->db->bind(':klantId', $data['klantId']);
        $this->db->bind(':baanId', $data['baanId']);
        $this->db->bind(':starttijd', $data['starttijd']);
        $this->db->bind(':eindtijd', $data['eindtijd']);
        $this->db->bind(':aantalVolwassenen', $data['aantalVolwassenen']);
        $this->db->bind(':aantalKinderen', $data['aantalKinderen']);
        $this->db->bind(':totaalPrijs', $data['totaalPrijs']);

        return $this->db->execute();
    }

    public function getReserveringById($id)
    {
        $this->db->query('SELECT * FROM Reserveringen WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateReservering($data)
    {
        $this->db->query('UPDATE Reserveringen SET KlantId = :klantId, BaanId = :baanId, Starttijd = :starttijd, Eindtijd = :eindtijd, 
                          AantalVolwassenen = :aantalVolwassenen, AantalKinderen = :aantalKinderen, TotaalPrijs = :totaalPrijs WHERE Id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':klantId', $data['klantId']);
        $this->db->bind(':baanId', $data['baanId']);
        $this->db->bind(':starttijd', $data['starttijd']);
        $this->db->bind(':eindtijd', $data['eindtijd']);
        $this->db->bind(':aantalVolwassenen', $data['aantalVolwassenen']);
        $this->db->bind(':aantalKinderen', $data['aantalKinderen']);
        $this->db->bind(':totaalPrijs', $data['totaalPrijs']);

        return $this->db->execute();
    }

    public function deleteReservering($id)
    {
        $this->db->query('DELETE FROM Reserveringen WHERE Id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getBanen()
    {
        $this->db->query('SELECT Id, BaanNummer FROM Banen WHERE IsActief = 1 LIMIT 8');
        return $this->db->resultSet();
    }

    public function klantExists($klantId)
    {
        $this->db->query('SELECT COUNT(*) as count FROM Klanten WHERE Id = :klantId');
        $this->db->bind(':klantId', $klantId);
        $result = $this->db->single();

        return $result && $result->count > 0;
    }
}
