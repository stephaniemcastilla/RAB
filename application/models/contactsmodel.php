<?php

class ContactsModel
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

    public function getAllContacts()
    {
        $sql = "SELECT * FROM contacts";
        $query = $this->db->prepare($sql);
        $query->execute();

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

    public function addContact($photo, $firstname, $lastname, $email, $is_volunteer)
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
    
    public function updateContact($contact_id, $photo, $firstname, $lastname, $email, $is_volunteer)
    {
        // clean the input from javascript code for example
        $photo = strip_tags($photo);
        $firstname = strip_tags($firstname);
        $lastname = strip_tags($lastname);
        $email = strip_tags($email);
        $is_volunteer = strip_tags($is_volunteer);
        
        if($photo==""){
          $sql = "UPDATE contacts SET firstname = :firstname, lastname = :lastname, email = :email, is_volunteer = :is_volunteer WHERE id = " . $contact_id;
          $query = $this->db->prepare($sql);
          $query->execute(array(':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':is_volunteer' => $is_volunteer));
        }else{
          $sql = "UPDATE contacts SET photo = :photo, firstname = :firstname, lastname = :lastname, email = :email, is_volunteer = :is_volunteer WHERE id =" . $contact_id;
          $query = $this->db->prepare($sql);
          $query->execute(array(':photo' => $photo, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':is_volunteer' => $is_volunteer));
        };
        
    }
    
    public function addTag($tag_id)
    {
      
        $sql = "SELECT * FROM contacts ORDER BY id DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        $contact = $query->fetchAll();
        
        foreach($contact as $contact){
          
          $contact_id = $contact->id;
          
          $sql = "INSERT INTO contacts_tags (contact_id, tag_id) VALUES (:contact_id, :tag_id)";
          $query = $this->db->prepare($sql);
          $query->execute(array(':contact_id' => $contact_id, ':tag_id' => $tag_id));
        }
    }
    
    public function getTags($contact_id)
    {
      
        $sql = "SELECT * FROM contacts_tags WHERE contact_id = :contact_id;";
        $query = $this->db->prepare($sql);
        $query->execute(array(':contact_id' => $contact_id));
        
        return $query->fetchAll();
    }
   
    public function viewContact($contact_id)
    {
        $sql = "SELECT * FROM contacts WHERE id = :contact_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':contact_id' => $contact_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getContact($contact_id)
    {
        $sql = "SELECT * FROM contacts WHERE id = :contact_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':contact_id' => $contact_id));

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function deleteContact($contact_id)
    {
        $sql = "DELETE FROM contacts WHERE id = :contact_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':contact_id' => $contact_id));
    }
    
}
