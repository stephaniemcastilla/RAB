<?php

class VolunteersModel
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

    public function getAllVolunteers()
    {
      $sql = "SELECT * FROM contacts WHERE is_volunteer = '1'";
      $query = $this->db->prepare($sql);
      $query->execute();

      // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
      // libs/controller.php! If you prefer to get an associative array as the result, then do
      // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
      // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
      return $query->fetchAll();
    }
    
    public function getVolunteer($volunteer_id)
    {
        $sql = "SELECT * FROM contacts WHERE id = :volunteer_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getSearchedVolunteers($search)
    {
        $sql = "SELECT * FROM contacts WHERE is_volunteer = '1' AND firstname LIKE :search OR lastname LIKE :search;";
        $query = $this->db->prepare($sql);
        $query->execute((array(':search' => $search.'%')));
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getFilteredVolunteers($filter, $contactstags)
    {
        $contact_ids = "";
        
        foreach($contactstags as $contacttag){
          if($contacttag->tag_id==$filter){      
              if($contact_ids==""){
                $contact_ids .= $contacttag->contact_id;
              }else{
                $contact_ids .= ", ".$contacttag->contact_id;
              }
          } 
        }

        $contact_ids = "(".$contact_ids.")";
        
        
        if($contact_ids!='()'){
          $sql = "SELECT * FROM contacts WHERE is_volunteer = '1' AND id IN ".$contact_ids;
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
    
    public function createVolunteer($photo, $firstname, $lastname, $email, $is_volunteer)
    {
        // clean the input from javascript code for example
        $firstname = strip_tags($firstname);
        $lastname = strip_tags($lastname);
        $email = strip_tags($email);
        $is_volunteer = strip_tags($is_volunteer);

        $sql = "INSERT INTO contacts (photo,firstname, lastname, email, is_volunteer) VALUES (:photo, :firstname, :lastname, :email, :is_volunteer)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':photo' => $photo, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':is_volunteer' => $is_volunteer));
    }
    
    public function viewVolunteer($volunteer_id)
    {
        $sql = "SELECT * FROM contacts WHERE id = :volunteer_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function updateVolunteer($volunteer_id, $photo, $firstname, $lastname, $email, $is_volunteer)
    {
        // clean the input from javascript code for example
        $photo = strip_tags($photo);
        $firstname = strip_tags($firstname);
        $lastname = strip_tags($lastname);
        $email = strip_tags($email);
        $is_volunteer = strip_tags($is_volunteer);
        
        if($photo==""){
          $sql = "UPDATE contacts SET firstname = :firstname, lastname = :lastname, email = :email, is_volunteer = :is_volunteer WHERE id = " . $volunteer_id;
          $query = $this->db->prepare($sql);
          $query->execute(array(':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':is_volunteer' => $is_volunteer));
        }else{
          $sql = "UPDATE contacts SET photo = :photo, firstname = :firstname, lastname = :lastname, email = :email, is_volunteer = :is_volunteer WHERE id =" . $volunteer_id;
          $query = $this->db->prepare($sql);
          $query->execute(array(':photo' => $photo, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':is_volunteer' => $is_volunteer));
        };
        
    }
    
    public function deleteVolunteer($volunteer_id)
    {
        $sql = "DELETE FROM contacts WHERE id = :volunteer_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id));
    }
    
    public function createVolunteerTag($tag_id)
    {
        $sql = "SELECT * FROM contacts ORDER BY id DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();

        $volunteer = $query->fetchAll();

        foreach($volunteer as $volunteer){
          $volunteer_id = $volunteer->id;

          $sql = "INSERT INTO contacts_tags (contact_id, tag_id) VALUES (:volunteer_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':volunteer_id' => $volunteer_id, ':tag_id' => $tag_id));  
        }
    }
    
    public function updateVolunteerTag($tag_id, $volunteer_id, $checked)
    {
      $sql = "DELETE FROM volunteers_tags WHERE contact_id = :volunteer_id AND tag_id = :tag_id";
      $query = $this->db->prepare($sql);
      $query->execute(array(':volunteer_id' => $volunteer_id, ':tag_id' => $tag_id));
            
      if($checked == 1){
        $sql = "INSERT INTO volunteers_tags (volunteer_id, tag_id) VALUES (:volunteer_id, :tag_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id, ':tag_id' => $tag_id));
      }else{
        $sql = "DELETE FROM volunteers_tags WHERE contact_id = :volunteer_id AND tag_id = :tag_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id, ':tag_id' => $tag_id));
      }
    }
    
    public function getVolunteerTags($volunteer_id)
    {
      
        $sql = "SELECT * FROM contacts_tags WHERE contact_id = :volunteer_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id));
        
        return $query->fetchAll();
    }
   
    public function deleteVolunteerTags($volunteer_id)
    {
      
        $sql = "DELETE FROM contacts_tags WHERE contact_id = :volunteer_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':volunteer_id' => $volunteer_id));
        
    }
  
    public function getSuggestedVolunteers($keyword)
    {
      $sql = "SELECT * FROM contacts WHERE is_volunteer = '1' AND lastname LIKE (:keyword) ORDER BY lastname";
      $query = $this->db->prepare($sql);
      $query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
      $query->execute();
      

      // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
      // libs/controller.php! If you prefer to get an associative array as the result, then do
      // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
      // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
      return $query->fetchAll();
    }
    
}
