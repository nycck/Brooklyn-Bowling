<?php

class BestellingenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    
        
    public function getAllBestellingen()
    {
        $sql = 'SELECT Id, ReserveringId, DienstNaam, Aantal, Prijs, BestelDatum, Status 
                FROM Bestelling
                ORDER BY ReserveringId ASC'; // Sorteer oplopend op ReserveringId
    
        $this->db->query($sql);
    
        return $this->db->resultSet();
    }

    public function addBestelling($data)
    {
        $sql = 'INSERT INTO Bestelling (ReserveringId, DienstNaam, Aantal, Prijs, Status) 
                VALUES (:ReserveringId, :DienstNaam, :Aantal, :Prijs, :Status)';

        $this->db->query($sql);
        $this->db->bind(':ReserveringId', $data['ReserveringId']);
        $this->db->bind(':DienstNaam', $data['DienstNaam']);
        $this->db->bind(':Aantal', $data['Aantal']);
        $this->db->bind(':Prijs', $data['Prijs']);
        $this->db->bind(':Status', $data['Status']);

        return $this->db->execute();
    }

    public function checkDuplicateReserveringId($reserveringId)
    {
        $sql = 'SELECT COUNT(*) as count FROM Bestelling WHERE ReserveringId = :ReserveringId';
        $this->db->query($sql);
        $this->db->bind(':ReserveringId', $reserveringId);
        $result = $this->db->single();
        return $result->count > 0; 
    }

    public function updateBestelling($data)
    {
    $sql = 'UPDATE Bestelling 
            SET ReserveringId = :ReserveringId, 
                DienstNaam = :DienstNaam, 
                Aantal = :Aantal, 
                Prijs = :Prijs, 
                Status = :Status 
            WHERE Id = :id';

    $this->db->query($sql);
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':ReserveringId', $data['ReserveringId']);
    $this->db->bind(':DienstNaam', $data['DienstNaam']);
    $this->db->bind(':Aantal', $data['Aantal']);
    $this->db->bind(':Prijs', $data['Prijs']);
    $this->db->bind(':Status', $data['Status']);

    return $this->db->execute();
    }

    public function getBestellingById($id)
    {
    $sql = 'SELECT * FROM Bestelling WHERE Id = :id';
    $this->db->query($sql);
    $this->db->bind(':id', $id);
    return $this->db->single();
    }

    
public function checkDuplicateReserveringIdExceptCurrent($reserveringId, $currentId)
{
    $sql = 'SELECT COUNT(*) as count 
            FROM Bestelling 
            WHERE ReserveringId = :ReserveringId AND Id != :currentId';
    $this->db->query($sql);
    $this->db->bind(':ReserveringId', $reserveringId);
    $this->db->bind(':currentId', $currentId);
    $result = $this->db->single();
    return $result->count > 0; // Retourneer true als het bestelnummer al bestaat
}


public function deleteBestelling($id)
{
    $sql = 'DELETE FROM Bestelling WHERE Id = :id';
    $this->db->query($sql);
    $this->db->bind(':id', $id);
    return $this->db->execute();
}
}