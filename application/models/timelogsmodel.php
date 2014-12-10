<?php

class TimeLogsModel
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
     * Get all contacts from database
     */
    public function getAllTimeLogs()
    {
        $sql = "SELECT * FROM timelogs";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    /**
     * Add a contact to database
     * @param string $firstname Firstname
     * @param string $lastname Lastname
     * @param string $email Email
     */
    public function addTimeLog($volunteer, $date, $timein, $timeout, $totaltime)
    {
        $timein = $date." ".$timein;
        $timeout = $date." ".$timeout;
        $totaltime = 1;
        $program_id = 1;
        
        $sql = "INSERT INTO timelogs (contact_id, program_id, time_in, time_out, total_time) VALUES (:volunteer, :program_id, :timein, :timeout, :totaltime)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer' => $volunteer, ':program_id' => $program_id, ':timein' => $timein, ':timeout' => $timeout, ':totaltime' => $totaltime));
    }

}
