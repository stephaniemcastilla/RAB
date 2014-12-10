<?php

class Events extends Controller
{
    public function index()
    {
        if(isset($_POST['search'])&&$_POST['search']!=''){
          $search = $_POST['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $events_model = $this->loadModel('EventsModel');
          $events = $events_model->getSearchedEvents($search);
          
        }else if (isset($_GET['search'])&&$_GET['search']!=''){
          $search = $_GET['search'];
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $events_model = $this->loadModel('EventsModel');
          $events = $events_model->getSearchedEvents($search);
          
        }else if(isset($_POST['filter'])&&$_POST['filter']!=''){
            $filter = $_POST['filter'];
            
            $eventstags_model = $this->loadModel('EventsTagsModel');
            $eventstags = $eventstags_model->getAllEventsTags();
            
            // load a model, perform an action, pass the returned data to a variable
            // NOTE: please write the name of the model "LikeThis"
            $events_model = $this->loadModel('EventsModel');
            $events = $events_model->getFilteredEvents($filter, $eventstags);
        }else{
          
          // load a model, perform an action, pass the returned data to a variable
          // NOTE: please write the name of the model "LikeThis"
          $events_model = $this->loadModel('EventsModel');
          $events = $events_model->getAllEvents();
                    
        }; 
        
        // load another model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $stats_model = $this->loadModel('StatsModel');
        $amount_of_events = $stats_model->getAmountOfEvents();

        
        // load views. within the views we can echo out $events and $amount_of_events easily
        require 'application/views/_templates/header.php';
        require 'application/views/events/index.php';
        require 'application/views/_templates/footer.php';
    }
    
    public function newEvent()
    { 
      // load views. within the views we can echo out $events and $amount_of_events easily
      require 'application/views/_templates/header.php';
      require 'application/views/events/newevent.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function createEvent()
    {
      
      $target_dir = "public/uploads/";
      $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
        // if we have POST data to create a new event entry
        if (isset($_POST["submit_add_event"])) {            
            
            // load model, perform an action on the model
            $events_model = $this->loadModel('EventsModel');
            $events_model->createEvent($_POST["name"]);
            
        }

        // where to go after event has been added
        header('location: ' . URL . 'events/');
    }
    
    public function viewEvent($event_id)
    { 
      // if we have an id of a event that should be edited
      if (isset($event_id)) {
          // load model, perform an action on the model
          $events_model = $this->loadModel('EventsModel');
          $event = $events_model->viewEvent($event_id);
      }
      // load views. within the views we can echo out $events and $amount_of_events easily
      require 'application/views/_templates/header.php';
      require 'application/views/events/viewevent.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function editEvent($event_id)
    { 
      // load a model, perform an action, pass the returned data to a variable
      // NOTE: please write the name of the model "LikeThis"
      $events_model = $this->loadModel('EventsModel');
      $event = $events_model->getEvent($event_id);
       
      // load views. within the views we can echo out $events and $amount_of_events easily
      require 'application/views/_templates/header.php';
      require 'application/views/events/editevent.php';
      require 'application/views/_templates/footer.php';
    }
    
    public function updateEvent($event_id){
      
      // load model, perform an action on the model
      $events_model = $this->loadModel('EventsModel');
      $events_model->updateEvent($event_id, $_POST["name"]);          
      
      // where to go after event has been added
      header('location: ' . URL . 'events/');
    
    }
    
    public function deleteEvent($event_id)
    {
        // if we have an id of a event that should be deleted
        if (isset($event_id)) {
            // load model, perform an action on the model
            $events_model = $this->loadModel('EventsModel');
            $event = $events_model->getEvent($event_id);
                        
            $events_model->deleteEvent($event_id);
        }

        // where to go after event has been deleted
        header('location: ' . URL . 'events/');
    }
    
    public function bulkEventActions()
    {
        $events_model = $this->loadModel('EventsModel');
        
        if(isset($_POST['submit-bulk-delete'])){
          // simple message to show where you are
          //echo 'Message from Controller: You are in the Controller: Events, using the method deleteEvent().';
          $checkboxes = isset($_POST['event']) ? $_POST['event'] : array();
          foreach($checkboxes as $value) {
              // if we have an id of a event that should be deleted
              if (isset($value)) {
                  // load model, perform an action on the model                
                  $event = $events_model->getEvent($value);

                  foreach($event as $event){
                    if ($event->photo!==''){
                    $event_photo = $event->photo;
                    unlink($event_photo);
                    }
                  }

                  $events_model->deleteEvent($value);
              }
            header('location: ' . URL . 'events/');
          }
          if(isset($_POST['submit-bulk-email'])){
           //
          }
          // where to go after event has been deleted
          
        }
    }
    
}