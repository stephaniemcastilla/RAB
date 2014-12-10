<?php

class StatsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfContacts()
    {
        $sql = "SELECT COUNT(id) AS amount_of_contacts FROM contacts";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_contacts;
    }
    
    public function getAmountOfVolunteers()
    {
        $sql = "SELECT COUNT(id) AS amount_of_volunteers FROM contacts WHERE is_volunteer ='1'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_volunteers;
    }
    
    public function getAmountOfTimeLogs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_timelogs FROM timelogs";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_timelogs;
    }
    
    public function getAmountOfPrograms()
    {
        $sql = "SELECT COUNT(id) AS amount_of_programs FROM programs";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_programs;
    }
    
    public function getAmountOfEvents()
    {
        $sql = "SELECT COUNT(id) AS amount_of_events FROM events";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_events;
    }
}
