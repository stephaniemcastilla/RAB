<?php

class EventsModel
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

    public function getAllEvents()
    {
      $sql = "SELECT * FROM events INNER JOIN programs on events.program_id = programs.id";
      $query = $this->db->prepare($sql);
      $query->execute();

      // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
      // libs/controller.php! If you prefer to get an associative array as the result, then do
      // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
      // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
      return $query->fetchAll();
    }
    
    public function getEvent($event_id)
    {
        $sql = "SELECT * FROM events WHERE id = :event_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getSearchedEvents($search)
    {
        $sql = "SELECT * FROM events WHERE name LIKE :search;";
        $query = $this->db->prepare($sql);
        $query->execute((array(':search' => $search.'%')));
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getFilteredEvents($filter, $eventstags)
    {
        $event_ids = "";
        
        foreach($eventstags as $eventtag){
          if($eventtag->tag_id==$filter){      
              if($event_ids==""){
                $event_ids .= $eventtag->event_id;
              }else{
                $event_ids .= ", ".$eventtag->event_id;
              }
          } 
        }

        $event_ids = "(".$event_ids.")";
        
        
        if($event_ids!='()'){
          $sql = "SELECT * FROM events WHERE id IN ".$event_ids;
          $query = $this->db->prepare($sql);
          $query->execute();

          // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
          // libs/controller.php! If you prefer to get an associative array as the result, then do
          // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
          // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
          return $query->fetchAll();
        }else{
          return 0;
        }
        
    }
    
    public function createEvent($name)
    {
        // clean the input from javascript code for example
        $name = strip_tags($name);

        $sql = "INSERT INTO events (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
    }
    
    public function viewEvent($event_id)
    {
        $sql = "SELECT * FROM events WHERE id = :event_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function updateEvent($event_id, $name)
    {
        // clean the input from javascript code for example
        $name = strip_tags($name);
        
        $sql = "UPDATE events SET name = :name WHERE id = " . $event_id;
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
        
    }
    
    public function deleteEvent($event_id)
    {
        $sql = "DELETE FROM events WHERE id = :event_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));
    }
    
    public function createEventTag($tag_id)
    {
        $sql = "SELECT * FROM events ORDER BY id DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();

        $event = $query->fetchAll();

        foreach($event as $event){
          $event_id = $event->id;

          $sql = "INSERT INTO events_tags (event_id, tag_id) VALUES (:event_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':event_id' => $event_id, ':tag_id' => $tag_id));  
        }
    }
    
    public function updateEventTag($tag_id, $event_id, $checked)
    {
        $sql = "DELETE FROM events_tags WHERE event_id = :event_id AND tag_id = :tag_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id, ':tag_id' => $tag_id));
              
        if($checked == 1){
          $sql = "INSERT INTO events_tags (event_id, tag_id) VALUES (:event_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':event_id' => $event_id, ':tag_id' => $tag_id));
        }else{
          $sql = "DELETE FROM events_tags WHERE event_id = :event_id AND tag_id = :tag_id";
          $query = $this->db->prepare($sql);
          $query->execute(array(':event_id' => $event_id, ':tag_id' => $tag_id));
        }
    }
    
    public function getEventTags($event_id)
    {
      
        $sql = "SELECT * FROM events_tags WHERE event_id = :event_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));
        
        return $query->fetchAll();
    }
   
    public function deleteEventTags($event_id)
    {
      
        $sql = "DELETE FROM events_tags WHERE event_id = :event_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':event_id' => $event_id));
        
    }
    
}
