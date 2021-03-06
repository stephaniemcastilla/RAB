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
     * Get all timelogs from database
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
     * Get all open time logs (no set time_out) from the passed event
     * returning contact information to be displayed in list of currently signed in contacts
     */
    public function getOpenTimeLogsFromEvent($event_id)
    {
        $sql = "SELECT timelogs.id as id, timelogs.contact_id as contact_id, timelogs.time_in as time_in, contacts.firstname as firstname, contacts.lastname as lastname FROM timelogs INNER JOIN contacts on timelogs.contact_id = contacts.id WHERE timelogs.event_id=:event_id AND timelogs.total_time IS NULL;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    /*
     *Get all timelogs that belong to the user in the passed timelog
     */
    public function getTimeLogsForUser($timelog_id){
        
        $sql = "SELECT timelogs.id,timelogs.time_in,timelogs.time_out,timelogs.total_time,programs.name,events.id AS event FROM timelogs INNER JOIN events ON timelogs.event_id = events.id INNER JOIN programs ON events.program_id = programs.id WHERE contact_id = (SELECT contact_id FROM timelogs WHERE timelogs.id = :timelog_id) ORDER BY timelogs.id DESC;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':timelog_id' => $timelog_id));

        return $query->fetchAll();
    }
    /*
     *Get the total time for all timelogs for the user in the passed timelog
     */
    public function getTotalTimeForUser($timelog_id)
    {
        $sql = "SELECT sum(total_time) FROM timelogs WHERE contact_id = (SELECT contact_id FROM timelogs WHERE timelogs.id = :timelog_id) ORDER BY timelogs.id DESC;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':timelog_id' => $timelog_id));

        return $query->fetch();
    }
    /*
     *Get the first name of the contact that owns the passed timelog 
     */
    public function getFirstName($timelog_id)
    {
        $sql = "SELECT firstname FROM contacts WHERE id = (SELECT contact_id FROM timelogs WHERE timelogs.id = :timelog_id) LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':timelog_id' => $timelog_id));

        return $query->fetch();
    }
    
    /*
     *Get the timelog with the passed id
     */    
    public function getTimeLog($id)
    {
        $sql = "SELECT * FROM timelogs WHERE id=:id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }
    /*
     *Get the timelog info as well as contact and program name for the passed timelog
     */
    public function getTimelogAndContact($id)
    {
        $sql = "SELECT timelogs.time_in AS time_in, programs.name AS program_name, contacts.firstname AS firstname FROM timelogs INNER JOIN events ON timelogs.event_id = events.id INNER JOIN programs ON events.program_id = programs.id INNER JOIN contacts ON timelogs.contact_id = contacts.id WHERE timelogs.id = :id ORDER BY timelogs.id DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }
    /*
     * add time log and return id of new row
     */
    public function addTimeLog($volunteer, $event_id, $timein, $timeout)
    {  
        $sql = "INSERT INTO timelogs (contact_id, event_id, time_in, time_out) VALUES (:volunteer, :event_id, :timein, :timeout)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer' => $volunteer, ':event_id' => $event_id, ':timein' => $timein, ':timeout' => $timeout));

        return $this->db->lastInsertId();
    }
    
    public function updateTimeLog($id, $contact_id, $event_id, $time_in, $time_out)
    {
        $sql = "UPDATE timelogs SET contact_id = :contact_id, event_id = :event_id, time_in = :time_in, time_out = :time_out WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':contact_id' => $contact_id, ':event_id' => $event_id, ':time_in' => $time_in, ':time_out' => $time_out,':id' => $id)); 
    }
}
