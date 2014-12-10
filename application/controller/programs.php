<?php

class Programs extends Controller
{
    public function index()
    {
        if(isset($_POST['search'])&&$_POST['search']!=''){
          $search = $_POST['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $programs_model = $this->loadModel('ProgramsModel');
          $programs = $programs_model->getSearchedPrograms($search);
          
        }else if (isset($_GET['search'])&&$_GET['search']!=''){
          $search = $_GET['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $programs_model = $this->loadModel('ProgramsModel');
          $programs = $programs_model->getSearchedPrograms($search);
          
        }else if(isset($_POST['filter'])&&$_POST['filter']!=''){
            $filter = $_POST['filter'];
            
            $programstags_model = $this->loadModel('ProgramsTagsModel');
            $programstags = $programstags_model->getAllProgramsTags();
            
            // load a model, perform an action, pass the returned data to a variable
            // NOTE: please write the name of the model "LikeThis"
            $programs_model = $this->loadModel('ProgramsModel');
            $programs = $programs_model->getFilteredPrograms($filter, $programstags);
        }else{
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $programs_model = $this->loadModel('ProgramsModel');
          $programs = $programs_model->getAllPrograms();
                    
        }; 
        
        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_programs = $stats_model->getAmountOfPrograms();

        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $tags_model = $this->loadModel('TagsModel');
        $program_categories = $tags_model->getProgramCategories();
        
        // load views. within the views we can echo out $programs and $amount_of_programs easily
        require 'application/views/_templates/header.php';
        require 'application/views/programs/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    public function newProgram()
    { 
      // load another model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $tags_model = $this->loadModel('TagsModel');
      $programs_categories = $tags_model->getProgramCategories();
      
      // load views. within the views we can echo out $programs and $amount_of_programs easily
      require 'application/views/_templates/header.php';
      require 'application/views/programs/newprogram.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function createProgram()
    {
      
      $target_dir = "public/uploads/";
      $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
        // if we have POST data to create a new program entry
        if (isset($_POST["submit_add_program"])) {            
            
            // load model, perform an action on the model
            $programs_model = $this->loadModel('ProgramsModel');
            $programs_model->createProgram($_POST["name"]);
            
            $checkboxes = isset($_POST['tag']) ? $_POST['tag'] : array();
            foreach($checkboxes as $tag_id) {
                $programs_model->createProgramTag($tag_id);
            }
        }

        // where to go after program has been added
        header('location: ' . URL . 'programs/');
    }
    
    public function viewProgram($program_id)
    { 
      // if we have an id of a program that should be edited
      if (isset($program_id)) {
          // load model, perform an action on the model
          $programs_model = $this->loadModel('ProgramsModel');
          $program = $programs_model->viewProgram($program_id);
      }
      // load views. within the views we can echo out $programs and $amount_of_programs easily
      require 'application/views/_templates/header.php';
      require 'application/views/programs/viewprogram.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function editProgram($program_id)
    { 
      // load a model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $programs_model = $this->loadModel('ProgramsModel');
      $program = $programs_model->getProgram($program_id);
      $tags = $programs_model->getProgramTags($program_id);

      // load another model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $tags_model = $this->loadModel('TagsModel');
      $program_categories = $tags_model->getProgramCategories();
       
      // load views. within the views we can echo out $programs and $amount_of_programs easily
      require 'application/views/_templates/header.php';
      require 'application/views/programs/editprogram.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function updateProgram($program_id){
      
      // load model, perform an action on the model
      $programs_model = $this->loadModel('ProgramsModel');
      $programs_model->updateProgram($program_id, $_POST["name"]);          
      
      $tags_model = $this->loadModel('TagsModel');
      $program_categories = $tags_model->getProgramCategories();
      
      $checkboxes = isset($_POST['tag']) ? $_POST['tag'] : array();
      
      foreach($program_categories as $program_category){
        
        $checked = 0;
        
        foreach($checkboxes as $checked_tag) {
            if($program_category->id==$checked_tag){
              $checked = 1;
            }
        }
        
        $programs_model->updateProgramTag($program_category->id, $program_id, $checked);
      }
      
      // where to go after program has been added
      header('location: ' . URL . 'programs/');
    
    }
    
    public function deleteProgram($program_id)
    {
        // if we have an id of a program that should be deleted
        if (isset($program_id)) {
            // load model, perform an action on the model
            $programs_model = $this->loadModel('ProgramsModel');
            $program = $programs_model->getProgram($program_id);
            
            $programs_model->deleteProgramTags($program_id);
            
            $programs_model->deleteProgram($program_id);
        }

        // where to go after program has been deleted
        header('location: ' . URL . 'programs/');
    }
    
    public function bulkProgramActions()
    {
        $programs_model = $this->loadModel('ProgramsModel');
        
        if(isset($_POST['submit-bulk-delete'])){
          // simple message to show where you are
          //echo 'Message from Controller: You are in the Controller: Programs, using the method deleteProgram().';
          $checkboxes = isset($_POST['program']) ? $_POST['program'] : array();
          foreach($checkboxes as $value) {
              // if we have an id of a program that should be deleted
              if (isset($value)) {
                  // load model, perform an action on the model                
                  $program = $programs_model->getProgram($value);

                  foreach($program as $program){
                    if ($program->photo!==''){
                    $program_photo = $program->photo;
                    unlink($program_photo);
                    }
                  }

                  $programs_model->deleteProgram($value);
              }
            header('location: ' . URL . 'programs/');
          }
          if(isset($_POST['submit-bulk-email'])){
           //
          }
          // where to go after program has been deleted
          
        }
    }
    
}