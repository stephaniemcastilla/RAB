<?php

class Volunteers extends Controller
{
    public function index()
    {
        if(isset($_POST['search'])&&$_POST['search']!=''){
          $search = $_POST['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $volunteers_model = $this->loadModel('VolunteersModel');
          $volunteers = $volunteers_model->getSearchedVolunteers($search);
          
        }else if (isset($_GET['search'])&&$_GET['search']!=''){
          $search = $_GET['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $volunteers_model = $this->loadModel('VolunteersModel');
          $volunteers = $volunteers_model->getSearchedVolunteers($search);
          
        }else if(isset($_POST['filter'])&&$_POST['filter']!=''){
            $filter = $_POST['filter'];
            
            $contactstags_model = $this->loadModel('ContactsTagsModel');
            $contactstags = $contactstags_model->getAllContactsTags();
            
            // load a model, perform an action, pass the returned data to a variable
            // NOTE: please write the name of the model "LikeThis"
            $volunteers_model = $this->loadModel('VolunteersModel');
            $volunteers = $volunteers_model->getFilteredVolunteers($filter, $contactstags);
        }else{
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $volunteers_model = $this->loadModel('VolunteersModel');
          $volunteers = $volunteers_model->getAllVolunteers();
                    
        }; 
        
        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_volunteers = $stats_model->getAmountOfVolunteers();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $tags_model = $this->loadModel('TagsModel');
        $volunteer_categories = $tags_model->getVolunteerCategories();
        
        // load views. within the views we can echo out $volunteers and $amount_of_volunteers easily
        require 'application/views/_templates/header.php';
        require 'application/views/volunteers/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    public function newVolunteer()
    { 
      // load another model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $tags_model = $this->loadModel('TagsModel');
      $volunteers_categories = $tags_model->getVolunteerCategories();
      
      // load views. within the views we can echo out $volunteers and $amount_of_volunteers easily
      require 'application/views/_templates/header.php';
      require 'application/views/volunteers/newvolunteer.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function createVolunteer()
    {
      
      $target_dir = "public/uploads/";
      $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
        // if we have POST data to create a new volunteer entry
        if (isset($_POST["submit_add_volunteer"])) {
            
            if ($_FILES["photo"]["tmp_name"]!=''){
              $check = getimagesize($_FILES["photo"]["tmp_name"]);
            
              if($check !== false) {
                  //echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  //echo "File is not an image.";
                  $uploadOk = 0;
              }
              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                  //echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
              } else {
                  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                      //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                  } else {
                      //echo "Sorry, there was an error uploading your file.";
                  }
              }
            }else{
              $target_file = "public/uploads/user.png";
            }
            
            // load model, perform an action on the model
            $volunteers_model = $this->loadModel('VolunteersModel');
            $volunteers_model->createVolunteer($target_file, $_POST["firstname"], $_POST["lastname"],  $_POST["email"], $_POST["is_volunteer"]);
            
            $checkboxes = isset($_POST['tag']) ? $_POST['tag'] : array();
            foreach($checkboxes as $tag_id) {
                $volunteers_model->createVolunteerTag($tag_id);
            }
        }

        // where to go after volunteer has been added
        header('location: ' . URL . 'volunteers/');
    }
    
    public function viewVolunteer($volunteer_id)
    { 
      // if we have an id of a volunteer that should be edited
      if (isset($volunteer_id)) {
          // load model, perform an action on the model
          $volunteers_model = $this->loadModel('VolunteersModel');
          $volunteer = $volunteers_model->viewVolunteer($volunteer_id);
      }
      // load views. within the views we can echo out $volunteers and $amount_of_volunteers easily
      require 'application/views/_templates/header.php';
      require 'application/views/volunteers/viewvolunteer.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function editVolunteer($volunteer_id)
    { 
      // load a model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $volunteers_model = $this->loadModel('VolunteersModel');
      $volunteer = $volunteers_model->getVolunteer($volunteer_id);
      $tags = $volunteers_model->getVolunteerTags($volunteer_id);

      // load another model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $tags_model = $this->loadModel('TagsModel');
      $volunteer_categories = $tags_model->getVolunteerCategories();
       
      // load views. within the views we can echo out $volunteers and $amount_of_volunteers easily
      require 'application/views/_templates/header.php';
      require 'application/views/volunteers/editvolunteer.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function updateVolunteer($volunteer_id){
      
      $target_dir = "public/uploads/";
      $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
        // if we have POST data to create a new volunteer entry
        if (isset($_POST["submit_update_volunteer"])) {
          
              if ($_FILES["photo"]["tmp_name"]!=''){
                $check = getimagesize($_FILES["photo"]["tmp_name"]);

                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
              }else{
                $target_file = '';
              }
                                                  
              

            // load model, perform an action on the model
            $volunteers_model = $this->loadModel('VolunteersModel');
            $volunteers_model->updateVolunteer($volunteer_id, $target_file, $_POST["firstname"], $_POST["lastname"],  $_POST["email"], $_POST["is_volunteer"]);          
            
            $tags_model = $this->loadModel('TagsModel');
            $volunteer_categories = $tags_model->getVolunteerCategories();
            
            $checkboxes = isset($_POST['tag']) ? $_POST['tag'] : array();
            
            foreach($volunteer_categories as $volunteer_category){
              
              $checked = 0;
              
              foreach($checkboxes as $checked_tag) {
                  if($volunteer_category->id==$checked_tag){
                    $checked = 1;
                  }
              }
              //echo $volunteer_category->id.",";
              //echo $volunteer_id.",";
              //echo $checked;
              //echo '<br>';
              
              $volunteers_model->updateVolunteerTag($volunteer_category->id, $volunteer_id, $checked);
            }
            
      }
      
      // where to go after volunteer has been added
      header('location: ' . URL . 'volunteers/');
    
    }
    
    public function deleteVolunteer($volunteer_id)
    {
        // simple message to show where you are
        //echo 'Message from Controller: You are in the Controller: Volunteers, using the method deleteVolunteer().';
        
        // if we have an id of a volunteer that should be deleted
        if (isset($volunteer_id)) {
            // load model, perform an action on the model
            $volunteers_model = $this->loadModel('VolunteersModel');
            $volunteer = $volunteers_model->getVolunteer($volunteer_id);
                      
            foreach($volunteer as $volunteer){
                        
              if ($volunteer->photo!=='public/uploads/user.png'){
              $volunteer_photo = $volunteer->photo;
              echo $volunteer_photo;
              unlink($volunteer_photo);
              }
            }
            
            $volunteers_model->deleteVolunteerTags($volunteer_id);
            
            $volunteers_model->deleteVolunteer($volunteer_id);
        }

        // where to go after volunteer has been deleted
        header('location: ' . URL . 'volunteers/');
    }
    
    public function bulkVolunteerActions()
    {
        $volunteers_model = $this->loadModel('VolunteersModel');
        
        if(isset($_POST['submit-bulk-delete'])){
          // simple message to show where you are
          //echo 'Message from Controller: You are in the Controller: Volunteers, using the method deleteVolunteer().';
          $checkboxes = isset($_POST['volunteer']) ? $_POST['volunteer'] : array();
          foreach($checkboxes as $value) {
              // if we have an id of a volunteer that should be deleted
              if (isset($value)) {
                  // load model, perform an action on the model                
                  $volunteer = $volunteers_model->getVolunteer($value);

                  foreach($volunteer as $volunteer){
                    if ($volunteer->photo!==''){
                    $volunteer_photo = $volunteer->photo;
                    unlink($volunteer_photo);
                    }
                  }

                  $volunteers_model->deleteVolunteer($value);
              }
            header('location: ' . URL . 'volunteers/');
          }
          if(isset($_POST['submit-bulk-email'])){
           //
          }
          // where to go after volunteer has been deleted
          
        }
    }
    public function suggestVolunteers()
    {
      $keyword = '%'.$_POST['keyword'].'%';
      $event = $_POST['event'];
      
      $volunteers_model = $this->loadModel('VolunteersModel');
      $volunteers = $volunteers_model->getSuggestedVolunteers($keyword);
      
      foreach ($volunteers as $volunteer) {
        echo "<li style='list-style: none; text-align: left;'>".$volunteer->firstname." ".$volunteer->lastname."<a href='" . URL . "timelogs/sign_in?event=" . $event . "&contact=" . $volunteer->id . "' class='btn btn-primary' style='float: right; margin-top: 15px;'>SIGN IN</a></li>";
      }
      
      echo "<div class='btn btn-default' style='margin: 50px;'>Don't see your name? Register now!</div>";
      
    }
    
}