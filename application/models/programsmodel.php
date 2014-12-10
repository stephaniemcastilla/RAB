<?php

class ProgramsModel
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

    public function getAllPrograms()
    {
      $sql = "SELECT * FROM programs";
      $query = $this->db->prepare($sql);
      $query->execute();

      // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
      // libs/controller.php! If you prefer to get an associative array as the result, then do
      // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
      // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
      return $query->fetchAll();
    }
    
    public function getProgram($program_id)
    {
        $sql = "SELECT * FROM programs WHERE id = :program_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getSearchedPrograms($search)
    {
        $sql = "SELECT * FROM programs WHERE name LIKE :search;";
        $query = $this->db->prepare($sql);
        $query->execute((array(':search' => $search.'%')));
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getFilteredPrograms($filter, $programstags)
    {
        $program_ids = "";
        
        foreach($programstags as $programtag){
          if($programtag->tag_id==$filter){      
              if($program_ids==""){
                $program_ids .= $programtag->program_id;
              }else{
                $program_ids .= ", ".$programtag->program_id;
              }
          } 
        }

        $program_ids = "(".$program_ids.")";
        
        
        if($program_ids!='()'){
          $sql = "SELECT * FROM programs WHERE id IN ".$program_ids;
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
    
    public function createProgram($name)
    {
        // clean the input from javascript code for example
        $name = strip_tags($name);

        $sql = "INSERT INTO programs (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
    }
    
    public function viewProgram($program_id)
    {
        $sql = "SELECT * FROM programs WHERE id = :program_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function updateProgram($program_id, $name)
    {
        // clean the input from javascript code for example
        $name = strip_tags($name);
        
        $sql = "UPDATE programs SET name = :name WHERE id = " . $program_id;
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
        
    }
    
    public function deleteProgram($program_id)
    {
        $sql = "DELETE FROM programs WHERE id = :program_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id));
    }
    
    public function createProgramTag($tag_id)
    {
        $sql = "SELECT * FROM programs ORDER BY id DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();

        $program = $query->fetchAll();

        foreach($program as $program){
          $program_id = $program->id;

          $sql = "INSERT INTO programs_tags (program_id, tag_id) VALUES (:program_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':program_id' => $program_id, ':tag_id' => $tag_id));  
        }
    }
    
    public function updateProgramTag($tag_id, $program_id, $checked)
    {
        $sql = "DELETE FROM programs_tags WHERE program_id = :program_id AND tag_id = :tag_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id, ':tag_id' => $tag_id));
              
        if($checked == 1){
          $sql = "INSERT INTO programs_tags (program_id, tag_id) VALUES (:program_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':program_id' => $program_id, ':tag_id' => $tag_id));
        }else{
          $sql = "DELETE FROM programs_tags WHERE program_id = :program_id AND tag_id = :tag_id";
          $query = $this->db->prepare($sql);
          $query->execute(array(':program_id' => $program_id, ':tag_id' => $tag_id));
        }
    }
    
    public function getProgramTags($program_id)
    {
      
        $sql = "SELECT * FROM programs_tags WHERE program_id = :program_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id));
        
        return $query->fetchAll();
    }
   
    public function deleteProgramTags($program_id)
    {
      
        $sql = "DELETE FROM programs_tags WHERE program_id = :program_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':program_id' => $program_id));
        
    }
    
}
